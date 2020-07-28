@extends('layouts.app')

@section('title', 'Danh sách bài thi')

@section('header')
<script type="text/x-mathjax-config">
    MathJax.Hub.Config({
		extensions: ["tex2jax.js"],
		tex2jax: {inlineMath: [["$","$"], ["\\(","\\)"]]},
	});
</script>
<script type="text/javascript" src="{{ asset('js/mathjax/tex-chtml.js') }}"></script>
{{-- <script type="text/javascript" async
    src="https://cdnjs.cloudflare.com/ajax/libs/mathjax/2.7.7/MathJax.js?config=TeX-AMS_CHTML"></script> --}}
@endsection

@section('content')
<div class="container">
    <div class="align-content-center">
        <h3 class="title text-center mb-3"> Danh sách bài thi </h3>
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
                        <th>Tạo lúc</th>
                        <th>Ghi chú</th>
                        <th>Vào Thi </th>
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
                        <td>{{ $test->duration }} phút</td>
                        <td>{{ $test->createdBy->first_name }}</td>
                        <td>{{ $test->created_at }}</td>
                        <td>{{ $test->description }}</td>
                        <td>
                            <a class="btn btn-primary btn-sm" href=" {{ route('student.test.start',$test->id) }}"><i
                                    class="fas fa-arrow-right"></i></a>
                        </td>
                    </tr>
                    @endforeach
                    @endisset
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
