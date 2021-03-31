<?php

namespace App\View\Components\Index;

use App\Models\MaterialCategory;
use App\Models\UserMaterial;
use App\Providers\RouteServiceProvider;
use Illuminate\View\Component;

class ListSocietyBlock extends Component
{
    /** @var UserMaterial[] */
    public $materials;
    /** @var MaterialCategory */
    public $category;

    /**
     * Create a new component instance.
     *
     * @param $categoryName
     * @param $limit
     */
    public function __construct(string $categoryName, int $limit)
    {
        $category = $this->category = MaterialCategory::whereName($categoryName)->first();

        $this->materials = \Cache::remember('list-society_' . RouteServiceProvider::getRegion(), 60 * 10, function () use ($category, $limit) {
            return UserMaterial::findMini($category)
                ->limit($limit)
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
        return view('components.index.list-society-block', [
            'materials' => $this->materials,
            'category' => $this->category
        ]);
    }
}
