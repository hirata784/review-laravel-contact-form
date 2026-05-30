@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{asset('css/confirm.css')}}">
@endsection

@section('content')
<div class="confirm">
    <h2 class="title">Confirm</h2>
    <form action="/thanks" method="post">
        @csrf
        <table>
            <tr>
                <th>お名前</th>
                <td>{{$lists['name']}}</td>
            </tr>
            <tr>
                <th>性別</th>
                <td>{{$lists['gender']}}</td>
            </tr>
            <tr>
                <th>メールアドレス</th>
                <td>{{$lists['email']}}</td>
            </tr>
            <tr>
                <th>電話番号</th>
                <td>{{$lists['tel']}}</td>
            </tr>
            <tr>
                <th>住所</th>
                <td>{{$lists['address']}}</td>
            </tr>
            <tr>
                <th>建物名</th>
                <td>{{$lists['building']}}</td>
            </tr>
            <tr>
                <th>お問い合わせの種類</th>
                <td>{{$lists['category']}}</td>
            </tr>
            <tr>
                <th>お問い合わせ内容</th>
                <td>{{$lists['detail']}}</td>
            </tr>
        </table>
        @foreach($lists as $key => $value)
        <input type="hidden" name="lists[{{$key}}]" value="{{$value}}">
        @endforeach
        <div class="group-btn">
            <button type="submit" class="btn">送信</button>
            <a class="correction" href="#" onclick="history.back()">修正</a>
        </div>
    </form>
</div>
@endsection