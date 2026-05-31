@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{asset('css/input.css')}}">
@endsection

@section('content')
<div class="input">
    <h2 class="title">Contact</h2>
    <form action="/confirm" method="post">
        @csrf
        <div class="group">
            <p class="group-item">お名前<span>※</span></p>
            <div class="group-control">
                <input type="text" class="pair-txt" name="first_name" placeholder="例：山田" value="{{old('first_name')}}">
                <input type="text" class="pair-txt" name="last_name" placeholder="例：太郎" value="{{old('last_name')}}">
            </div>
        </div>
        @error('first_name')
        <div class="error">{{$errors->first('first_name')}}</div>
        @enderror
        @error('last_name')
        <div class="error">{{$errors->first('last_name')}}</div>
        @enderror
        <div class="group">
            <p class="group-item">性別<span>※</span></p>
            <div class="group-radio">
                <input type="radio" name="gender" id="man" value="男性" {{old('gender') === '男性' ? 'checked' : ''}}>
                <label class="lbl" for="man">男性</label>
                <input type="radio" name="gender" id="woman" value="女性" {{old('gender') === '女性' ? 'checked' : ''}}>
                <label class="lbl" for="woman">女性</label>
                <input type="radio" name="gender" id="other" value="その他" {{old('gender') === 'その他' ? 'checked' : ''}}>
                <label class="lbl" for="other">その他</label>
            </div>
        </div>
        @error('gender')
        <div class="error">{{$errors->first('gender')}}</div>
        @enderror
        <div class="group">
            <p class="group-item">メールアドレス<span>※</span></p>
            <div class="group-control">
                <input type="text" class="txt" name="email" placeholder="例：test@example.com" value="{{old('email')}}">
            </div>
        </div>
        @error('email')
        <div class="error">{{$errors->first('email')}}</div>
        @enderror
        <div class="group">
            <p class="group-item">電話番号<span>※</span></p>
            <div class="group-control">
                <input type="text" class="trio-txt" name="tel1" placeholder="080" value="{{old('tel1')}}">-
                <input type="text" class="trio-txt" name="tel2" placeholder="1234" value="{{old('tel2')}}">-
                <input type="text" class="trio-txt" name="tel3" placeholder="5678" value="{{old('tel3')}}">
            </div>
        </div>
        <!-- tel1から順番に確認する。エラー表示した時点で、他の電話番号はエラーチェックしない -->
        @if($errors->has('tel1'))
        <div class="error">{{$errors->first('tel1')}}</div>
        @elseif($errors->has('tel2'))
        <div class="error">{{$errors->first('tel2')}}</div>
        @elseif($errors->has('tel3'))
        <div class="error">{{$errors->first('tel3')}}</div>
        @endif
        <div class="group">
            <p class="group-item">住所<span>※</span></p>
            <div class="group-control">
                <input type="text" class="txt" name="address" placeholder="例：東京都渋谷区千駄ヶ谷1-2-3" value="{{old('address')}}">
            </div>
        </div>
        @error('address')
        <div class="error">{{$errors->first('address')}}</div>
        @enderror
        <div class="group">
            <p class="group-item">建物名</p>
            <div class="group-control">
                <input type="text" class="txt" name="building" placeholder="例：千駄ヶ谷マンション101" value="{{old('building')}}">
            </div>
        </div>
        <div class="group">
            <p class="group-item">お問い合わせの種類<span>※</span></p>
            <div class="group-control">
                <select class="sel" name="category_id" id="">
                    <option value="">選択してください</option>
                    @foreach($lists as $list)
                    <option value="{{$loop->index+1}}" {{old('category_id') === (string)($loop->index+1) ? 'selected' : '' }}>{{$list}}</option>
                    @endforeach
                </select>
            </div>
        </div>
        @error('category_id')
        <div class="error">{{$errors->first('category_id')}}</div>
        @enderror
        <div class=" group">
            <p class="group-item">お問い合わせ内容<span>※</span></p>
            <div class="group-control">
                <textarea class="txt-area" name="detail" id="" placeholder="お問い合わせ内容をご記載ください">{{old('detail')}}</textarea>
            </div>
        </div>
        @error('detail')
        <div class="error">{{$errors->first('detail')}}</div>
        @enderror
        <button type="submit" class="btn">確認画面</button>
    </form>
</div>
@endsection