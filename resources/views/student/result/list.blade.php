@extends('layouts.app')

@section('title', 'Kết quả '. $user->username)

@section('dropdown-student')

@endsection

@section('header')

<style>



    col:nth-last-child(3) {
        background: rgb(247, 238, 214);
    }

    col:nth-last-child(2) {
        background: rgb(245, 235, 206);
    }

    col:last-child {
        background: rgb(247, 194, 194)
    }



    thead>tr>th {
        background: rgb(244, 247, 246)
    }
</style>

@endsection

@section('content')
<div class="container">
    <h1 class="text-center my-3"> Kết quả của {{ $user->first_name }} {{ $user->last_name }}</h1>
    @isset($workHistories)
    <table class="table">
        <thead>
            <tr>
                <th>Tên bài thi</th>
                <th>Lớp</th>
                <th>Thời gian làm bài</th>
                <th>Người ra đề</th>
                <th>Số câu đúng</th>
                <th>Tổng số câu</th>
                <th>Score</th>
            </tr>
        </thead>
        <tbody>
            <col>
            <col>
            <col>
            <col>
            <col>
            <col>
            <col>

            @foreach ($workHistories as $workHistory)
            <tr class="" id="user-{{ $workHistory->user->id }}">
                <td>{{ $workHistory->test->name }}</td>
                <td>{{ $workHistory->test->grade_id }}</td>
                <td>{{ $workHistory->test->duration }} phút</td>
                <td>{{ $workHistory->test->createdBy->first_name }}</td>

                <td>{{ $workHistory->no_of_correct }}</td>
                <td>{{ $workHistory->no_of_questions }}</td>
                <td>{{ $workHistory->score }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
</div>
@endisset

@empty($workHistories)
<div class="modal-header">
    <h5 class="modal-title">Không có kết quả hoặc chưa từng thi</h5>
    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
        <span aria-hidden="true">&times;</span>
    </button>
</div>
@endempty

</div>


@endsection
