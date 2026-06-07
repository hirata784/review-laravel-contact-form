@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{asset('css/admin.css')}}">
@endsection

@section('content')
<div class="admin">
    <h2 class="title">Admin</h2>
    <form action="/search">
        <div class="group">
            <input class="txt" type="text" name="text" placeholder="名前やメールアドレスを入力してください">
            <select class="gender" name="gender">
                <option value="">性別</option>
                <option value="">全て</option>
                <option value="1">男性</option>
                <option value="2">女性</option>
                <option value="3">その他</option>
            </select>
            <select class="category" name="category_id">
                <option value="">お問い合わせの種類</option>
                @foreach($select_category as $select)
                <option value="{{$loop->index+1}}">{{$select}}</option>
                @endforeach
            </select>
            <input class="date" type="date" name="created_at">
            <button class="btn search" type="submit">検索</button>
            <a href="/admin" class="btn reset">リセット</a>
        </div>
        <div class="export">
            <button class="export-btn" type="submit">エクスポート</button>
        </div>
        <table class="list-table">
            <tr>
                <th class="list-th">お名前</th>
                <th class="list-th">性別</th>
                <th class="list-th">メールアドレス</th>
                <th class="list-th">お問い合わせの種類</th>
                <th class="list-th"></th>
            </tr>
            @foreach($lists as $list)
            <tr>
                <td class="list-td">{{$list['last_name']}} {{$list['first_name']}}</td>
                <td class="list-td">{{$list['gender']}}</td>
                <td class="list-td">{{$list['email']}}</td>
                <td class="list-td">{{$list['category']}}</td>
                <!-- data-targetでボタンを押下したデータを取得する -->
                <td class="list-td"><button type="button" class="detail-btn" data-target="{{$loop->index}}">詳細</button></td>
            </tr>
            @endforeach
        </table>
    </form>
    <!-- モーダル -->
    <div class="modal" id="modal">
        <div class="modal-content">
            <button class="modal-cancel-btn" id="modal-cancel-btn">×</button>
            <form action="/admin/delete" method="post" id="modal-form">
                @csrf
                <table class="modal-table">
                    <tr>
                        <th class="modal-th">お名前</th>
                        <td class="modal-td" id="td-name"></td>
                    </tr>
                    <tr>
                        <th class="modal-th">性別</th>
                        <td class="modal-td" id="td-gender"></td>
                    </tr>
                    <tr>
                        <th class="modal-th">メールアドレス</th>
                        <td class="modal-td" id="td-email"></td>
                    </tr>
                    <tr>
                        <th class="modal-th">電話番号</th>
                        <td class="modal-td" id="td-tel"></td>
                    </tr>
                    <tr>
                        <th class="modal-th">住所</th>
                        <td class="modal-td" id="td-address"></td>
                    </tr>
                    <tr>
                        <th class="modal-th">建物名</th>
                        <td class="modal-td" id="td-building"></td>
                    </tr>
                    <tr>
                        <th class="modal-th">お問い合わせの種類</th>
                        <td class="modal-td" id="td-category"></td>
                    </tr>
                    <tr>
                        <th class="modal-th">お問い合わせ内容</th>
                        <td class="modal-td" id="td-detail"></td>
                    </tr>
                </table>
                <input type="hidden" id="modal-hidden" name="id">
                <button class="btn modal-delete-btn">削除</button>
            </form>
        </div>
    </div>

    <script>
        // PHPの配列をJavaScriptで操作できる配列へ変換
        const tableData = JSON.parse('@json($lists)');
    </script>

    <script src="{{asset('js/main.js')}}"></script>
</div>
@endsection