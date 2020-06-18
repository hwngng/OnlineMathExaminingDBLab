@extends('layouts.app')

@section('title', '- Quản lý câu hỏi')
    
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
    div.scrollable {
			max-height: 10em;
			margin: 0;
			padding: 0;
			overflow: auto;
	}
    .order-header {
        width: 3%;
    }
    .question-header {
        width: 82%;
    }
    .grade-header {
        width: 5%
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
            <a class="btn btn-success float-right mb-1" href="{{  route('teacher.question.create') }}" target="_blank">
                Thêm Câu hỏi <i class="fas fa-plus"></i>
            </a>
        </div>

        <table class="table">
            <thead>
                <tr>
                    <th class="order-header">STT</th>
                    <th class="question-header">Câu hỏi</th>
                    <th class="grade-header">Lớp</th>
                    <th class="action-header">Thao tác</th>
                </tr>
            </thead>
            <tbody>
                @php
                $i = 1
                @endphp
                @isset($questions)
                @foreach ($questions as $question)
                <tr id="{{ $question->id }}">
                    <td class="order" >{{ $i++ }}</td>
                    <td class="scrollable">{!! htmlspecialchars_decode($question->content) !!}</td>
                    <td>{{ $question->grade_id }}</td>
                    <td>
                        <a class="btn btn-primary btn-sm" href="{{ route('teacher.question.edit', $question->id) }}" target="_blank"><i class="fas fa-edit"></i></a>
                        <a class="btn btn-danger btn-sm" href="javascript:void(0)" onclick="deleteQuestion(event, {{ $question->id }})"><i class="fas fa-trash"></i></a>
                    </td>
                </tr>
                @endforeach
                @endisset
            </tbody>
        </table>
    </div>
</div>
@endsection

@section('end')
    <script>
        function deleteQuestion (e, questionId) {
            e.preventDefault();
            $.ajax({
                type: "get",
                url: "{{ route('teacher.question.destroy', '') }}" + '/' + questionId,
                success: function (response) {
                    if (response['return_code'] == 0) {
                        $('#' + questionId).animate("fast").animate({
                            opacity : "hide"
                        }, "slow", function () {
                            let nextRows = $(this).nextAll();
                            let order = parseInt($(this).children('td.order').text());
                            for (let i = 0; i < nextRows.length; ++i) {
                                $(nextRows[i]).children('td.order').text(order);
                                ++order;
                            }
                        });
                    } else {
                        alert("Có lỗi xảy ra, vui lòng ấn Ctrl + F5");
                    }
                }
            });
        }
    </script>
@endsection