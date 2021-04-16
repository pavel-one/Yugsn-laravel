<?php

namespace App\Http\Controllers;

use App\Models\UserMaterial;
use App\Providers\AppServiceProvider;
use Illuminate\Http\Request;

class SearchController extends Controller
{
    /**
     * Страница поиска
     * @param Request $request
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function search(Request $request)
    {
        $search = urldecode($request->get('query'));
        if (mb_strlen($search) < 3) {
            return $this->error('Запрос должен быть больше трех символов');
        }

        $materials = \Cache::remember('search_' . $search, AppServiceProvider::DEFAULT_CACHE_TIMES, function () use ($search) {
            return UserMaterial::findMini(null, true)
                ->where('title', 'like', '%' . $search . '%')
                ->paginate(UserMaterial::DEFAULT_PER_PAGE);
        });

        return view('templates.search', [
            'materials' => $materials,
            'query' => $search
        ]);
    }

    public function searchApi(Request $request)
    {
        $search = $request->post('query');
        if (mb_strlen($search) < 3) {
            return $this->api_error('Запрос должен быть больше трех символов');
        }

        return response()->json(\Cache::remember('search_api_' . $search, AppServiceProvider::DEFAULT_CACHE_TIMES, function () use ($search) {
            return UserMaterial::findMini(null, true)
                ->select('id', 'title', 'slug')
                ->where('title', 'like', '%' . $search . '%')
                ->limit(20)
                ->get()
                ->all();
        }));
    }


    /**
     * Страница тега
     * @param string $tag
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function tags(string $tag)
    {
        $materials = \Cache::remember('tag_' . $tag, AppServiceProvider::DEFAULT_CACHE_TIMES, function () use ($tag) {
            return UserMaterial::findMini(null, true)
                ->whereRaw("JSON_CONTAINS(tags, '\"{$tag}\"', '$')")
                ->paginate(UserMaterial::DEFAULT_PER_PAGE);
        });

        return view('templates.tag', [
            'materials' => $materials,
            'tag' => $tag
        ]);
    }
}
