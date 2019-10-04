<?php

namespace App\Console\Commands;

use App\Constants\TagTypeConstant;
use App\Repositories\NicoComic\NicoComicRepositoryInterface as NicoComicRepository;
use App\Repositories\Tag\TagRepositoryInterface as TagRepository;
use Illuminate\Console\Command;

class NicoScrapingUpdate extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'scraping:update';

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
        $this->info('NicoScraping update');


        $nicoComics = $this->nicoComicRepository->find();


        $bar = $this->output->createProgressBar($nicoComics->count());
        $bar->start();

        $nicoComics->chunk(100, function ($chunk) use ($bar) {
            foreach ($chunk as $nicoComic) {
                $this->updateData($nicoComic->id, $nicoComic->nico_no);
                $bar->advance();
            }
            sleep(1);
        });

        $bar->finish();
        $this->info('ok');
    }


    /**
     * @param $id
     * @param $nico_no
     * @return bool|void
     */
    protected function updateData($id, $nico_no)
    {
        $data = getNicoMangaTargetPage($nico_no);
        if ($data === false) {
            return false;
        }
        $this->nicoComicRepository->save($data);
        return;
    }
}


