<?php

namespace App\Console\Commands;

use App\Constants\TagTypeConstant;
use App\Repositories\NicoComic\NicoComicRepositoryInterface as NicoComicRepository;
use App\Repositories\Tag\TagRepositoryInterface as TagRepository;
use Carbon\Carbon;
use Illuminate\Console\Command;

class NicoScrapingMangaUpdatedList extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'scraping:list';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';


    /**
     * @var NicoComicRepository
     */
    public $nicoComicRepository;

    /**
     * @var TagRepository
     */
    public $tagRepository;


    /**
     * NicoScraping constructor.
     * @param NicoComicRepository $nicoComicRepository
     * @param TagRepository $tagRepository
     */
    public function __construct(
        NicoComicRepository $nicoComicRepository,
        TagRepository $tagRepository
    )
    {
        parent::__construct();
        $this->nicoComicRepository = $nicoComicRepository;
        $this->tagRepository = $tagRepository;
    }


    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $this->info('NicoScraping list');


        $old = new Carbon("2019-10-04");
        $latest = new Carbon("2019-10-05");

        //1日10ページ以上更新もあり得るので20ページ分見に行くように…
        $array_1 = range(1, 20);
        foreach ($array_1 as $i) {
            if ($this->nicoListUpdate($i, $old, $latest) === FALSE) {
                //FALSE が返ってきたら終了
                break;
            }
        }
        $this->info('ok');
    }


    /**
     * @param $page
     * @param $old
     * @param $latest
     * @return bool
     */
    public function nicoListUpdate($page, $old, $latest)
    {

        $list = \App\Helpers\NicoScrapingHelper::getNicoList($page);
        foreach ($list as $row) {
            $nico_no = $row['nico_no'];
            $comic_update_date = $row['comic_update_date'];

            if ($comic_update_date->between($old, $latest) === false) {
                return false;
            }

            $this->nicoComicRepository->saveNicoScraping($nico_no);
        }
        return true;
    }


}


