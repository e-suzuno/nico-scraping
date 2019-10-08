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


        $now = new Carbon(date("Y/m/d"));
        $latest = new Carbon($now->addDay(1));


        $now = new Carbon(date("Y/m/d"));
        $old = new Carbon($now->subDay(7));


        $max_count = 20 * 7;
        for ($i = 1; $i <= $max_count; $i++) {
            $this->info($i . 'page start');
            if ($this->nicoListUpdate($i, $old, $latest) === FALSE) {
                //FALSE が返ってきたら終了
                break;
            }
            sleep(1);
            $this->info($i . 'page ok. go to next page');
        }
        $this->info('complete');
    }


    /**
     * @param int $page
     * @param Carbon $old
     * @param Carbon $latest
     * @return bool
     */
    public function nicoListUpdate(int $page, Carbon $old, Carbon $latest)
    {

        $list = \NicoScraping::getNicoList($page);
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


