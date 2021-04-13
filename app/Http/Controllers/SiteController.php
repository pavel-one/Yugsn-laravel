<?php

namespace App\Http\Controllers;

use App\Models\MaterialCategory;
use App\Models\User;
use App\Models\UserMaterial;
use Illuminate\Http\Request;

class SiteController extends Controller
{
    public function index()
    {
        return view('templates.index');
    }

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

    public function news()
    {
        return 'В разработке';
    }

    public function tags(string $tag)
    {
        dd($tag);
    }

    public function user(string $id)
    {
        $id = (int) \Crypt::decryptString($id);

        return view('templates.user', [
            'user' => User::whereId($id)->firstOrFail()
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
