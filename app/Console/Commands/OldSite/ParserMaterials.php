<?php

namespace App\Console\Commands\OldSite;

use App\Console\Services\ParserService;
use Illuminate\Console\Command;

class ParserMaterials extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'parser';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Подтягивание категорий и материалов со старого сайта';
    protected $service;

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->service = new ParserService();

        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $type = $this->choice('Что обновить?', [
            0 => ParserService::TYPE_MATERIAL,
            1 => ParserService::TYPE_CATEGORIES
        ], ParserService::TYPE_MATERIAL, 2);

        dd($type);
    }
}
