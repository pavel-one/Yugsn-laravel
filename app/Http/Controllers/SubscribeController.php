<?php

namespace App\Http\Controllers;

use App\Models\UserSubscriber;
use Illuminate\Http\Request;

class SubscribeController extends Controller
{
    /**
     * Подписка на новости
     * TODO: Запретить не ajax
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(Request $request)
    {
        $request->validate([
            'email' => 'required|unique:user_subscribers|max:255|email:rfc,dns'
        ]);

        $subscriber = UserSubscriber::create([
            'email' => $request->post('email')
        ]);

        return $this->api_success($subscriber->toArray(), 'Успешно');
    }
}
