<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;

class ConfirmController extends Controller
{
    public function index(Request $request)
    {
        // 入力値を取得
        $lists = $request->only(['gender', 'email', 'address', 'building', 'detail']);

        // 名前を結合する
        $names = $request->only((['first_name', 'last_name']));
        $name = $names['first_name'] . ' ' . $names['last_name'];
        // 名前を追加
        $lists['name'] = $name;

        // 電話番号を結合する
        $tels = $request->only((['tel1', 'tel2', 'tel3']));
        $tel = $tels['tel1'] . $tels['tel2'] . $tels['tel3'];
        // 電話番号を追加
        $lists['tel'] = $tel;

        // お問い合わせの種類を取得
        $categories = Category::all();
        $category_id = $request->only(['category_id']);
        $category = $categories->find($category_id)->pluck('content')->first();
        // お問い合わせの種類を追加
        $lists['category'] = $category;

        return view('confirm', compact('lists'));
    }
}
