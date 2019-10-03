<?php

namespace App\Console\Commands;

use App\Repositories\NicoComic\NicoComicRepositoryInterface as NicoComicRepository;
use App\Repositories\Tag\TagRepositoryInterface as TagRepository;
use Illuminate\Console\Command;

class NicoScraping extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'scraping:run';

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
        $this->info('NicoScraping run');


        $from = $this->nicoComicRepository->getMaxNicoNo();
        if (!$from) {
            $from = 1;
        }
        $count = 1000;

        $bar = $this->output->createProgressBar($count);
        $bar->start();
        $to = $from + $count;
        for ($i = $from; $i < $to; $i++) {
            $this->createData($i);
            $bar->advance();
        }
        $bar->finish();
        $this->info('ok');
    }


    /**
     * @param $no
     * @return bool|void
     */
    protected function createData($no)
    {
        $data = getNicoMangaTargetPage($no);
        if ($data === false) {
            return false;
        }
        $tags = [];

        $tags[] = getTagId($data['category'], 1);
        $tags[] = getTagId($data['official_title'], 2);


        //文章からのオートタグ
        $auto_tags = autoTagCheck($data['title'], $data['description']);
        foreach ($auto_tags as $auto_tag) {
            $tags[] = $auto_tag;
        }


        $data['tags_json'] = $tags;
        $attribute = collect($data)->only([
            "title",
            "author",
            "description",
            "nico_no",
            "comic_start_date",
            "comic_update_date",
            "story_number",
            "tags_json"
        ])->toArray();


        $nicoComic = $this->nicoComicRepository->findByNicoNo($attribute["nico_no"]);
        if ($nicoComic) {
            //更新

        } else {
            //新規作成
            $this->nicoComicRepository->create($attribute);
        }

        return;
    }


    public function autoTagCheck()
    {

    }
}


