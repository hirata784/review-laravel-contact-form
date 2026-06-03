@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{asset('css/admin.css')}}">
@endsection

@section('content')
<div class="admin">
    <h2 class="title">Admin</h2>
    <form action="">
        <div class="group">
            <input class="txt" type="text" placeholder="名前やメールアドレスを入力してください">
            <select class="gender" name="" id="">
                <option value="">性別</option>
                <option value="">男性</option>
                <option value="">女性</option>
                <option value="">その他</option>
            </select>
            <select class="category" name="" id="">
                <option value="">お問い合わせの種類</option>
                <option value="">商品のお届けについて</option>
                <option value="">商品の交換について</option>
                <option value="">商品トラブル</option>
                <option value="">ショップへのお問い合わせ</option>
                <option value="">その他</option>
            </select>
            <input class="date" type="date">
            <button class="btn search" type="submit">検索</button>
            <button class="btn reset" type="submit">リセット</button>
        </div>
        <div class="export">
            <button class="export-btn" type="submit">エクスポート</button>
        </div>
        <table>
            <tr>
                <th>お名前</th>
                <th>性別</th>
                <th>メールアドレス</th>
                <th>お問い合わせの種類</th>
                <th></th>
            </tr>
            @foreach($lists as $list)
            <tr>
                <td>{{$list['last_name']}} {{$list['first_name']}}</td>
                <td>{{$list['gender']}}</td>
                <td>{{$list['email']}}</td>
                <td>{{$list['category']}}</td>
                <td><button class="detail-btn">詳細</button></td>
            </tr>
            @endforeach
        </table>
    </form>
</div>
@endsection