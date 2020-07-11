@extends('layouts.app')

@section('title', '- Đề thi')

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
	
	<style>
		.order-header {
			width: 3%
		}
		.title-header {
			width: 15%;
		}
		.grade-header {
			width: 5%;
		}
		.no-question-header {
			width: 10%
		}
		.duration-header {
			width: 18%
		}
		.created-by-header {
			width: 12%
		}
		.created-at-header {
			width: 10%
		}
		.description-header {
			width: 17%
		}
		.action-header {
			width: 10%;
		}
	</style>
@endsection

@section('content')
	<div class="container">
		<div class="align-content-center">
			<div>
				<a class="btn btn-success float-right mb-1" href="{{  route('teacher.test.create') }}" target="_blank">
					Thêm Đề thi <i class="fas fa-plus"></i>
				</a>
			</div>
			<div class="">
				<table class="table table-bordered">
				    <thead>
				        <tr class="">
				            <th class="order-header">STT</th>
				            <th class="title-header">Tiêu đề</th>
				            <th class="grade-header">Lớp</th>
				            <th class="no-question-header">Số câu hỏi</th>
				            <th class="duration-header">Thời gian làm bài</th>
				            <th class="created-by-header">Người ra đề</th>
				            <th class="created-at-header">Tạo lúc</th>
				            <th class="description-header">Ghi chú</th>
				            <th class="action-header">Thao tác</th>
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
				            <td>{{ $test->createdBy->username }}</td>
				            <td>{{ $test->created_at }}</td>
				            <td>{{ $test->description }}</td>
				            <td>
				                <a class="btn btn-primary btn-sm" href="{{ route('teacher.test.edit', $test->id) }}" target="_blank"><i class="fas fa-edit"></i></a>
				                <a class="btn btn-danger btn-sm" href="#"><i class="fas fa-trash"></i></a>
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
