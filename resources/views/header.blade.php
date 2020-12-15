<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>家計簿管理アプリ</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">
    <link href="https://use.fontawesome.com/releases/v5.6.1/css/all.css" rel="stylesheet">
    <link rel="stylesheet" href="{{asset('css/style.css')}}">
    @yield('style')
</head>

<body>
    <div class="container-wrapper">
        <header class="navbar">
            <div class="container-fluid d-flex justify-content-between">
                <h1 class="header-title">MoneyManageApp</h1>
                <div class="header-right">
                <p>ようこそ、〇〇さん</p>
                    <div class="auth-btns">
                        <form action="{{route('logout')}}" method="POST">
                            @csrf
                            <button type="submit" class="btn btn-dark">ログアウト</button>
                        </form>
                    </div>
                </div>
            </div>
        </header>
    </div>
    <div class="main-contents container-fluid">
        <div class="row main-contents-row">
            <div class="col-12">
                @yield('content')
            </div>
        </div>
    </div>
    <!-- オーバーレイ -->
    <div id="overlay"></div>
    @yield('script')
</body>

</html>