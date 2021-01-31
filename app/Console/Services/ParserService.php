<?php

namespace App\Console\Services;

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
    private $apiUrl;
    private $base_url;
    private $currentTypeUpdate;

    /** @var Command */
    private $console;

    public const TYPE_MATERIAL = 'Материалы';
    public const TYPE_REGIONS = 'Регионы';
    public const TYPE_ALL = 'Все';

    public function __construct(string $type)
    {
        $this->base_url = 'https://yugsn.ru/';
        $this->apiUrl = $this->base_url . 'api/';
        $this->currentTypeUpdate = $type;
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
        $response = Http::get($this->apiUrl)->json();

        $bar = $this->console->getOutput()->createProgressBar(count($response));
        $bar->start();
        foreach ($response as $material) {
            UserMaterial::unguard();
            $materialData = $this->formatMaterial($material);
            if (!$materialObject = $this->checkExists($materialData)) {
                $materialObject = UserMaterial::create($materialData);
            }
            UserMaterial::reguard();

            try {
                $materialObject->clearMediaCollection();
                $materialObject->addMediaFromUrl($this->base_url . $material['image'])->toMediaCollection();
            } catch (\Exception $e) {
                $this->error('ID: ' . $materialObject->id . ' - ' . $e->getMessage());
            }

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
    private function checkExists(array $data): ?UserMaterial
    {
        $check = UserMaterial::where([
            'slug' => $data['slug']
        ])->exists();

        if (!$check) {
            return null;
        }

        return UserMaterial::first([
            'slug' => $data['slug']
        ]);
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
    private function formatMaterial(array $material): array
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

        Log::info($msg);
    }

    /**
     * @param string $msg
     */
    private function error(string $msg)
    {
        if ($this->console instanceof Command) {
            $this->console->newLine();
            $this->console->error($msg);
        }

        Log::error($msg);
    }

}
