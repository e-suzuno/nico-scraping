<?php

namespace App\Console\Commands;

use App\Constants\TagTypeConstant;

use App\Models\Config;
use App\Repositories\NicoComic\NicoComicRepositoryInterface as NicoComicRepository;
use App\Repositories\Tag\TagRepositoryInterface as TagRepository;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Log;

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
     * @var int
     */
    public $scraping_count;

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

        $this->scraping_count = config('my-app.nico-scraping-count');


        $this->info('NicoScraping run');

        $config = \App\Models\Config::all()->first();
        if (!$config) {
            $config = new Config(['scraping_num' => 1]);
        }

        $from = $config->scraping_num;
        $last_no = $from;


        $count = $this->scraping_count;

        $bar = $this->output->createProgressBar($count);
        $bar->start();
        $to = $from + $count;
        for ($i = $from; $i < $to; $i++) {
            if ($this->nicoComicRepository->saveNicoScraping($i) === TRUE) {
                $last_no = $i;
            }
            $bar->advance();
        }
        $bar->finish();


        $config->scraping_num = $last_no;
        $config->save();


        $this->info('ok');

        Log::info("scraping ok get NO:{$from}=>{$last_no}");
    }


}


