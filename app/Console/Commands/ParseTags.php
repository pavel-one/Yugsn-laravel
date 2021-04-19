<?php

namespace App\Console\Commands;

use App\Models\MaterialTags;
use App\Models\UserMaterial;
use Illuminate\Console\Command;

class ParseTags extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'tag:parser';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Парсит теги существующих материалов';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return bool
     */
    public function handle(): bool
    {
        $this->info("Очищаем старые теги \n");
        \DB::table('material_tags')->truncate();

        $this->info("Парсим новые теги \n");
        $query = UserMaterial::orderByDesc('id')->get();
        $bar = $this->getOutput()->createProgressBar($query->count());
        $bar->start();

        $query->each(function ($item) use ($bar) {
            /** @var UserMaterial $item */
            $item->parseTags();
            $bar->advance();
        });

        $bar->finish();

        return true;
    }
}
