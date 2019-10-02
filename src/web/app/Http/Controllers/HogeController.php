<?php

namespace App\Http\Controllers;

use App\Models\NicoComics;
use App\Repositories\NicoComic\NicoComicRepositoryInterface AS NicoComicRepository;
use App\Repositories\Tag\TagRepositoryInterface as TagRepository;
use Illuminate\Http\Request;


/**
 * Class HogeController
 * @package App\Http\Controllers
 */
class HogeController extends Controller
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
     * HogeController constructor.
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


    public function test()
    {
        $total_list = [];
        $url = "http://seiga.nicovideo.jp/manga/list?page=1&sort=comment_created";
        $list = getNicoMangaListPage($url);

        $total_list[] = $list;


        $url = "http://seiga.nicovideo.jp/manga/list?page=2&sort=comment_created";
        $list = getNicoMangaListPage($url);

        $total_list[] = $list;

        var_dump($total_list);
        return "error";

    }


    public function TargetPage()
    {
        $list = [];
        for ($i = 1; $i <= 20; $i++) {
            $data = getNicoMangaTargetPage($i);
            sleep(1);
        }
        return "";
    }


    /**
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index(Request $request)
    {

        $input = $request->all();

        $nicoComics = $this->nicoComicRepository->find($input)->paginate(15);

        return view("index", $input + ["nicoComics" => $nicoComics]);
    }


}
