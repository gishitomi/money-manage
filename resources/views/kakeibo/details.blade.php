@extends('layout')
@section('style')
<link rel="stylesheet" href="{{asset('css/detail.css')}}">
@endsection

@section('content')
<h1 class="home-index">詳細一覧</h1>
<dic class="container">
    <h2 class="date-title">
        <a href="{{route('kakeibo.details', ['date' => $past])}}">
            <span class="month-txt">前月</span>
        <i class="fas fa-chevron-left icon-color"></i>
        </a>
        {{date('Y年m月', strtotime($date))}}
        <a href="{{route('kakeibo.details', ['date' => $future])}}">
        <i class="fas fa-chevron-right icon-color"></i>
        <span class="month-txt">翌月</span>
        </a>
    </h2>
    <div class="money-table">
        <div class="kakeibo-table">
            <table>
                <h5>支出額</h5>
                @foreach($spendDetails as $detail)
                <tr class="table-row">
                    <td class="table-left">
                        <div class="table-icon">
                            {!! $detail->type_icon !!}
                        </div>
                        <div class="table-left-text">
                            <p class="date-text">{{$detail->date}}</p>
                            <p class="title-text">{{$detail->type}}</p>
                        </div>
                    </td>
                    <td>{{$detail->description}}</td>
                    <td>{{$detail->money}}円</td>
                </tr>
                @endforeach
            </table>
            <div class="border"></div>
            <div class="total">
                <p>計: {{$totalSpend}}円</p>
            </div>
        </div>
        <div class="kakeibo-table">
            <table>
                <h5>収入額</h5>
                @foreach($incomDetails as $detail)
                <tr class="table-row">
                    <td class="table-left">
                        <div class="table-icon">
                            {!! $detail->type_icon !!}
                        </div>
                        <div class="table-left-text">
                            <p class="date-text">{{$detail->date}}</p>
                            <p class="title-text">{{$detail->type}}</p>
                        </div>
                    </td>
                    <td>{{$detail->description}}</td>
                    <td>{{$detail->money}}円</td>
                </tr>
                @endforeach
            </table>
            <div class="border"></div>
            <div class="total">
                <p>計: {{$totalIncom}}円</p>
        </div>
    </div>
</dic>
@endsection