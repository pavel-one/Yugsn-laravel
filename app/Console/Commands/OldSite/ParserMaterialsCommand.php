<?php

namespace App\Console\Commands\OldSite;

use App\Console\Services\ParserService;
use Illuminate\Console\Command;

class ParserMaterialsCommand extends Command
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

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $type = $this->choice('Что обновить?', [
            0 => ParserService::TYPE_MATERIAL,
            1 => ParserService::TYPE_REGIONS,
            2 => ParserService::TYPE_ALL
        ], ParserService::TYPE_MATERIAL, 2);


        $limit = (int) $this->ask('Сколько парсить? [0]') ?? 0;
        $category = $this->choice('Найдены категории, какую парсить?', ParserService::getAllCategories());

        $service = new ParserService($type, $category, $limit);


        $service->update($this);
    }
}
