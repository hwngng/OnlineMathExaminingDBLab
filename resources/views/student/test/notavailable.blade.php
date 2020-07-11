@extends('layouts.app')

@section('title', 'Kết quả của $user->first_name')

@section('dropdown-student')

@endsection

@section('content')
<div class="container jumbotron">

    <div class="card" style="">
        <div class="card-header">
            Bài thi đã kết thúc
        </div>
        <div class="card-body">
            <a href="{{ route('student.test.result',[Auth::id(),$test->id])}}" class="card-link">Xem kết quả</a>
        </div>

    </div>
</div>



@endsection
