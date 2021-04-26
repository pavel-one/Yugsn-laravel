<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use App\Models\MaterialCategory;
use App\Models\User;
use App\Models\UserMaterial;
use Illuminate\Http\Request;
use PHPHtmlParser\Dom;

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
                'material' => $material,
                'sudo' => \Auth::user() && \Auth::user()->isSudo()
            ]);
        }

        $category = MaterialCategory::whereSlug($slug)->first();
        if ($category) {
            return $category;
        }

        return abort(404);
    }

    /**
     * Предпросмотр материала
     * @param string $slug
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|void
     */
    public function preview(string $slug)
    {
        $material = UserMaterial::whereSlug($slug)->first();
        if ($material) {
            return view('templates.material', [
                'material' => $material,
                'sudo' => false
            ]);
        }

        return abort(404);
    }

    /**
     * Обновление материала
     * @param string $slug
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(string $slug, Request $request)
    {
        /** @var UserMaterial|null $material */
        $material = UserMaterial::whereSlug($slug)->first();
        if (!$material) {
            abort(404);
        }

        $data = $request->post('data');

        $material->json_content = $data;
        $material->slug = $slug; //TODO: Фикс чтобы слаг не перегенерировался
        $material->save();

        return $this->api_success($material->toArray(), 'Успешно');
    }

    /**
     * @throws \Spatie\MediaLibrary\MediaCollections\Exceptions\FileDoesNotExist
     * @throws \Spatie\MediaLibrary\MediaCollections\Exceptions\FileIsTooBig
     */
    public function upload(string $slug, Request $request)
    {
        /** @var UserMaterial|null $material */
        $material = UserMaterial::whereSlug($slug)->first();
        if (!$material) {
            abort(404);
        }

        if (!$request->file('image')) {
            return $this->api_error('Не передан файл');
        }

        $media = $material->addMedia($request->file('image'))
            ->toMediaCollection(
                UserMaterial::MATERIAL_IMAGES_COLLECTION,
                UserMaterial::MATERIAL_DISK_CONTENT
            );

        return response()->json([
            'success' => 1,
            'file' => [
                'url' => $media->getUrl()
            ]
        ]);
    }

    /**
     * Получает мета теги урла
     * @param string $slug
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function fetchUrl(string $slug, Request $request)
    {
        $dom = new Dom();
        $dom->loadFromUrl($request->get('url'));

        $parseUrl = parse_url($request->get('url'));

        $title = $dom->find('title')[0] ?? null;
        $description = $dom->find('[name=description]')[0] ?? null;

        $icon = $dom->find('[rel=icon]');
        if ($count = $icon->count()) {
            $icon = $parseUrl['scheme'].'://'.$parseUrl['host'].$icon[$count - 1]->href;
        }

        return response()->json([
            'success' => 1,
            'meta' => [
                'title' => $title->text,
                'description' => $description ? $description->content : '',
                'image' => [
                    'url' => $icon,
                ]
            ]
        ]);
    }

    /**
     * Создание комментария
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

        if ($request->post('parent')) {
            if (!Comment::whereId($request->post('parent'))->exists()) {
                return $this->api_error('Такого комментария не существует');
            }
        }

        $material->addComment(
            $request->post('text'),
            $material->id,
            $request->post('email'),
            $request->post('parent'),
            $request->post('username')
        );

        return $this->api_success([], 'Комментарий будет опубликован после проверки модератором');
    }
}
