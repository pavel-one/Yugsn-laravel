<?php

namespace App\Console\Commands;

use App\Models\UserMaterial;
use Illuminate\Console\Command;

class MediaClear extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'media:clear';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Очистка всех медиа объектов';

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
     * @return int
     */
    public function handle()
    {
        $bar = $this->output->createProgressBar(UserMaterial::count('id'));

        $bar->start();
        UserMaterial::each(function ($item) use ($bar) {
            /** @var UserMaterial $item */
            $item->clearMediaCollection();
            $bar->advance();
        });
        $bar->finish();
    }
}
