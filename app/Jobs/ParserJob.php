<?php

namespace App\Jobs;

use App\Console\Services\ParserService;
use App\Models\UserMaterial;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class ParserJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public $apiData;
    private $service;

    /**
     * Create a new job instance.
     *
     * @param array $data
     */
    public function __construct(array $data)
    {
        $this->apiData = $data;
        $this->service = new ParserService(ParserService::TYPE_REGIONS);
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        UserMaterial::unguard();
        $materialData = $this->service->formatMaterial($this->apiData);
        $this->log('Добавляю данные:');
        $this->log($materialData);

        if (!$materialObject = $this->service->checkExists($materialData)) {
            $this->log('Данные не найдены, создаю новые');
            $materialObject = UserMaterial::create($materialData);
            if ($materialObject instanceof UserMaterial) {
                $this->log('Создание успешно', true);
            }
        } else {
            $this->log('Данные найдены, обновляю медиа');
        }
        UserMaterial::reguard();

        try {
            $materialObject->clearMediaCollection(UserMaterial::MATERIAL_FIRST_IMAGES_COLLECTION);
            $materialObject->addMediaFromUrl($this->service->base_url . $this->apiData['image'], 'image/*')
                ->toMediaCollection('preview');
        } catch (\Exception $e) {
            $this->error('ID: ' . $materialObject->id . ' - ' . $e->getMessage());
        }
    }

    private function log($msg, $success = false)
    {
        if ($success) {
            \Log::channel('parser-queue')->info($msg);
            return;
        }
        \Log::channel('parser-queue')->notice($msg);
    }

    private function error(string $msg)
    {
        \Log::channel('parser-queue')->error($msg);
    }
}
