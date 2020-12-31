@extends('layout')
@section('style')
<link rel="stylesheet" href="{{asset('css/detail.css')}}">
<!-- flatpickrのスタイルシート -->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
@endsection

@section('content')
<h1 class="home-index">詳細一覧</h1>
<dic class="container">
    <div class="date-title">
        <a href="{{route('kakeibo.details', ['date' => $past])}}">
            <span class="month-txt">前月</span>
            <i class="fas fa-chevron-left icon-color"></i>
        </a>
        <h3 id="detail-date">{{date('Y年m月', strtotime($date))}}</h3>
        <a href="{{route('kakeibo.details', ['date' => $future])}}">
            <i class="fas fa-chevron-right icon-color"></i>
            <span class="month-txt">翌月</span>
        </a>
    </div>
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
            @if($totalSpend !== 0)
            <div class="border"></div>
            <div class="total">
                <p>計: {{$totalSpend}}円</p>
            </div>
            @else
            <p>{{date('Y年m月', strtotime($date))}}の支出金額はありません。</p>
            @endif
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
            @if($totalIncom !== 0)
            <div class="border"></div>
            <div class="total">
                <p>計: {{$totalIncom}}円</p>
            </div>
            @else
            <p>{{date('Y年m月', strtotime($date))}}の収入金額はありません。</p>
            @endif
        </div>
</dic>
@endsection