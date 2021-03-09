<?php

namespace App\View\Components;

use App\Models\MaterialCategory;
use App\Models\RegionCategory;
use Illuminate\View\Component;

class Menu extends Component
{
    private $categories;
    private $regions;

    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->categories = \Cache::remember('categories', 600, function () {
            return MaterialCategory::all();
        });
        $this->regions = \Cache::remember('regions', 600, function () {
            return RegionCategory::all();
        });
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|string
     */
    public function render()
    {
        return view('components.menu', [
            'categories' => $this->categories,
            'regions' => $this->regions
        ]);
    }
}
