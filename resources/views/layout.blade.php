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
                    <p>ようこそ、{{$userName}}さん</p>
                    <div class="auth-btns">
                        <form action="{{route('logout')}}" method="POST">
                            @csrf
                            <button type="submit" class="btn btn-dark">ログアウト</button>
                        </form>
                    </div>
                </div>
            </div>
            <!-- ハンバーガーメニュー -->
            <div class="hamburger-menu">
                <label id="hamburger" class="menu-btn"><span></span></label>
            </div>
        </header>
        <!-- スマホドロワーメニュー -->
        <div class="sp-budget-menu"  id="sp-budget-menu">
            <div class="sp-budget">
                <p>{{date('m月', strtotime($date))}}の設定予算</p>
                @if(isset($budget))
                <p class="amount">{{$budget->money}}円</p>
                @else
                <p>----- 円</p>
                @endif
            </div>
            <div class="sp-remaining">
                @if(isset($budget))
                    @if($budget->money - $totalSpend > 0)
                    <p>残り<span style="font-weight: 900;">{{$budget->money - $totalSpend}}</span>円<br>使用できます。</p>
                    @elseif($budget->money - $totalSpend < 0) <p>設定金額より<span style="font-weight: 900;">{{($budget->money - $totalSpend) * -1}}</span>円<br>オーバーしています。</p>
                    @endif

                @else
                <p>予算額が設定されていません。</p>
                @endif
            </div>
            <div class="sp-budget-edit-btn">
                @if($budget)
                <a href="{{route('budgets.edit', ['date' => $date])}}">
                    <button class="btn btn-success btn-block">予算を<br class="br-tablet">変更する</button>
                </a>
                @else
                <a href="{{route('budgets.edit', ['date' => $date])}}">
                    <button class="btn btn-block btn-success">予算を<br class="br-tablet">設定する</button>
                </a>
                @endif
            </div>
        </div>
    </div>
    <div class="main-contents container-fluid">
        <div class="row main-contents-row">
            <div class="sidebar col-md-2 d-md-flex d-none ">
                <div class="budget-box">
                    <p class="text-sm" id="budget-month">{{date('m月', strtotime($date))}}の<br class="br-tablet">設定予算</p>
                    @if(isset($budget))
                    <p class="amount">{{$budget->money}}円</p>
                    @else
                    <p>----- 円</p>
                    @endif
                </div>
                <div class="remaining">
                    @if(isset($budget))
                    @if($budget->money - $totalSpend > 0)
                    <p>残り<br><span style="font-weight: 900;">{{$budget->money - $totalSpend}}</span>円<br>使用できます。</p>
                    @elseif($budget->money - $totalSpend < 0) <p>設定金額より<br><span style="font-weight: 900;">{{($budget->money - $totalSpend) * -1}}</span>円<br>オーバーしています。</p>
                        @endif

                        @else
                        <p>予算額が<br>設定されていません。</p>
                        <a href="{{route('budgets.edit', ['date' => $date])}}">
                            予算額を設定する
                        </a>
                        @endif
                </div>
                <div class="total-money">
                    <p>これまでの<br class="br-tablet">収入金額</p>
                    <p><span style="font-weight: 900;">{{$allTotalIncom}}</span>円</p>
                </div>
                <div class="budget-edit-btn">
                    @if($budget)
                    <a href="{{route('budgets.edit', ['date' => $date])}}">
                        <button class="btn btn-success btn-block">予算を<br class="br-tablet">変更する</button>
                    </a>
                    @else
                    <a href="{{route('budgets.edit', ['date' => $date])}}">
                        <button class="btn btn-block btn-success">予算を<br class="br-tablet">設定する</button>
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
    <!-- Bootstrap -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/js/bootstrap.bundle.min.js" integrity="sha384-ygbV9kiqUc6oa4msXn9868pTtWMgiQaeYH7/t7LECLbyPA2x65Kgf80OJFdroafW" crossorigin="anonymous"></script>
    <!-- flatpickrスクリプト -->
    <script src="https://npmcdn.com/flatpickr/dist/flatpickr.min.js"></script>
    <!-- 日本語化のための追加スクリプト -->
    <script src="https://npmcdn.com/flatpickr/dist/l10n/ja.js"></script>
    @yield('script')
</body>

</html>