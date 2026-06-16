<?php

namespace App\Http\Controllers;

use App\Models\Category;

class InputController extends Controller
{
    public function index()
    {
        $categories = Category::all();
        // categoriesからcontentのみ取得
        $lists = $categories->pluck('content');
        return view('input', compact('lists'));
    }
}
