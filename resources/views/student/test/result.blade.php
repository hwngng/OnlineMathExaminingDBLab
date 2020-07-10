@extends('layouts.app')

@section('title', 'Kết quả của $user->first_name')

@section('dropdown-student')

@endsection

@section('content')
<div class="container jumbotron">

    <div class="card" style="">
        <div class="card-header">
            Kết quả bài thi {{ $test->name }}
        </div>
        <ul class="list-group list-group-flush">
            <li class="list-group-item">Thí sinh {{ $user->last_name }} {{ $user->first_name }}</li>
            <li class="list-group-item">Số câu đúng: {{ $workHistory->no_of_correct }}/{{ $test->no_of_questions }}</li>
            <li class="list-group-item">
                <a href="{{ route('student.index') }}" class="card-link">Trang chủ</a>
            </li>
        </ul>
    </div>
</div>



@endsection
