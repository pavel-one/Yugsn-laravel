<?php

namespace App\Http\Controllers;

use App\Models\MaterialCategory;
use App\Models\User;
use App\Models\UserMaterial;
use App\Providers\AppServiceProvider;
use Illuminate\Http\Request;

class SiteController extends Controller
{
    /**
     * Главная страница
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function index()
    {
        return view('templates.index');
    }

    /**
     * Страница категории или материала
     * @param string $slug
     * @return MaterialCategory|\Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Database\Eloquent\Builder|\Illuminate\Database\Eloquent\Model|object|void
     */
    public function categoryOrMaterial(string $slug)
    {
        $material = UserMaterial::whereSlug($slug)->first();
        if ($material) {
            return view('templates.material', [
                'material' => $material
            ]);
        }

        $category = MaterialCategory::whereSlug($slug)->first();
        if ($category) {
            return $category;
        }

        return abort(404);
    }

    /**
     * Страница ленты новостей
     * @return string
     */
    public function news()
    {
        return 'В разработке';
    }

    /**
     * Страница пользователя
     * @param string $id
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function user(string $id)
    {
        $id = (int)\Crypt::decryptString($id);
        $user = User::whereId($id)->firstOrFail();

        $materials = \Cache::remember('user_materials_' . $user->id, 60 * 10, function () use ($user) {
            return UserMaterial::findMini(null, true)->where([
                'user_id' => $user->id
            ])->paginate(18);
        });

        return view('templates.user', [
            'count' => \DeclensionNoun::make($materials->count(), 'запись'),
            'materials' => $materials,
            'user' => $user
        ]);
    }

    public function test()
    {
        dd(
            UserMaterial::findMini(MaterialCategory::first())
                ->whereRaw("JSON_CONTAINS(regions, '\"22\"', '$')")
                ->limit(10)
                ->get()
                ->all()
        );
    }
}
