<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>defaultlayouts</title>

    <link rel="stylesheet" href="{{ asset('css/style.css') }}">

    @yield('css')
    
    <style>
        body {
            background-color: #ffffff;
            color: #8b7969;
            font-family: 'Times New Roman', serif;
            margin: 0;
        }

        header {
            width: 100%;
            padding: 40px 0;
            text-align: center;
            font-size: 32px;
            border-bottom: 1px solid #f4f4f4;
        }

        .main-content {
            padding-top: 50px;
        }

        .content-title {
            text-align: center;
            font-size: 24px;
            margin-bottom: 40px;
        }

        .container {
            max-width: 900px;
            margin: 0 auto;
            padding: 0 20px;
        }


        .btn {
            background-color: #8b7969;
            color: #fff;
            border: none;
            padding: 10px 40px;
            cursor: pointer;
            font-size: 16px;
        }

        .btn-secondary {
            background-color: #fff;
            color: #8b7969;
            text-decoration: underline;
            border: none;
            cursor: pointer;
        }
    </style>
    @yield('css')
</head>

<body>
    <header>FashionablyLate</header>
    <div class="main-content">
        @yield('content')
    </div>
</body>

</html>