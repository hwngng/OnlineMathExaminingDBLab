@extends('layouts.app')

@section('title', 'Kết quả của $user->first_name')

@section('dropdown-student')

@endsection

@section('content')
<div class="container">
    <h1 class="text-center my-3"> Kết quả {{ $test_name }}</h1>
    @isset($workHistories)
    <table class="table">
        <thead>
            <tr>
                <th>Tên</th>
                <th>Họ</th>
                <th>Số câu đúng</th>
                <th>Tổng số câu</th>
            </tr>
        </thead>
        <tbody>

            @foreach ($workHistories as $workHistory)
            <tr class="" id="user-{{ $workHistory->user->id }}">
                <td>{{ $workHistory->user->first_name }}</td>
                <td>{{ $workHistory->user->last_name }}</td>
                <td>{{ $workHistory->no_of_correct }}</td>
                <td>{{ $no_of_questions }}</td>
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
