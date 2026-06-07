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
            $lists[$key]['id'] = $contact['id'];
            $lists[$key]['first_name'] = $contact['first_name'];
            $lists[$key]['last_name'] = $contact['last_name'];
            $lists[$key]['email'] = $contact['email'];
            $lists[$key]['tel'] = $contact['tel'];
            $lists[$key]['address'] = $contact['address'];
            $lists[$key]['building'] = $contact['building'];
            $lists[$key]['detail'] = $contact['detail'];

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

    public function search(Request $request)
    {
        // contactテーブルを取得
        $contacts = Contact::all();
        // categoriesテーブルを取得
        $categories = Category::all();
        // 入力値を取得
        $searches = $request->only(['text', 'gender', 'category_id', 'created_at']);
        // textのスペース削除
        $searches['text'] = str_replace(' ', '', $searches['text']);
        $lists = [];

        // whenを使い、検索条件が空白のとき、whereを無視
        $contacts = Contact::when($searches['gender'], function ($query, $gender) {
            // 性別
            return $query->where('gender', $gender);
        })->when($searches['category_id'], function ($query, $category_id) {
            // お問い合わせの種類
            return $query->where('category_id', $category_id);
        })->when($searches['created_at'], function ($query, $created_at) {
            // 日付
            return $query->WhereDate('created_at', $created_at);
        })->when($searches['text'], function ($query, $text) {
            // 名前やメールアドレス
            return $query->where('email', 'like', '%' . $text . '%')
                ->orWhere('first_name', 'like', '%' . $text . '%')
                ->orWhere('last_name', 'like', '%' . $text . '%')
                // 苗字と名前を結合してフルネーム検索
                ->orWhereRaw('CONCAT(last_name,"",first_name) LIKE ?', '%' . $text . '%');
        })->get();

        foreach ($contacts as $key => $contact) {
            $lists[$key]['id'] = $contact['id'];
            $lists[$key]['first_name'] = $contact['first_name'];
            $lists[$key]['last_name'] = $contact['last_name'];
            $lists[$key]['email'] = $contact['email'];
            $lists[$key]['tel'] = $contact['tel'];
            $lists[$key]['address'] = $contact['address'];
            $lists[$key]['building'] = $contact['building'];
            $lists[$key]['detail'] = $contact['detail'];

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

    public function delete(Request $request)
    {
        // contactテーブルを取得
        $contacts = Contact::all();
        // 削除対象のidを取得
        $delete_id = $request->only(['id']);
        // 該当データ削除
        $contacts->find($delete_id['id'])->delete();
        // データ削除後はリロードする
        return back();
    }
}
