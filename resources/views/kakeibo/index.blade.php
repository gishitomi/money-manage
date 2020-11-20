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
        <a href="#" class="btn-circle-flat spend-color" id="spend-btn">支出</a>
        <a href="#" id="incom-btn" class="btn-circle-flat">収入</a>
    </div>
    <!-- ドロワーメニュー -->
    <div id="spend-drawer">
        <h2 class="drawer-title">支出</h2>
        <a href="#" class="back-btn">
        <i class="fas fa-times fa-2x"></i>
        </a>
        <ul class="drawer-menu">
            <li>メニュー</li>
        </ul>
    </div>

    <div id="incom-drawer">
        <h2 class="drawer-title incom">収入</h2>
        <ul class="drawer-menu">
            <li>メニュー</li>
        </ul>
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