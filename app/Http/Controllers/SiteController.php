<?php

namespace App\Http\Controllers;

use App\Models\UserMaterial;
use Illuminate\Http\Request;
use Laravel\Nova\NovaCoreServiceProvider;

class SiteController extends Controller
{
    public function index()
    {
        dd(NovaCoreServiceProvider::$publishes);
        return view('templates.index');
    }
}
