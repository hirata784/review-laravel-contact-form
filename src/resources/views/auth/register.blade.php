@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{asset('css/register.css')}}">
@endsection

@section('content')
<div class="register">
    <div class="register-content">
        <h2 class="title">Register</h2>
        <form class="register-form" action="/register" method="post">
            @csrf
            <div class="register-txt-group">
                <div class="group">
                    <p class="group-item">お名前</p>
                    <input type="text" class="txt" name="name" placeholder="例: 山田 太郎">
                </div>
                @error('name')
                <div class="error">{{$errors->first('name')}}</div>
                @enderror
                <div class="group">
                    <p class="group-item">メールアドレス</p>
                    <input type="text" class="txt" name="email" placeholder="例:test@example.com">
                </div>
                @error('email')
                <div class="error">{{$errors->first('email')}}</div>
                @enderror
                <div class="group">
                    <p class="group-item">パスワード</p>
                    <input type="password" class="txt" name="password" placeholder="例:coachtech1106">
                </div>
                @error('password')
                <div class="error">{{$errors->first('password')}}</div>
                @enderror
            </div>
            <button class="btn">登録</button>
        </form>
    </div>
</div>
@endsection