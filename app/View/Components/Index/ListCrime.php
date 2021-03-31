<?php

namespace App\View\Components\Index;

use App\Models\MaterialCategory;
use App\Models\UserMaterial;
use App\Providers\RouteServiceProvider;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class ListCrime extends Component
{
    /** @var UserMaterial[]  */
    public $materials;
    /** @var UserMaterial */
    public $firstMaterial;
    /** @var UserMaterial[] */
    public $secondMaterials;

    /** @var MaterialCategory */
    public $category;

    /**
     * Create a new component instance.
     *
     * @param $categoryName
     * @param $limit
     */
    public function __construct($categoryName, $limit)
    {
        /** @var MaterialCategory $category */
        $this->category = $category = MaterialCategory::whereName($categoryName)->first();

        if (!$category) {
            return false;
        }

        $this->firstMaterial = \Cache::remember('list-crime-first_' . RouteServiceProvider::getRegion(), 60 * 10, function () use ($category) {
            return UserMaterial::findMini($category, true)->first();
        });
        $limit = $limit - 1;

        $this->secondMaterials = \Cache::remember('list-crime-second_' . RouteServiceProvider::getRegion(), 60 * 10, function () use ($category) {
            return UserMaterial::findMini($category)
                ->limit(2)
                ->offset(1)
                ->get()
                ->all();
        });
        $limit = $limit - 2;

        $this->materials = \Cache::remember('list-crime-materials_' . RouteServiceProvider::getRegion(), 60 * 10, function () use ($category, $limit) {
            return UserMaterial::findMini($category, true)
                ->offset(3)
                ->limit($limit)
                ->get()
                ->all();
        });
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return View|string
     */
    public function render()
    {
        if (!$this->materials) {
            return null;
        }
        return view('components.index.list-crime', [
            'materials' => $this->materials,
            'first' => $this->firstMaterial,
            'secondMaterials' => $this->secondMaterials,
            'category' => $this->category
        ]);
    }
}
