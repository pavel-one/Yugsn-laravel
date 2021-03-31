<?php

namespace App\View\Components\Chunks;

use App\Models\MaterialCategory;
use App\Models\UserMaterial;
use App\Providers\RouteServiceProvider;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class Sidebar extends Component
{
    public const TYPE_INDEX = 1;

    private ?string $categoryName;
    /** @var MaterialCategory  */
    private $category;
    private int $type;

    /** @var UserMaterial[] */
    private $miniMaterials;
    /** @var UserMaterial[] */
    private $populars;

    /**
     * Create a new component instance.
     *
     * @param int $type
     * @param string|null $categoryName
     */
    public function __construct(int $type, string $categoryName = null)
    {
        $this->type = $type;
        $this->categoryName = $categoryName;


        if ($categoryName) {
            $this->category = MaterialCategory::whereName($categoryName)->first();
        } else {
            $this->category = MaterialCategory::inRandomOrder()->first();
        }

        $category = $this->category;

        $this->miniMaterials = UserMaterial::findMini($category)
            ->limit(5)
            ->get()
            ->all();

        $this->populars = \Cache::remember('popular-mini_' . RouteServiceProvider::getRegion(), 60*10, function () {
            return UserMaterial::findMini()
                ->orderBy('views', 'desc')
                ->limit(5)
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
        if (!$this->miniMaterials) {
            return null;
        }
        return view('components.chunks.sidebar', [
            'materials' => $this->miniMaterials,
            'populars' => $this->populars,
            'category' => $this->category
        ]);
    }
}
