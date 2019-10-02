<?php

namespace App\Http\Controllers;

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

        $input = $request->all();


        $select = $this->nicoComicRepository->find($input);


        $order = $input['order'] ?? "nico_no_desc";

        if ($order === "comic_update_date_desc") {
            $select->orderBy('comic_update_date', 'desc');
        } else if ($order === "nico_no_desc") {
            $select->orderBy('nico_no', 'desc');
        } else if ($order === "story_number_desc") {
            $select->orderBy('story_number', 'desc');
        }

        $nicoComics = $select->paginate(15);
        return view("index", $input + ["nicoComics" => $nicoComics, "tagList" => $tagList]);
    }


    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function about(){
        return view("about");
    }
}
