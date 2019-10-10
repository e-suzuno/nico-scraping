<?php

namespace App\Console\Commands;

use App\Constants\TagTypeConstant;
use App\Repositories\NicoComic\NicoComicRepositoryInterface as NicoComicRepository;
use App\Repositories\Tag\TagRepositoryInterface as TagRepository;
use Carbon\Carbon;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Log;

class NicoScrapingMangaUpdatedList extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'scraping:list {day=1}';

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
        $day = $this->argument('day');


        $this->info('scraping:list ' . $day . ' start');
        Log::info("scraping:list {$day} start");


        $latest = Carbon::now()->endOfDay();

        $subDay = $day - 1;

        $old = new Carbon(Carbon::now()->subDay($subDay)->startOfDay());

        $updateList = array_reverse( $this->getUpdateList($day, $old, $latest) );

        foreach ($updateList as $row) {
            $nicoComic = $this->nicoComicRepository->findByNicoNo($row["nico_no"]);
            if($nicoComic){
                if ($row['comic_update_date']->isSameDay($nicoComic->comic_update_date)) {
                    continue;
                }
            }
            $this->nicoComicRepository->saveNicoScraping($row['nico_no']);
            //更新時間をずらすためにスリープ処理の追加
            sleep(1);
        }

        $this->info('complete');
        Log::info("scraping:list {$day} complete");
    }


    protected function getUpdateList($day, $old, $latest)
    {
        $updateList = [];
        $max_count = 20 * $day;
        for ($page = 1; $page <= $max_count; $page++) {
            $list = \NicoScraping::getNicoList($page);
            $collection = collect($list)->filter(function ($row, $key) use ($old, $latest) {
                $comic_update_date = $row['comic_update_date'];
                if (!($comic_update_date->gte($old) && $comic_update_date->lte($latest))) {
                    return false;
                }
                return true;
            });
            foreach ($collection->all() as $row) {
                $updateList[] = $row;
            }
        }
        return $updateList;
    }


}


