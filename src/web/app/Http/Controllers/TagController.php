<?php

namespace App\Http\Controllers;

use App\Constants\TagConstant;
use App\Constants\TagTypeConstant;
use App\Models\NicoComics;
use App\Repositories\NicoComic\NicoComicRepositoryInterface AS NicoComicRepository;
use App\Repositories\Tag\TagRepositoryInterface as TagRepository;
use Illuminate\Http\Request;


class TagController extends Controller
{
    //

    /**
     * @var NicoComicRepository
     */
    public $nicoComicRepository;

    /**
     * @var TagRepository
     */
    public $tagRepository;


    /**
     * IndexController constructor.
     * @param NicoComicRepository $nicoComicRepository
     * @param TagRepository $tagRepository
     * @param Request $request
     */
    public function __construct(
        NicoComicRepository $nicoComicRepository,
        TagRepository $tagRepository,
        Request $request
    )
    {
        $this->nicoComicRepository = $nicoComicRepository;
        $this->tagRepository = $tagRepository;
        $this->request = $request;
    }


    public function index()
    {

        try {
            $tagList = $this->tagRepository->getAll()->filter(function ($tag, $key) {
                return $tag->tag_type_id !== TagTypeConstant::OFFICIAL_COMIC;
            })->sortBy('tag_type_id')->values()->all();


            $response = \Response::json($tagList, 200);


        } catch (\Exception $e) {
            $response = \Response::json(array(
                'status' => false,
                'message' => $e->getMessage()
            ), 400);
        }
        return $response;

    }




    /**
     * @param Request $request
     * @return mixed
     */
    public function addTag(Request $request)
    {
        try {
            $input = $request->all();
            $this->nicoComicRepository->addTag($input['no'], $input['tag_id']);

            $nicoComic = $this->nicoComicRepository->findByNicoNo($input['no']);

            $response = \Response::json(array(
                'status' => true,
                'message' => "success",
                'item' => $nicoComic,
            ), 200);

        } catch (\Exception $e) {
            $response = \Response::json(array(
                'status' => false,
                'message' => $e->getMessage()
            ), 400);
        }
        return $response;

    }


    /**
     * @param Request $request
     * @return mixed
     */
    public function addTagAdminRecommended(Request $request)
    {
        try {
            $input = $request->all();
            $this->nicoComicRepository->addTag($input['no'], TagConstant::ADMIN_RECOMMENDED);

            $nicoComic = $this->nicoComicRepository->findByNicoNo($input['no']);

            $response = \Response::json(array(
                'status' => true,
                'message' => "success",
                'item' => $nicoComic,
            ), 200);

        } catch (\Exception $e) {
            $response = \Response::json(array(
                'status' => false,
                'message' => $e->getMessage()
            ), 400);
        }
        return $response;

    }


}
