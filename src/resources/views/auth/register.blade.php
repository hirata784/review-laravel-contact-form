@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{asset('css/register.css')}}">
@endsection

@section('content')
<div class="register">
    <div class="register-content">
        <h2 class="title">Register</h2>
        <form class="register-form" action="">
            <div class="register-txt-group">
                <div class="group">
                    <p class="group-item">お名前</p>
                    <input type="text" class="txt" placeholder="例: 山田 太郎">
                </div>
                <div class="group">
                    <p class="group-item">メールアドレス</p>
                    <input type="text" class="txt" placeholder="例:test@example.com">
                </div>
                <div class="group">
                    <p class="group-item">パスワード</p>
                    <input type="text" class="txt" placeholder="例:coachtech1106">
                </div>
            </div>
            <button class="btn">登録</button>
        </form>
    </div>
</div>
@endsection