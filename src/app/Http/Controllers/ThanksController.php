<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Contact;
use Illuminate\Http\Request;

class ThanksController extends Controller
{
    public function index(Request $request)
    {
        // 入力値を取得
        $contacts = $request->only(['lists']);

        // 性別を数値へ変換
        $gender_str = $contacts['lists']['gender'];
        $gender = 0;
        if ($gender_str === "男性") {
            $gender = 1;
        } elseif ($gender_str === "女性") {
            $gender = 2;
        } elseif ($gender_str === "その他") {
            $gender = 3;
        }
        // 性別を追加
        $contacts['lists']['gender'] = $gender;

        // お問い合わせの種類を数値に変換
        $categories = Category::all();
        $category = $contacts['lists']['category'];
        $category_id = $categories->where('content', $category)->pluck('id')->first();
        // お問い合わせの種類を追加
        $contacts['lists']['category_id'] = $category_id;

        // 不必要な要素を削除(nameとcategory)
        unset($contacts['lists']['name']);
        unset($contacts['lists']['category']);

        // contactsテーブルに登録
        Contact::create($contacts['lists']);

        return view('thanks');
    }
}
