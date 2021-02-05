<?php

namespace App\View\Components\Index;

use App\Models\UserMaterial;
use Illuminate\View\Component;

class FirstBlock extends Component
{
    public $material_big;
    public $materials;

    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct()
    {
        $materials_all = \Cache::remember('region_index_first_block', 60 * 10, function () {
            return UserMaterial::findMini()
                ->limit(5)
                ->get()
                ->all();
        });

        $this->material_big = $materials_all[0];
        unset($materials_all[0]);
        $this->materials = $materials_all;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|string
     */
    public function render()
    {
        return view('components.index.first-block');
    }
}
