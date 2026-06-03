<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Contact;
use App\Models\Category;

class AdminController extends Controller
{
    public function index()
    {
        // contactテーブルを取得
        $contacts = Contact::all();
        // categoriesテーブルを取得
        $categories = Category::all();

        $lists = [];

        foreach ($contacts as $key => $contact) {
            $lists[$key]['first_name'] = $contact['first_name'];
            $lists[$key]['last_name'] = $contact['last_name'];
            $lists[$key]['email'] = $contact['email'];

            // 性別を文字列へ変換
            $gender_num = $contact['gender'];
            $gender = "";
            if ($gender_num === 1) {
                $gender = "男性";
            } elseif ($gender_num === 2) {
                $gender = "女性";
            } elseif ($gender_num === 3) {
                $gender = "その他";
            }
            // 性別を追加
            $lists[$key]['gender'] = $gender;

            // お問い合わせの種類を文字列に変換
            $category_id = $contact['category_id'];
            $category = $categories->where('id', $category_id)->pluck('content')->first();
            // お問い合わせの種類を追加
            $lists[$key]['category'] = $category;
        }

        // お問い合わせの種類セレクトボックス値作成
        foreach ($categories as $key => $category) {
            $select_category[$key] = $category['content'];
        }

        return view('admin', compact('lists', 'select_category'));
    }
}
