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
                <a href="{{route('home')}}" class="header-title">
                    <h1>MoneyManageApp</h1>
                </a>
                <div class="header-right">
                    <p>ようこそ、{{$user_name}}さん</p>
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
            <div class="sidebar col-md-2 d-md-flex d-none ">
                @if(isset($budget))
                <div class="budget-box">
                    <p class="text-sm" id="budget-month">{{date('m月', strtotime($date))}}の設定予算</p>
                    <p>{{$budget->money}}円</p>
                </div>
                <div class="remaining">
                    @if($budget->money - $totalSpend > 0)
                    <p>残り<br><span style="font-weight: 900;">{{$budget->money - $totalSpend}}</span>円<br>使用できます。</p>
                    @elseif($budget->money - $totalSpend < 0)
                    <p>設定金額より<br><span style="font-weight: 900;">{{($budget->money - $totalSpend) * -1}}</span>円<br>オーバーしています。</p>
                    @else
                    @endif
                </div>
                @else
                <p>存在しないよ</p>
                @endif
                <div class="total-money">
                    <p>累計収入金額</p>
                    <p><span style="font-weight: 900;">{{$allTotalIncom}}</span>円</p>
                </div>
                <div class="budget-edit-btn">
                    @if($budget)
                    <a href="{{route('budgets.edit', ['date' => $date])}}">
                        <button class="btn btn-success btn-block">予算を編集</button>
                    </a>
                    @else
                    <a href="{{route('budgets.edit', ['date' => $date])}}">
                        <button class="btn btn-block btn-success">予算を設定する</button>
                    </a>
                    @endif
                </div>

            </div>
            <div class="col-md-10 col-12 main-display">
                @yield('content')
            </div>
        </div>
    </div>
    <!-- オーバーレイ -->
    <div id="overlay"></div>
    @yield('script')
</body>

</html>