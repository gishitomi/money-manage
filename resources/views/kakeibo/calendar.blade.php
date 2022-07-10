@extends('layout')
@section('style')
<link rel="stylesheet" href="{{asset('css/detail.css')}}">
<link rel="stylesheet" href="{{asset('css/calendar.css')}}">
@endsection

@section('content')
<div class="container">
    <div class="date-title">
        <a href="{{route('kakeibo.list', ['date' => $past])}}">
            <span class="month-txt">前月</span>
            <i class="fas fa-chevron-left icon-color"></i>
        </a>
        <h3 id="detail-date">{{date('Y年m月', strtotime($date))}}</h3>
        <a href="{{route('kakeibo.list', ['date' => $future])}}">
            <i class="fas fa-chevron-right icon-color"></i>
            <span class="month-txt">翌月</span>
        </a>
    </div>

    <div class="list-wrapper">
        <div class="calendar">
            <!-- PC用レイアウト -->
            <table class="table table-bordered">
            <tr>
                <th>日</th>
                <th>月</th>
                <th>火</th>
                <th>水</th>
                <th>木</th>
                <th>金</th>
                <th>土</th>
            </tr>
                @foreach ($weeks as $week)
                    @php
                        echo $week
                    @endphp
                @endforeach
        </table>
        </div>

        <div class="list">
            スマホ用
        </div>
    </div>

</div>


@endsection

@section('script')
<script src="{{asset('js/calendar.js')}}"></script>
@endsection