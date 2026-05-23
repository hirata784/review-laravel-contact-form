@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{asset('css/input.css')}}">
@endsection

@section('content')
<div class="input">
    <h2 class="title">Contact</h2>
    <form action="/confirm">
        <div class="group">
            <p class="group-item">お名前<span>※</span></p>
            <div class="group-control">
                <input type="text" class="pair-txt" placeholder="例：山田">
                <input type="text" class="pair-txt" placeholder="例：太郎">
            </div>
        </div>
        <div class="group">
            <p class="group-item">性別<span>※</span></p>
            <div class="group-radio">
                <input type="radio" name="gender" id="man" value="男性">
                <label class="lbl" for="man">男性</label>
                <input type="radio" name="gender" id="woman" value="女性">
                <label class="lbl" for="woman">女性</label>
                <input type="radio" name="gender" id="other" value="その他">
                <label class="lbl" for="other">その他</label>
            </div>
        </div>
        <div class="group">
            <p class="group-item">メールアドレス<span>※</span></p>
            <div class="group-control">
                <input type="text" class="txt" placeholder="例：test@example.com">
            </div>
        </div>
        <div class="group">
            <p class="group-item">電話番号<span>※</span></p>
            <div class="group-control">
                <input type="text" class="trio-txt" placeholder="080">-
                <input type="text" class="trio-txt" placeholder="1234">-
                <input type="text" class="trio-txt" placeholder="5678">
            </div>
        </div>
        <div class="group">
            <p class="group-item">住所<span>※</span></p>
            <div class="group-control">
                <input type="text" class="txt" placeholder="例：東京都渋谷区千駄ヶ谷1-2-3">
            </div>
        </div>
        <div class="group">
            <p class="group-item">建物名</p>
            <div class="group-control">
                <input type="text" class="txt" placeholder="例：千駄ヶ谷マンション101">
            </div>
        </div>
        <div class="group">
            <p class="group-item">お問い合わせの種類<span>※</span></p>
            <div class="group-control">
                <select class="sel" name="" id="">
                    <option value="">選択してください</option>
                    <option value="">商品のお届けについて</option>
                    <option value="">商品の交換について</option>
                    <option value="">商品トラブル</option>
                    <option value="">ショップへのお問い合わせ</option>
                    <option value="">その他</option>
                </select>
            </div>
        </div>
        <div class="group">
            <p class="group-item">お問い合わせ内容<span>※</span></p>
            <div class="group-control">
                <textarea class="txt-area" name="" id="" placeholder="お問い合わせ内容をご記載ください"></textarea>
            </div>
        </div>
        <button type="submit" class="btn">確認画面</button>
    </form>
</div>
@endsection