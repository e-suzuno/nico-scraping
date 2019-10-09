<?php

namespace App\Http\Controllers;

use App\Constants\TagTypeConstant;
use App\Models\NicoComics;
use App\Repositories\NicoComic\NicoComicRepositoryInterface AS NicoComicRepository;
use App\Repositories\Tag\TagRepositoryInterface as TagRepository;
use Illuminate\Http\Request;


/**
 * Class IndexController
 * @package App\Http\Controllers
 */
class IndexController extends Controller
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
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index(Request $request)
    {
        $tagList = $this->tagRepository->getAll();

        $tagList = $tagList->filter(function ($tag, $key) {
            return $tag->tag_type_id !== TagTypeConstant::OFFICIAL_COMIC;
        })->sortBy('tag_type_id')->values()->all();


        $nicoComicMaxNicoNo = $this->nicoComicRepository->getMaxNicoNo();

        return view("index", ["tagList" => $tagList, "nicoComicMaxNicoNo" => $nicoComicMaxNicoNo]);
    }


    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function about()
    {
        return view("about");
    }


    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function exclusion()
    {
        return view("exclusion");
    }


}
