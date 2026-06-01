<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="{{asset('css/sanitize.css')}}">
    <link rel="stylesheet" href="{{asset('css/common.css')}}">
    @yield('css')
</head>

<body>
    <header class="header">
        <div class="header-blank"></div>
        <div class="header-inner">FashionablyLate</div>
        <!-- register -->
        @if(request()->routeIs('register'))
        <form class="header-form" action="/login">
            <button class="form-btn">login</button>
        </form>
        <!-- login -->
        @elseif(request()->routeIs('login'))
        <form class="header-form" action="/register">
            <button class="form-btn">register</button>
        </form>
        <!-- その他 -->
        @else
        <div class="header-blank"></div>
        @endif
    </header>
    <main>
        @yield('content')
    </main>
</body>

</html>