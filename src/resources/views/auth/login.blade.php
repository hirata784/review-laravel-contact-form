@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{asset('css/login.css')}}">
@endsection

@section('content')
<div class="login">
    <div class="login-content">
        <h2 class="title">Login</h2>
        <form class="login-form" action="/login" method="post">
            @csrf
            <div class="login-txt-group">
                <div class="group">
                    <p class="group-item">メールアドレス</p>
                    <input type="text" class="txt" name="email" placeholder="例:test@example.com" value="{{old('email')}}">
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
            <button class="btn" type="submit">ログイン</button>
        </form>
    </div>
</div>
@endsection