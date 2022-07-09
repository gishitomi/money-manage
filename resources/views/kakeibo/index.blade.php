@extends('layout')
@section('style')
<link rel="stylesheet" href="{{asset('css/home.css')}}">
@endsection
@section('content')
<div class="container home">
    @if(isset($budget))
    <h1 class="home-index">{{date('Y年m月', strtotime($budget->date))}}の利用状況</h1>
    @else
    <h1 class="home-index">{{date('Y年m月', strtotime($date))}}の利用状況</h1>
    @endif
    <div class="date-arrow">
        <div class="arrow-left">
            <a href="{{route('kakeibo.index', ['date' => $past])}}" id="left-month-btn">
                <i class="fas fa-chevron-left fa-3x icon-color pc"></i>
                <i class="fas fa-chevron-left fa-2x icon-color sp"></i>
            </a>
            <p id="left-month">{{date('m', mktime(0, 0, 0, date('m', strtotime($date)), 0, 0))}}月</p>
        </div>
        @if(isset($budget))
        <h1 class="home-index"><input type="month" id="change-calendar" class="js-calendar" value="{{date('Y-m', strtotime($budget-> date))}}"></h1>
        @else
        <h1 class="home-index"><input type="month" id="change-calendar" class="js-calendar" value="{{date('Y-m', strtotime($date))}}"></h1>
        @endif
        <div class="arrow-right">
            <a href="{{route('kakeibo.index', ['date' => $future])}}" id="right-month-btn">
                <i class="fas fa-chevron-right fa-3x icon-color pc"></i>
                <i class="fas fa-chevron-right fa-2x icon-color sp"></i>
            </a>
            <p id="right-month">{{date('m', mktime(0, 0, 0, date('m', strtotime($date))+2, 0, 0))}}月</p>
        </div>
    </div>

    @if($totalSpend !== 0)
    <div class="graph" id="app">
        <!--描画領域 -->
        <canvas id="mycanvas"></canvas>
    </div>
    @else
    <div class="non-spend-msg">
        <p>{{date('Y年m月', strtotime($date))}}の<br>支出金額はありません。</p>
    </div>
    @endif
    <div class="create-box">
        <span class="btn-circle-flat spend-color" id="spend-btn">支出</span>
        <span id="incom-btn" class="btn-circle-flat">収入</span>
    </div>
    <!-- ドロワーメニュー -->
    <div id="spend-drawer">
        <form action="{{route('kakeibo.index', ['date' => $date])}}" method="POST" name="spendForm" onsubmit="return cancelSpendSubmit()" >
            @csrf
            <h2 class="drawer-title">支出</h2>
            <span class="back-btn" id="spend-back">
                <i class="fas fa-times fa-2x"></i>
            </span>

            <div class="drawer-menu">
                <div class="date-box">
                    <div id="spend-month-left">
                        <i class="fas fa-angle-double-left fa-2x icon-color pc"></i>
                        <i class="fas fa-angle-double-left fa-lg icon-color sp"></i>
                        <p>前月</p>
                    </div>
                    <div id="spend-date-left">
                        <i class="fas fa-chevron-left fa-2x icon-color pc"></i>
                        <i class="fas fa-chevron-left fa-lg icon-color sp"></i>
                        <p>前日</p>
                    </div>
                    <p id="spend-date"></p>
                    <div id="spend-date-right">
                        <i class="fas fa-chevron-right fa-2x icon-color pc"></i>
                        <i class="fas fa-chevron-right fa-lg icon-color sp"></i>
                        <p>翌日</p>
                    </div>
                    <div id="spend-month-right">
                        <i class="fas fa-angle-double-right fa-2x icon-color pc"></i>
                        <i class="fas fa-angle-double-right fa-lg icon-color sp"></i>
                        <p>翌月</p>
                    </div>
                </div>
                @if($errors->any())
                <div class="error-msg-box">
                    @foreach($errors->all() as $message)
                    <p>{{$message}}</p>
                    @endforeach
                </div>
                @endif
                <input type="hidden" id="db-spend-date" name="date">
                <input type="hidden" name="money_type" value="1">
                <h3>支出金額を入力</h3>
                <p><input type="number" name="money" id="money">　円</p>
                <div class="memo-box">
                    <textarea name="description" id="description" cols="40" rows="5"></textarea>
                </div>
                <div class="spend-type-box">
                    <input id="type-1" class="radio-inline__input" type="radio" name="type" value="食費" />
                    <label class="radio-inline__label" for="type-1">
                        <i class="fas fa-utensils fa-lg"></i><br>
                        食費
                    </label>
                    <input id="type-2" class="radio-inline__input" type="radio" name="type" value="光熱費" />
                    <label class="radio-inline__label" for="type-2">
                        <i class="far fa-lightbulb fa-lg"></i><br>
                        光熱費
                    </label>
                    <input id="type-3" class="radio-inline__input" type="radio" name="type" value="家賃" />
                    <label class="radio-inline__label" for="type-3">
                        <i class="fas fa-home fa-lg"></i><br>
                        家賃
                    </label>
                    <input id="type-4" class="radio-inline__input" type="radio" name="type" value="交通費" />
                    <label class="radio-inline__label" for="type-4">
                        <i class="fas fa-car fa-lg"></i><br>
                        交通費
                    </label>
                    <input id="type-5" class="radio-inline__input" type="radio" name="type" value="通信費" />
                    <label class="radio-inline__label" for="type-5">
                        <i class="fas fa-hands fa-lg"></i><br>
                        生活費
                    </label>
                    <input id="type-6" class="radio-inline__input" type="radio" name="type" value="交際費" />
                    <label class="radio-inline__label" for="type-6">
                        <i class="fas fa-handshake fa-lg"></i><br>
                        交際費
                    </label>
                    <input id="type-7" class="radio-inline__input" type="radio" name="type" value="趣味" />
                    <label class="radio-inline__label" for="type-7">
                        <i class="fas fa-star fa-lg"></i><br>
                        趣味
                    </label>
                    <input id="type-8" class="radio-inline__input" type="radio" name="type" value="貯蓄" />
                    <label class="radio-inline__label" for="type-8">
                        <i class="fas fa-yen-sign fa-lg"></i><br>
                        貯蓄
                    </label>
                    <input id="type-9" class="radio-inline__input" type="radio" name="type" value="被服費" />
                    <label class="radio-inline__label" for="type-9">
                        <i class="fas fa-tshirt fa-lg"></i><br>
                        被服費
                    </label>
                    <input id="type-10" class="radio-inline__input" type="radio" name="type" value="美容費" />
                    <label class="radio-inline__label" for="type-10">
                        <i class="fas fa-cut fa-lg"></i><br>
                        美容費
                    </label>
                    <input id="type-11" class="radio-inline__input" type="radio" name="type" value="医療費" />
                    <label class="radio-inline__label" for="type-11">
                        <i class="fas fa-hospital-alt fa-lg"></i><br>
                        医療費
                    </label>
                    <input id="type-12" class="radio-inline__input" type="radio" name="type" value="その他" />
                    <label class="radio-inline__label" for="type-12">
                        <i class="fas fa-comment-dots fa-lg"></i><br>
                        その他
                    </label>
                </div>
                <input type="hidden" name="money-type" value="1">
                <div class="submit-btn">
                    <button type="submit" id="spend-submit" class="btn btn-danger btn-block">決定</button>
                </div>
            </div>
        </form>
    </div>
    <div id="incom-drawer">
        <form action="{{route('kakeibo.index', ['date' => $date])}}" method="POST" name="incomForm" onsubmit="return cancelIncomSubmit()">
            @csrf
            <h2 class="drawer-title incom">収入</h2>
            <span class="back-btn" id="incom-back">
                <i class="fas fa-times fa-2x"></i>
            </span>
            <div class="drawer-menu">
                <div class="date-box">
                    <div id="incom-month-left">
                        <i class="fas fa-angle-double-left fa-2x icon-color pc"></i>
                        <i class="fas fa-angle-double-left fa-lg icon-color sp"></i>
                        <p>前月</p>
                    </div>
                    <div id="incom-date-left">
                        <i class="fas fa-chevron-left fa-2x icon-color pc"></i>
                        <i class="fas fa-chevron-left fa-lg icon-color sp"></i>
                        <p>前日</p>
                    </div>
                    <p id="incom-date"></p>
                    <div id="incom-date-right">
                        <i class="fas fa-chevron-right fa-2x icon-color pc"></i>
                        <i class="fas fa-chevron-right fa-lg icon-color sp"></i>
                        <p>翌日</p>
                    </div>
                    <div id="incom-month-right">
                        <i class="fas fa-angle-double-right fa-2x icon-color pc"></i>
                        <i class="fas fa-angle-double-right fa-lg icon-color sp"></i>
                        <p>翌月</p>
                    </div>
                </div>
                @if($errors->any())
                <div class="error-msg-box">
                    @foreach($errors->all() as $message)
                    <p>{{$message}}</p>
                    @endforeach
                </div>
                @endif
                <input type="hidden" id="db-incom-date" name="date">
                <input type="hidden" name="money_type" value="2">
                <h3>収入金額を入力</h3>
                <p><input type="number" name="money" id="incom-money">　円</p>
                <div class="memo-box">
                    <textarea name="description" id="incom-description" cols="40" rows="5" class="pc"></textarea>
                    <textarea name="description" id="incom-description" cols="30" rows="5" class="sp"></textarea>
                </div>
                <div class="incom-type-box">
                    <input id="type-101" class="incom_radio-inline__input" type="radio" name="type" value="給与" />
                    <label class="radio-inline__label" for="type-101">
                        <i class="fas fa-yen-sign fa-lg"></i><br>
                        給与
                    </label>
                    <input id="type-102" class="incom_radio-inline__input" type="radio" name="type" value="その他" />
                    <label class="radio-inline__label" for="type-102">
                        <i class="fas fa-piggy-bank fa-lg"></i><br>
                        その他
                    </label>
                </div>
                <div class="submit-btn">
                    <button type="submit" class="btn btn-success btn-block" id="incom-submit">決定</button>
                </div>
            </div>
        </form>
    </div>

    <div class="incom-box">
        <p>今月の収入:　<span>{{$totalIncom}}</span>円</p>
        <p>今月の支出:　<span>{{$totalSpend}}</span>円</p>
    </div>

    <div class="access-box">
        <div class="detail-wrapper">
            <a href="{{route('kakeibo.details', ['date' => $date])}}">
                <button class="btn btn-block btn-success">詳細一覧</button>
            </a>
        </div>
        <a href="{{route('kakeibo.statistics', ['date' => $date])}}" class="btn-success btn">
            <i class="fas fa-chart-line fa-lg"></i>
        </a>
    </div>
</div>

@endsection

@section('script')
<script src="https://cdn.jsdelivr.net/npm/vue@2.6.11"></script>
<script src="https://cdn.jsdelivr.net/npm/chart.js@2.9.3/dist/Chart.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/lodash@4.17.15/lodash.min.js"></script>

<script src="{{asset('js/drawer.js')}}"></script>
<script src="{{asset('js/sp-drawer.js')}}"></script>
<script src="{{asset('js/ajax.js')}}"></script>
@include('scripts/chartVueContent')
@endsection
