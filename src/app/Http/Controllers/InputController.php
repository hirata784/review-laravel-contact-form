<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;

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
