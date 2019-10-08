<?php

namespace App\Console\Commands;

use App\Constants\TagTypeConstant;

use App\Models\Config;
use App\Repositories\NicoComic\NicoComicRepositoryInterface as NicoComicRepository;
use App\Repositories\Tag\TagRepositoryInterface as TagRepository;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Log;

class NicoScrapingTarget extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'scraping:target {nico_no}';

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
        $nico_no = $this->argument('nico_no');
        $this->info('NicoScraping run');

        if ($this->nicoComicRepository->saveNicoScraping($nico_no) === TRUE) {

            $this->info('get nico_no:' . $nico_no . '');
        } else {
            $this->error('error nico_no:' . $nico_no . '');
        }


    }


}


