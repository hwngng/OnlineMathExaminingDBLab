@extends('layouts.app')

@section('title', 'Kết quả của '. e($user->first_name))

@section('dropdown-student')

@endsection

@section('content')
<div class="container jumbotron fixed modal-dialog modal-xl modal-dialog-centered">

    <div class="card w-100 h-100">
        <div class="card-header">
            Kết quả bài thi
            <strong>
                {{ $test->name }}
            </strong>
        </div>
        <ul class="list-group list-group-flush">
            <li class="list-group-item">
                Thí sinh:
                <strong class="h3 mx-3">
                    {{ $user->last_name }} {{ $user->first_name }}
                </strong>
            </li>
            <li class="list-group-item ">
                Số câu đúng:
                <code class="h2 mx-3">
                    <strong>
                        {{ $workHistory->no_of_correct }}
                    </strong>
                    /
                    <strong>
                        {{ $test->no_of_questions }}
                    </strong>
                </code>

            </li>
            <li class="list-group-item">
                <a href="{{ route('student.index') }}" class="card-link">
                    Trang chủ
                </a>
            </li>
        </ul>
    </div>
</div>



@endsection
