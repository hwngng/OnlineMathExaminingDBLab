@extends('layouts.app')

@section('title')

@section('dropdown-student')

@endsection

@section('content')
<div class="container jumbotron">

    <div class="card" style="">
        <div class="card-header">
            Bài thi đã kết thúc
        </div>
        <div class="card-body">
            <a href="{{ route('student.result',[Auth::id(),$test_id])}}" class="card-link">Xem kết quả</a>
        </div>

    </div>
</div>



@endsection
