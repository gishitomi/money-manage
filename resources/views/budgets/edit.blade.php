@extends('header')

@section('style')
<link rel="stylesheet" href="{{asset('css/edit.css')}}">
@endsection

@section('content')
<div class="card container">
    <form action="{{route('budgets.edit', ['date' => $date])}}" method="POST">
        @csrf
        <h1 class="edit-title">予算を設定する</h1>
        @if($errors->any())
        @foreach($errors->all() as $message)
        <p>{{$message}}</p>
        @endforeach
        @endif
        <h5>{{date('m', strtotime($date))}}月の設定予算</h5>
        @if(isset($budget))
        <p><input type="text" name="budget" id="budget" value="{{$budget->money}}">　円</p>
        @else
        <p><input type="text" name="budget" id="budget" value="{{old('budget')}}">　円</p>
        @endif
        <input type="hidden" name="date" id="date" value="{{$date . '-01'}}"> 
        <div class="submit-btn">
            <button type="submit" class="btn btn-block btn-success">決定</button>
        </div>
    </form>
</div>
@endsection