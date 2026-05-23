@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{asset('css/confirm.css')}}">
@endsection

@section('content')
<div class="confirm">
    <h2 class="title">Confirm</h2>
    <form action="">
        <table>
            <tr>
                <th>お名前</th>
                <td>テスト太郎</td>
            </tr>
            <tr>
                <th>性別</th>
                <td>テスト性別</td>
            </tr>
            <tr>
                <th>メールアドレス</th>
                <td>test@exmaple.com</td>
            </tr>
            <tr>
                <th>電話番号</th>
                <td>1112223333</td>
            </tr>
            <tr>
                <th>住所</th>
                <td>テスト県</td>
            </tr>
            <tr>
                <th>建物名</th>
                <td>テストアパート</td>
            </tr>
            <tr>
                <th>お問い合わせの種類</th>
                <td>テスト種類</td>
            </tr>
            <tr>
                <th>お問い合わせ内容</th>
                <td>テスト内容</td>
            </tr>
        </table>
        <div class="group-btn">
            <button type="submit" class="btn">送信</button>
            <a class="correction" href="">修正</a>
        </div>
    </form>
</div>
@endsection