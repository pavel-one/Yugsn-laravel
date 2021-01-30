<?php

namespace App\Console\Services;

use App\Models\MaterialCategory;
use App\Models\UserMaterial;
use Carbon\Carbon;
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
        $this->log('Начинаю парсить материалы');
        $response = Http::get($this->apiUrl)->json();

        $bar = $this->console->getOutput()->createProgressBar(count($response));
        $bar->start();
        foreach ($response as $material) {
            UserMaterial::unguard();
            UserMaterial::create($this->formatMaterial($material));
            UserMaterial::reguard();

            $bar->advance();
        }

        $bar->finish();

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

    private function formatMaterial(array $material): array
    {
        return [
            'title' => $material['title'] ?? 'Не задано',
            'user_id' => 1,
            'long_title' => $material['long_title'] ?? 'не задано',
            'slug' => $material['slug'],
            'published' => (bool) $material['published'],
            'regions' => ($material['regions'] === '') ? null : $material['regions'],
            'views' => (int) $material['views'],
            'created_at' => Carbon::createFromTimestamp($material['createdon']),
            'published_time' => Carbon::createFromTimestamp($material['publishedon']),
            'content' => $this->getContent((int) $material['id']),
            'category_id' => $this->createOrGetCategory($material['category_name'])
        ];
    }

    private function createOrGetCategory(string $categoryName): int
    {
        return MaterialCategory::firstOrCreate([
            'name' => $categoryName
        ])->id;
    }

    private function getContent(int $id): string
    {
        return Http::get($this->apiUrl.'?id='.$id)->body();
    }

    private function log(string $msg)
    {
        if ($this->console instanceof Command) {
            $this->console->info($msg);
        }

        Log::info($msg);
    }

}
