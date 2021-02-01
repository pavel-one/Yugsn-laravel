<?php

namespace App\Http\Controllers;

use App\Models\UserMaterial;
use Illuminate\Http\Request;

class SiteController extends Controller
{
    public function index()
    {
        return view('templates.index');
//        $material = UserMaterial::first(1);
    }
}
