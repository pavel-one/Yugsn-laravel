<?php

namespace App\Console\Services;

use App\Models\UserMaterial;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class ParserService
{
    private $apiUrl;
    private $currentTypeUpdate;
    /** @var Command */
    private $console;

    public const TYPE_MATERIAL = 'Материалы';
    public const TYPE_REGIONS = 'Регионы';
    public const TYPE_ALL = 'Все';

    public function __construct(string $type)
    {
        $this->apiUrl = 'https://yugsn.ru/api/';
        $this->currentTypeUpdate = $type;
    }

    public function update(Command $console): self
    {
        $this->console = $console;

        if ($this->currentTypeUpdate === self::TYPE_MATERIAL) {
            return $this->parseMaterial();
        }

        if ($this->currentTypeUpdate === self::TYPE_REGIONS) {
            return $this->parseRegions();
        }

        return $this->parseAll();
    }

    public function parseMaterial(): ParserService
    {
        $start = microtime(true);
        $response = Http::get($this->apiUrl);
        $end = round(microtime(true) - $start, 4);

        $this->log("Сервер ответил за: $end секунды");

        $materials = json_decode($response->body(), true);

//        dd($materials[2]);

        foreach ($materials as $key => $material) {
            $this->log('Сохраняю: ' . $material['pagetitle']);

            UserMaterial::unguard();
            $model = UserMaterial::create([
                'title' => $material['pagetitle'] ?? 'Не задано',
                'user_id' => 1,
                'category_id' => 1,
                'long_title' => $material['pagetitle'] ?? 'не задано',
            ]);
            UserMaterial::reguard();
        }

        return $this;
    }

    public function parseRegions(): ParserService
    {
        return $this;
    }

    public function parseAll(): ParserService
    {
        $this->parseRegions()
            ->parseMaterial();

        return $this;
    }

    private function log(string $msg)
    {
        if ($this->console instanceof Command) {
            $this->console->info($msg);
        }

        Log::info($msg);
    }

}
