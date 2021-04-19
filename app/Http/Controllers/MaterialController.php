<?php

namespace App\Http\Controllers;

use App\Models\MaterialCategory;
use App\Models\User;
use App\Models\UserMaterial;
use Illuminate\Http\Request;

class MaterialController extends Controller
{
    /**
     * Страница категории или материала
     * @param string $slug
     * @return MaterialCategory|\Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Database\Eloquent\Builder|\Illuminate\Database\Eloquent\Model|object|void
     */
    public function view(string $slug)
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
     * Создание комментария
     * TODO: Запретить не ajax
     * @param string $slug
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse|void
     */
    public function comment(string $slug, Request $request)
    {
        $material = UserMaterial::whereSlug($slug)->first();
        if (!$material instanceof UserMaterial) {
            return abort(404);
        }

        $request->validate([
            'text' => 'required|string|min:3',
            'email' => 'nullable|email',
            'username' => 'nullable|string|min:3',
            'parent' => 'nullable|integer'
        ]);

        $material->addComment(
            $request->post('text'),
            $material->id,
            $request->post('email'),
            $request->post('parent'),
            $request->post('username')
        );

        return $this->api_success([], 'Успешно');
    }
}
