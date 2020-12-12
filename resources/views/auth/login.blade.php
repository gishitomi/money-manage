<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>MoneyManage-Top</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">
    <link href="https://use.fontawesome.com/releases/v5.6.1/css/all.css" rel="stylesheet">
    <link rel="stylesheet" href="{{asset('css/login.css')}}">
</head>

<body>
    <div class="jumbotron jumbotron-fluid home">
        <div class="home-wrapper">
            <div class="container">
                <div class="message">
                    <h1>タスク管理を人生にたとえたら、<br>大げさでしょうか？</h1>
                    <h2>タスク管理アプリ「ManageToDo」</h2>
                </div>
            </div>
            <div class="container">
                <form action="{{route('login')}}" method="post" class="form-box">
                    @csrf
                    <div id="form">
                    @if($errors->any())
                    <div class="alert alert-danger">
                        @foreach($errors->all() as $message)
                            <p>{{$message}}</p>
                        @endforeach
                    </div>
                    @endif
                        <p>メールアドレス</p>
                        <p class="mail"> <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus></p>
                        @error('email')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                        <p>パスワード</p>
                        <p class="pass"> <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password"></p>
                        @error('password')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                        <p class="check"><input type="checkbox" name="checkbox" />パスワードを保存</p>
                        <div class="text-center">
                            <a href="{{ route('password.request') }}">パスワードを忘れてしまった場合はこちら</a>
                        </div>


                        <div class="login-box">
                            <button type="submit" class="btn btn-primary login-btn">ログイン</button>
                        </div>
                    </div>
                    <div class="login-box new">
                        <a href="{{route('register')}}">
                            <button type="button" class="btn btn-lg btn-success">会員登録はこちら
                            </button>
                        </a>
                        <a href="{{route('guest.login')}}">
                            <button type="button" class="btn btn-lg btn-dark">ゲストログイン</button>
                        </a>

                    </div>
                </form>

            </div>
        </div>
    </div>
</body>

</html>
