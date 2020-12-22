@extends('layout')
@section('style')
<link rel="stylesheet" href="{{asset('css/detail.css')}}">
@endsection

@section('content')
<h1 class="home-index">詳細一覧</h1>
<dic class="container">
    <h2 class="date-title">{{date('Y年m月', strtotime($budget->date))}}</h2>
    <table class="kakeibo-table">
        @foreach($details as $detail)
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
            <td>{{$detail->money}}円</td>
        </tr>
        @endforeach
    </table>
</dic>
@endsection