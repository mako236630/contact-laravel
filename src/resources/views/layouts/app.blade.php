<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>FashionablyLate</title>
    <link rel="stylesheet" href="{{ asset('css/common.css') }}">
    @yield('css')
</head>

<body>
    <header class="header">
        <div class="header__inner">
            <div class="header__logo">
                FashionablyLate
            </div>

            @if (!Request::is('contact'))
            <nav>
                <ul class="header-nav">
                    @if (Request::is('register'))
                    <li class="header-nav__item">
                        <a class="header-nav__link" href="/login">login</a>
                    </li>
                    @endif
                    @if (Request::is('login'))
                    <li class="header-nav__item">
                        <a class="header-nav__link" href="/register">register</a>
                    </li>
                    @endif
                </ul>
            </nav>
            @endif
        </div>
    </header>

    <main>
        <div class="main-content">
            @yield('content')
        </div>
    </main>
</body>

</html>