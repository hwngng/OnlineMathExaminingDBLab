@extends('layouts.app')

@section('title', 'Kết quả của $user->first_name')

@section('dropdown-student')

@endsection

@section('content')
<div class="container">
    <div class="align-content-center">
        <h3 class="title text-center mb-3"> Kết quả </h3>
        <div class="">
            <table class="table">
                <thead>
                    <tr class="">
                        <th>STT</th>
                        <th>Tiêu đề</th>
                        <th>Lớp</th>
                        <th>Số câu hỏi</th>
                        <th>Thời gian làm bài</th>
                        <th>Người ra đề</th>
                        <th>Ghi chú</th>
                        <th>Xem điểm </th>
                    </tr>
                </thead>
                <tbody>
                    @php
                    $i = 1
                    @endphp
                    @isset($tests)
                    @foreach ($tests as $test)
                    <tr id="{{ $test->id }}" class="">
                        <td class="order">{{ $i++ }}</td>
                        <td>{{ $test->name }}</td>
                        <td>{{ $test->grade_id }}</td>
                        <td>{{ $test->no_of_questions }}</td>
                        <td>{{ $test->duration }}</td>
                        <td>{{ $test->createdBy->first_name }}</td>
                        <td>{{ $test->description }}</td>
                        <td>
                            <a class="btn btn-primary" href="{{ route('teacher.result.detail',$test->id)}}">
                                <i class="fas fa-circle" aria-hidden="true"></i>
                            </a>
                        </td>
                    </tr>
                    @endforeach
                    @endisset

                    @empty($tests)
                    <h1 class="text-center">
                        Không có bài thi nào được lưu trong hệ thống !!
                    </h1>
                    @endempty
                </tbody>
        </div>
    </div>
</div>


@endsection
