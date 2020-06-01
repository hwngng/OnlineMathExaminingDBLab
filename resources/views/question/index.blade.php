@extends('layouts.app')

@section('header')
<script type="text/x-mathjax-config">
	MathJax.Hub.Config({
		extensions: ["tex2jax.js"],
		tex2jax: {inlineMath: [["$","$"], ["\\(","\\)"]]},
	});
</script>
{{-- <script type="text/javascript" async src="{{ asset('js/mathjax/tex-chtml.js') }}"></script> --}}
<script type="text/javascript" async src="https://cdnjs.cloudflare.com/ajax/libs/mathjax/2.7.7/MathJax.js?config=TeX-AMS_CHTML"></script>
@endsection

@section('content')

<div style="margin: 0 10% 0 10%" class="">
	<div style="margin-bottom: 10px">
		<a class="btn btn-success float-right" href="{{  route('teacher.question.create') }}">Thêm câu hỏi <i class="fas fa-plus"></i></a>
	</div>

	<table class="table">
		<thead>
			<tr>
				<th>STT</th>
				<th>Câu hỏi</th>
				<th>Thao tác</th>
			</tr>
		</thead>
		<tbody>
			@php
				$i = 1
			@endphp
			@isset($questions)
				@foreach ($questions as $question)
				<tr>
					<td>{{ $i++ }}</td>
					<td>{!! htmlspecialchars_decode($question->content) !!}</td>
					<td><a class="btn btn-primary" href="#"><i class="fas fa-edit"></i></a></td>
				</tr>
				@endforeach
			@endisset
		</tbody>
	</table>
</div>
@endsection
