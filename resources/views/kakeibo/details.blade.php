@extends('layout')
@section('style')
<link rel="stylesheet" href="{{asset('css/detail.css')}}">
<!-- flatpickrのスタイルシート -->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
@endsection

@section('content')
<h1 class="home-index">詳細一覧</h1>
<div class="container">
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
    <div class="select-edit-bar">
        <div class="before-select-edit-bar-left active">
            <input type="checkbox" id="all-select">
            <label for="all-select">全選択</label>
        </div>
        <div class="after-select-edit-bar-left" id="delete-btn">
            <div class="delete-kakeibo">
                <button class="btn btn-danger btn-block" data-bs-toggle="modal" data-bs-target="#deleteModal" type="button" id="delete-button">
                    削除する
                </button>
            </div>
        </div>
        <div class="select-edit-bar-right">
            <p>支出額: {{ $spendCount }}件 | 収入額: {{ $incomCount }}件 | 合計: {{ $allCount }}件</p>
        </div>
    </div>
    <div class="money-table">
        <div class="kakeibo-table">
            <table>
                <h5>支出額</h5>
                @foreach($spendDetails as $detail)
                <tr class="table-row">
                    <input type="hidden" class="kakeibo-id" value="{{ $detail->id }}">
                    <td class="select-check-box">
                        <input type="checkbox" class="checks">
                    </td>
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
                    <td class="kakeibo-id">
                        {{$detail->id}}
                    </td>
                    <td class="select-check-box">
                        <input type="checkbox" class="checks">
                    </td>
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
    </div>
    <!-- 削除モーダル -->
    <div class="modal fade" id="deleteModal" tabindex="-1" aria-labelledby="deleteModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Caution</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    選択した項目を削除します。<br>よろしいですか？
                </div>
                <div class="modal-footer">
                    <form action="{{ route('kakeibo.details', ['date' => $date]) }}" method="post" id="form">
                        @csrf
                        <div id="select-delete-list"></div>
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                        <button type="button" class="btn btn-primary" id="confirm-delete">OK</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('script')
<script src="{{asset('js/sp-drawer.js')}}"></script>
<script src="{{asset('js/check.js')}}"></script>
@endsection