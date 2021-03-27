<?php

namespace App\Console\Services;

use App\Jobs\ParserJob;
use App\Models\MaterialCategory;
use App\Models\Region;
use App\Models\RegionCategory;
use App\Models\UserMaterial;
use Carbon\Carbon;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class ParserService
{
    public string $base_url;
    private string $apiUrl;
    private string $currentTypeUpdate;

    private $category;

    private int $limit;

    /** @var Command */
    private Command $console;

    public const TYPE_MATERIAL = 'Материалы';
    public const TYPE_REGIONS = 'Регионы';
    public const TYPE_ALL = 'Все';

    public function __construct(string $type, string $category = null, int $limit = 0)
    {
        $this->base_url = 'https://yugsn.ru/';
        $this->apiUrl = $this->base_url . 'api/';
        $this->currentTypeUpdate = $type;
        $this->limit = $limit;
        $this->category = null;

        if ($category !== 'Все') {
            $this->category = $category;
        }
    }

    /**
     * Получить все категории
     * @return array
     */
    public static function getAllCategories(): array
    {
        $response = Http::get('https://yugsn.ru/api/')->json();

        $out = [];

        foreach ($response as $item) {
            $out[] = $item['category_name'];
        }

        $out = array_unique($out);
        $result = ['Все'];

        foreach ($out as $item) {
            $result[] = $item;
        }

        return $result;
    }

    /**
     * Метод обновления БД с API, точка входа
     *
     * @param Command $console
     * @return $this
     */
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

    /**
     * Метод парсинга материалов
     *
     * @return $this
     */
    public function parseMaterial(): ParserService
    {
        $this->log('Начинаю парсить материалы');
        $start = microtime(true);
        $response = $this->getMaterialsWithFilter();
        $end = microtime(true) - $start;
        $this->log("Данные получены за $end секунд, добавляю в очередь");

        if ($this->limit) {
            if ($this->limit > count($response)) {
                $this->limit = count($response);
            }

            $bar = $this->console->getOutput()->createProgressBar($this->limit);
            $bar->start();

            for ($i = 0; $i < $this->limit; $i++) {
                $material = $response[rand(0, count($response) - 1)];
                $job = new ParserJob($material);
                dispatch($job);

                $bar->advance();
            }

            $bar->finish();

            return $this;
        }

        $bar = $this->console->getOutput()->createProgressBar(count($response));
        $bar->start();
        foreach ($response as $material) {

            $job = new ParserJob($material);
            dispatch($job);

            $bar->advance();
        }
        $bar->finish();

        return $this;
    }

    /**
     * Метод парсинга регионов
     *
     * @return $this
     */
    public function parseRegions(): ParserService
    {
        $this->log('Начинаю парсить регионы');

        $response = Http::get($this->apiUrl . '?regions=1')->json();

        $bar = $this->console->getOutput()->createProgressBar(count($response));
        $bar->start();
        foreach ($response as $region) {
            if (Region::whereId([$region['id']])->exists()) {
                continue;
            }

            $obj = new Region();
            $obj->id = $region['id'];
            $obj->name = $region['name'];
            $obj->alias = $region['alias'];
            $obj->region_category_id = $this->getRegionCategoryId($region['category_name']);
            $obj->save();
            $bar->advance();
        }
        $bar->finish();

        return $this;
    }

    /**
     * Спарсить все, в нужном порядке
     * @return $this
     */
    public function parseAll(): ParserService
    {
        $this->parseRegions()
            ->parseMaterial();

        return $this;
    }

    /**
     * Проверяет существование материала
     *
     * @param array $data
     * @return UserMaterial|null
     */
    public function checkExists(array $data): ?UserMaterial
    {
        $check = UserMaterial::where([
            'slug' => $data['slug']
        ])->exists();

        if (!$check) {
            return null;
        }

        return UserMaterial::whereSlug($data['slug'])->first();
    }

    /**
     * Получает ID категории региона, или создает эту категорию
     *
     * @param string $categoryName
     * @return int
     */
    private function getRegionCategoryId(string $categoryName): int
    {
        return RegionCategory::firstOrCreate([
            'name' => $categoryName
        ])->id;
    }

    /**
     * Формирует необходимый для сохранения
     * массив из данных получаемых с API
     *
     * @param array $material
     * @return array
     */
    public function formatMaterial(array $material): array
    {
        return [
            'title' => $material['title'] ?? 'Не задано',
            'user_id' => 1,
            'long_title' => $material['long_title'] ?? 'не задано',
            'slug' => $material['slug'],
            'published' => (bool)$material['published'],
            'regions' => ($material['regions'] === '') ? null : $material['regions'],
            'views' => (int)$material['views'],
            'created_at' => Carbon::createFromTimestamp($material['createdon']),
            'published_time' => Carbon::createFromTimestamp($material['publishedon']),
            'content' => $this->getContent((int)$material['id']),
            'category_id' => $this->createOrGetCategory($material['category_name'])
        ];
    }

    /**
     * Отдает список материалов с применением фильтров
     * @return array
     */
    private function getMaterialsWithFilter(): array
    {
        $out = Http::get($this->apiUrl)->json();
        $result = [];

        foreach ($out as $item) {
            if ($this->category && ($item['category_name'] !== $this->category)) {
                continue;
            }

            $result[] = $item;
        }

        $this->log("В категории <{$this->category}> найдено ".count($result).' материалов');

        return $result;
    }

    /**
     * Получает или создает категорию материала
     *
     * @param string $categoryName
     * @return int
     */
    private function createOrGetCategory(string $categoryName): int
    {
        return MaterialCategory::firstOrCreate([
            'name' => $categoryName
        ])->id;
    }

    /**
     * Получает текст статьи с API
     *
     * @param int $id
     * @return string
     */
    private function getContent(int $id): string
    {
        return Http::get($this->apiUrl . '?id=' . $id)->body();
    }

    /**
     * @param string $msg
     */
    private function log(string $msg)
    {
        if ($this->console instanceof Command) {
            $this->console->newLine();
            $this->console->info($msg);
        }

        Log::channel('parser')->info($msg);
    }

    /**
     * @param string $msg
     */
    public function error(string $msg)
    {
        if ($this->console instanceof Command) {
            $this->console->newLine();
            $this->console->error($msg);
        }

        Log::channel('parser')->error($msg);
    }

}
