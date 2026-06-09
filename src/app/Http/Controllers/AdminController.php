<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Contact;
use App\Models\Category;
use Carbon\Carbon;
use Illuminate\Pagination\Paginator;
use Illuminate\Pagination\LengthAwarePaginator;

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

        // ページネーション設定
        // 配列からコレクションへ変換
        $collection = collect($lists);
        // 1ページごとの表示件数
        $perPage = 7;
        // 現在のページを取得
        $page = Paginator::resolveCurrentPage('page');
        // ページ番号から表示するデータを確定
        $pageData = $collection->slice(($page - 1) * $perPage, $perPage);
        $options = [
            'path' => Paginator::resolveCurrentPath(),
            'pageName' => 'page'
        ];
        // listsをページネーション設定したものに上書き
        $lists = new LengthAwarePaginator($pageData, $collection->count(), $perPage, $page, $options);

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

        // 未入力の場合、空白を取得する(未定義配列キーと表示され、、ページネーションを使うことができないため)
        $searches['text'] = isset($searches['text']) ? $searches['text'] : "";
        $searches['gender'] = isset($searches['gender']) ? $searches['gender'] : "";
        $searches['category_id'] = isset($searches['category_id']) ? $searches['category_id'] : "";
        $searches['created_at'] = isset($searches['created_at']) ? $searches['created_at'] : "";

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

        // ページネーション設定
        // 配列からコレクションへ変換
        $collection = collect($lists);
        // 1ページごとの表示件数
        $perPage = 7;
        // 現在のページを取得
        $page = Paginator::resolveCurrentPage('page');
        // ページ番号から表示するデータを確定
        $pageData = $collection->slice(($page - 1) * $perPage, $perPage);
        $options = [
            'path' => Paginator::resolveCurrentPath(),
            'pageName' => 'page'
        ];
        // listsをページネーション設定したものに上書き
        $lists = new LengthAwarePaginator($pageData, $collection->count(), $perPage, $page, $options);

        return view('admin', compact('lists', 'select_category'));
    }

    public function export()
    {
        // contactテーブルを取得
        $contacts = Contact::all();

        // ヘッダーを作成
        $csvHeader = [
            'id',
            'category_id',
            'last_name',
            'first_name',
            'gender',
            'email',
            'tel',
            'address',
            'building',
            'detail'
        ];
        // 出力データ保存用配列作成
        $temps = [];
        array_push($temps, $csvHeader);

        // テーブルデータを追加
        foreach ($contacts as $contact) {
            $temp = [
                $contact['id'],
                $contact['category_id'],
                $contact['last_name'],
                $contact['first_name'],
                $contact['gender'],
                $contact['email'],
                // 先頭の0自動削除対策
                '="' . $contact['tel'] . '"',
                $contact['address'],
                $contact['building'],
                $contact['detail'],
            ];
            array_push($temps, $temp);
        }

        // 書き込み用のファイルを一時的に作成し、開く
        $stream = fopen('php://temp', 'r+b');

        // 作成したファイルに出力したいデータを書き込む
        foreach ($temps as $temp) {
            fputcsv($stream, $temp);
        }
        // ファイルポインタを先頭に戻す
        rewind($stream);

        // 改行コードを置き換え・文字列に変換・エンコード
        // fputcsvで書き込む際に、1つ書き込むたびに改行コード（PHP_EOL）が追加される。
        // この改行コードがOS依存のため、str_replace関数を用いて「\r\n」に置き換える。
        // stream_get_contents関数を用いて、文字列に変換する。
        $csv = str_replace(PHP_EOL, "\r\n", stream_get_contents($stream));

        // 文字列をエンコードする(文字化け防止)
        $csv = mb_convert_encoding($csv, 'SJIS-win', 'UTF-8');

        // ファイル作成日時
        $now = new Carbon();
        // ファイル名作成
        $filename = "Contactsデータ一覧(" . $now->format('Y年m月d日') . ").csv";

        // ファイルをCSV形式に変換する
        $headers = array(
            'Content-Type' => 'text/csv',
            'Content-Disposition' => 'attachment; filename=' . $filename,
        );
        // CSVファイルを出力する
        return response($csv, 200, $headers);
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
