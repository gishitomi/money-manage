@extends('layout')
@section('style')
<link rel="stylesheet" href="{{asset('css/statistics.css')}}">
<link rel="stylesheet" href="{{asset('css/detail.css')}}">
@endsection

@section('content')
<div class="container">
    <div class="date-title">
        <a href="{{route('kakeibo.statistics', ['date' => $past])}}">
            <span class="month-txt">前月</span>
            <i class="fas fa-chevron-left icon-color"></i>
        </a>
        <h3 id="detail-date">{{date('Y年m月', strtotime($date))}}</h3>
        <a href="{{route('kakeibo.statistics', ['date' => $future])}}">
            <i class="fas fa-chevron-right icon-color"></i>
            <span class="month-txt">翌月</span>
        </a>
    </div>

    <div class="graph" id="app">
        <h3>支出額の推移</h3>
        <canvas id="mycanvas"></canvas>
    </div>
</div>


@endsection

@section('script')
<script src="https://cdn.jsdelivr.net/npm/vue@2.6.11"></script>
<script src="https://cdn.jsdelivr.net/npm/chart.js@2.9.3/dist/Chart.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/lodash@4.17.15/lodash.min.js"></script>
@include('scripts/statistics-chart')
@endsection