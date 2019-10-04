<?php

namespace App\Console\Commands;

use App\Constants\TagTypeConstant;
use App\Helpers\NicoScrapingHelper;
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
        $data = NicoScrapingHelper::manga_updated_url($no);
        if ($data === false) {
            return false;
        }
        $this->nicoComicRepository->save($data);
        return;
    }


}


