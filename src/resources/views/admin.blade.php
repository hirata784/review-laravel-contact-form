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