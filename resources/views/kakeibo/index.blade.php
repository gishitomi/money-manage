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
                <h3>支出金額を入力</h3>
                <p><input type="text" name="money" id="money">円</p>
                <div class="memo-box">
                    <textarea name="description" id="description" cols="40" rows="5"></textarea>
                </div>
                <div class="spend-type-box">
                    <button><i class="fas fa-utensils"></i>
                        <p>食費</p>
                    </button>
                    <button><i class="fas fa-home"></i>
                        <p>家賃</p>
                    </button>
                    <button><i class="far fa-lightbulb"></i>
                        <p>光熱費</p>
                    </button>
                    <button><i class="fas fa-car"></i>
                        <p>交通費</p>
                    </button>
                    <button><i class="fas fa-wifi"></i>
                        <p>通信費</p>
                    </button>
                    <button><i class="fas fa-handshake"></i>
                        <p>交際費</p>
                    </button>
                    <button><i class="fas fa-star"></i>
                        <p>趣味</p>
                    </button>
                    <button>
                        <i class="fas fa-yen-sign"></i>
                        <p>貯蓄</p>
                    </button>
                    <button>
                        <i class="fas fa-comment-dots"></i>
                        <p>その他</p>
                    </button>
                </div>
                <div class="submit-btn">
                    <button type="submit" class="btn btn-danger">決定</button>
                </div>
            </div>
        </form>
    </div>

    <div id="incom-drawer">
        <h2 class="drawer-title incom">収入</h2>
        <span class="back-btn" id="incom-back">
            <i class="fas fa-times fa-3x"></i>
        </span>
        <div class="drawer-menu">
        </div>
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