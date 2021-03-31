<?php

namespace App\View\Components\Index;

use App\Models\UserMaterial;
use App\Providers\RouteServiceProvider;
use Illuminate\View\Component;

class SecondBlock extends Component
{
    public $materials;

    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->materials = \Cache::remember('region_index_second_block_' . RouteServiceProvider::getRegion(), 60*10, function () {
            return UserMaterial::findMini()
                ->offset(5)
                ->limit(4)
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
        return view('components.index.second-block', ['materials' => $this->materials]);
    }
}
