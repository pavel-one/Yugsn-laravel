<?php

namespace App\Http\Controllers;

use App\Models\UserMaterial;
use App\Providers\AppServiceProvider;
use Illuminate\Http\Request;

class SearchController extends Controller
{
    /**
     * Страница поиска
     * TODO: Доработать [POST] и логику
     * @param Request $request
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function search(Request $request)
    {
        $search = $request->post('query');
        if (strlen($search) < 3) {
            return $this->error('Запрос должен быть больше трех символов');
        }

        $materials = \Cache::remember('search_' . $search, AppServiceProvider::DEFAULT_CACHE_TIMES, function () use ($search) {
            return UserMaterial::findMini(null, true)
                ->where('title', 'like', '%' . $search . '%')
                ->limit(100)
                ->paginate(UserMaterial::DEFAULT_PER_PAGE);
        });

        return view('templates.search', [
            'materials' => $materials
        ]);
    }

    public function searchApi(Request $request)
    {
        $search = $request->post('query');
        if (strlen($search) < 3) {
            return $this->api_error('Запрос должен быть больше трех символов');
        }

        return \Cache::remember('search_api_' . $search, AppServiceProvider::DEFAULT_CACHE_TIMES, function () use ($search) {
            return UserMaterial::findMini(null, true)
                ->where('title', 'like', '%' . $search . '%')
                ->limit(20);
        });
    }


    /**
     * Страница тега
     * TODO: Доработать логику, сделать выборку JSON
     * @param string $tag
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function tags(string $tag)
    {
        $materials = \Cache::remember('tag_' . $tag, AppServiceProvider::DEFAULT_CACHE_TIMES, function () use ($tag) {
            return UserMaterial::findMini(null, true)
                ->where('tags', 'like', '%' . $tag . '%')
                ->limit(100)
                ->paginate(UserMaterial::DEFAULT_PER_PAGE);
        });

        return view('templates.search', [
            'materials' => $materials
        ]);
    }
}
