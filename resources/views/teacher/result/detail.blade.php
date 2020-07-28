@extends('layouts.app')

@section('title', 'Kết quả '. $test_name)

@section('dropdown-student')

@endsection

@section('header')

<style>
    col:last-child {
        background: rgb(247, 194, 194)
    }

    thead>tr>th {
        background: rgb(241, 233, 233)
    }
</style>

@endsection

@section('content')
<div class="container">
    <h1 class="text-center my-3"> Kết quả {{ $test_name }}</h1>
    <h2> Tổng số câu:
        <strong>
            {{ $no_of_questions }}
        </strong>
    </h2>
    @isset($workHistories)
    <table class="table">
        <thead>
            <tr>
                <th></th>
                <th>Tên</th>
                <th>Họ</th>
                <th>Số câu đúng</th>
                <th>Score</th>
            </tr>
        </thead>
        <tbody>
            <col>
            <col>
            <col>
            <col>
            <col>
            @foreach ($workHistories as $workHistory)
            <tr class="" id="user-{{ $workHistory->user->id }}">
                <td>
                    <img src="{{ $workHistory->user->avatar }}" class="small-avatar"
                        alt="{{ $workHistory->user->username }}">
                </td>
                <td>{{ $workHistory->user->first_name }}</td>
                <td>{{ $workHistory->user->last_name }}</td>
                <td>{{ $workHistory->no_of_correct }}</td>
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
    <h5 class="modal-title">Không có kết quả hoặc bài kiểm tra chưa bắt đầu</h5>
    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
        <span aria-hidden="true">&times;</span>
    </button>
</div>
@endempty

</div>


@endsection
