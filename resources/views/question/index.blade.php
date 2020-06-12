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
    strong {
        font-weight: normal;
    }
</style>
@endsection

@section('content')
<div class="container">
    <div class="align-content-center">
        <div style="margin-bottom: 10px">
            <a class="btn btn-success float-right" href="{{  route('teacher.question.create') }}" target="_blank">Thêm câu hỏi <i
                    class="fas fa-plus"></i></a>
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
                <tr id="{{ $question->id }}">
                    <td class="order" >{{ $i++ }}</td>
                    <td>{!! htmlspecialchars_decode($question->content) !!}</td>
                    <td>
                        <a class="btn btn-primary btn-sm" href="{{ route('teacher.question.edit', $question->id) }}"><i class="fas fa-edit"></i></a>
                        <a class="btn btn-danger btn-sm" href="javascript:void(0)" onclick="deleteQuestion(event, {{ $question->id }}, {{ $i-1 }})"><i class="fas fa-trash"></i></a>
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
        function deleteQuestion (e, questionId, order) {
            e.preventDefault();
            $.ajax({
                type: "get",
                url: "{{ route('teacher.question.destroy', '') }}" + '/' + questionId,
                success: function (response) {
                    let no = order;
                    $('#' + questionId).animate("fast").animate({
                        opacity : "hide"
                    }, "slow", function () {
                        let nextRows = $(this).nextAll();
                        for (let i = 0; i < nextRows.length; ++i) {
                            $(nextRows[i]).children('.order').text(order);
                            ++order;
                        }
                    });
                }
            });
        }
    </script>
@endsection