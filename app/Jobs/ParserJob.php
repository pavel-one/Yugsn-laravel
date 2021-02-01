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
        if (!$materialObject = $this->service->checkExists($materialData)) {
            $materialObject = UserMaterial::create($materialData);
        }
        UserMaterial::reguard();

        try {
            $materialObject->clearMediaCollection();
            $materialObject->addMediaFromUrl($this->service->base_url . $this->apiData['image'])->toMediaCollection();
        } catch (\Exception $e) {
            $this->service->error('ID: ' . $materialObject->id . ' - ' . $e->getMessage());
        }
    }
}
