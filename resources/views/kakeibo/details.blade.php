@extends('layout')
@section('style')
<link rel="stylesheet" href="{{asset('css/detail.css')}}">
@endsection

@section('content')
<h1 class="home-index">詳細一覧</h1>
<dic class="container">
    <h2 class="date-title">{{date('Y年m月', strtotime($date))}}</h2>
    <div class="money-table">
    <table class="kakeibo-table">
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
    <table class="kakeibo-table">
    <h5>収入額</h5>
    </table>
    </div>
</dic>
@endsection