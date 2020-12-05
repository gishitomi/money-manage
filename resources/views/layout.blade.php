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
                    ようこそ、〇〇さん
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
                    <p>残り<br><span style="font-weight: 900;">{{$budget->money - $totalSpend}}</span>円<br>使用できます。</p>
                </div>
                @else
                <p>存在しないよ</p>
                @endif
                <div class="total-money">
                    <p>累計金額</p>
                    <p><span>{{$allTotalIncom}}</span>円</p>
                    <p>前月との差</p>
                    <p>〇〇円</p>
                </div>
                <div class="budget-edit-btn">
                    @if($budget)
                    <a href="{{route('budgets.edit', ['date' => $date])}}">
                    <button class="btn btn-primary btn-block">予算を編集</button>
                    </a>
                    @else
                    <a href="{{route('budgets.edit')}}">
                        <button class="btn btn-block btn-success">予算を設定する</button>
                    </a>
                    @endif
                </div>

            </div>
            <div class="col-md-10 col-12">
                @yield('content')
            </div>
        </div>
    </div>
    <!-- オーバーレイ -->
    <div id="overlay"></div>
    @yield('script')
</body>

</html>