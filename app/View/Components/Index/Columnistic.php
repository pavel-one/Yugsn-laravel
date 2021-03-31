<?php

namespace App\View\Components\Index;

use App\Models\MaterialCategory;
use App\Models\UserMaterial;
use App\Providers\RouteServiceProvider;
use Illuminate\View\Component;

class Columnistic extends Component
{
    private $categoryName;
    private $category;
    private $materials;

    /**
     * Create a new component instance.
     *
     * @param string $categoryName
     */
    public function __construct(string $categoryName)
    {
        $this->categoryName = $categoryName;
        $this->category = $category = MaterialCategory::whereName($categoryName)->first();

        $this->materials = \Cache::remember('index-columnistic_' . RouteServiceProvider::getRegion(), 60 * 10, function () use ($category) {
            return UserMaterial::findMini($category, true)
                ->limit(6)
                ->get()
                ->all();
        });

    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|string
     */
    public function render()
    {
        if (!$this->materials) {
            return null;
        }
        return view('components.index.columnistic', [
            'category' => $this->category,
            'materials' => $this->materials
        ]);
    }
}
