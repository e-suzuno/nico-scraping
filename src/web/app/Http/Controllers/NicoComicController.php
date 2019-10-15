<?php

namespace App\Http\Controllers;

use App\Constants\TagConstant;
use App\Http\Requests\NicoComicPost;
use App\Models\NicoComics;
use App\Repositories\NicoComic\NicoComicRepositoryInterface AS NicoComicRepository;
use App\Repositories\Tag\TagRepositoryInterface as TagRepository;
use Illuminate\Http\Request;


/**
 * Class NicoComicController
 * @package App\Http\Controllers
 */
class NicoComicController extends Controller
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


    /**
     * @param Request $request
     * @return mixed
     */
    public function search(NicoComicPost $request)
    {

        try {

            $input = $request->all();

            $select = $this->nicoComicRepository->find($input);

            $order = $input['order'] ?? "nico_no_desc";


            if ($order === "random") {
                $select->inRandomOrder();
            }else{
                if ($order === "comic_update_date_desc") {
                    $select->orderBy('comic_update_date', 'desc');
                } else if ($order === "nico_no_desc") {
                    $select->orderBy('nico_no', 'desc');
                } else if ($order === "story_number_desc") {
                    $select->orderBy('story_number', 'desc');
                } else if ($order === "update_speed_asc") {
                    $select->orderBy('update_speed', 'asc');
                } else if ($order === "updated_at_desc") {
                    $select->orderBy('updated_at', 'desc');
                }
                $select->orderBy("updated_at", 'desc')->orderBy("nico_no", 'desc');
            }



            $nicoComics = $select->paginate(15);

            $response = \Response::json($nicoComics, 200);
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
