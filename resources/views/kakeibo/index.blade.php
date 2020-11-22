@extends('layout')
@section('style')
<link rel="stylesheet" href="{{asset('css/home.css')}}">
@endsection
@section('content')
<div class="container home">

    <h1 class="home-index">2020年11月の利用状況</h1>
    <div class="date-arrow">
        <div class="arrow-left">
            <a href="">
                <i class="fas fa-arrow-left fa-2x"></i>
            </a>
            <p>10月</p>
        </div>
        <div class="arrow-right">
            <a href="">
                <i class="fas fa-arrow-right fa-2x"></i>
            </a>
            <p>12月</p>
        </div>
    </div>
    <div class="graph">
        <!--描画領域 -->
        <canvas id="mycanvas"></canvas>
    </div>
    <div class="create-box">
        <span class="btn-circle-flat spend-color" id="spend-btn">支出</span>
        <span id="incom-btn" class="btn-circle-flat">収入</span>
    </div>
    <!-- ドロワーメニュー -->
    <div id="spend-drawer">
        <form action="{{route('kakeibo.index')}}" method="POST">
            @csrf
            <h2 class="drawer-title">支出</h2>
            <span class="back-btn" id="spend-back">
                <i class="fas fa-times fa-3x"></i>
            </span>
            <div class="drawer-menu">
                <div class="date-box">
                    <p id="spend-date" name="date"></p>
                </div>
                <h3>支出金額を入力</h3>
                <p><input type="number" name="money" id="money">　円</p>
                <div class="memo-box">
                    <textarea name="description" id="description" cols="40" rows="5"></textarea>
                </div>
                <div class="spend-type-box">
                    <input id="type-1" class="radio-inline__input" type="radio" name="type" value="type-1" />
                    <label class="radio-inline__label" for="type-1">
                        <i class="fas fa-utensils fa-lg"></i><br>
                        食費
                    </label>
                    <input id="type-2" class="radio-inline__input" type="radio" name="type" value="type-2" />
                    <label class="radio-inline__label" for="type-2">
                        <i class="far fa-lightbulb fa-lg"></i><br>
                        光熱費
                    </label>
                    <input id="type-3" class="radio-inline__input" type="radio" name="type" value="type-3" />
                    <label class="radio-inline__label" for="type-3">
                        <i class="fas fa-home fa-lg"></i><br>
                        家賃
                    </label>
                    <input id="type-4" class="radio-inline__input" type="radio" name="type" value="type-4" />
                    <label class="radio-inline__label" for="type-4">
                        <i class="fas fa-car fa-lg"></i><br>
                        交通費
                    </label>
                    <input id="type-5" class="radio-inline__input" type="radio" name="type" value="type-5" />
                    <label class="radio-inline__label" for="type-5">
                        <i class="fas fa-wifi fa-lg"></i><br>
                        通信費
                    </label>
                    <input id="type-6" class="radio-inline__input" type="radio" name="type" value="type-6" />
                    <label class="radio-inline__label" for="type-6">
                        <i class="fas fa-handshake fa-lg"></i><br>
                        交際費
                    </label>
                    <input id="type-7" class="radio-inline__input" type="radio" name="type" value="type-7" />
                    <label class="radio-inline__label" for="type-7">
                        <i class="fas fa-star fa-lg"></i><br>
                        趣味
                    </label>
                    <input id="type-8" class="radio-inline__input" type="radio" name="type" value="type-8" />
                    <label class="radio-inline__label" for="type-8">
                        <i class="fas fa-yen-sign fa-lg"></i><br>
                        貯蓄
                    </label>
                    <input id="type-9" class="radio-inline__input" type="radio" name="type" value="type-9" />
                    <label class="radio-inline__label" for="type-9">
                        <i class="fas fa-comment-dots fa-lg"></i><br>
                        その他
                    </label>

                </div>
                <input type="hidden" name="money-type" value="1">
                <div class="submit-btn">
                    <button type="submit" class="btn btn-danger btn-block">決定</button>
                </div>
            </div>
        </form>
    </div>

    <div id="incom-drawer">
        <form action="{{route('kakeibo.index')}}" method="POST">
            <h2 class="drawer-title incom">収入</h2>
            <span class="back-btn" id="incom-back">
                <i class="fas fa-times fa-3x"></i>
            </span>
            <div class="drawer-menu">
                <h3>収入金額を入力</h3>
                <p><input type="number" name="money" id="incom-money">　円</p>
                <div class="memo-box">
                    <textarea name="description" id="incom-description" cols="40" rows="5"></textarea>
                </div>

                <div class="submit-btn">
                    <button type="submit" class="btn btn-success btn-block">決定</button>
                </div>
            </div>
        </form>
    </div>



    <div class="incom-box">
        <p>収入:　<span></span></p>
        <p>支出:　<span></span></p>
    </div>


    <div class="access-box">
        <div class="detail-wrapper">
            <a href="{{route('kakeibo.details')}}">
                <button class="btn btn-block btn-primary">詳細一覧</button>
            </a>
        </div>
        <button class="btn btn-success">
            <i class="fas fa-chart-line fa-lg"></i>
        </button>
    </div>
</div>


@endsection

@section('script')
<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/1.0.2/Chart.min.js"></script>
<script src="{{asset('js/chart.js')}}"></script>
<script src="{{asset('js/drawer.js')}}"></script>
@endsection