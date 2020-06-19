@extends('layouts.app')

@section('title',$test->name )

@section('header')

<link rel="stylesheet" href="{{ asset('css/exam.css') }}">
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
<div class="container-fluid">
    <div class="row">
        <div class="col-sm-3 col-md-2 sidebar shadow-sm">
            <ul class="nav nav-sidebar">
                @php
                $i = 1
                @endphp
                @foreach($test->questions as $q)
                <li>
                    <a href="#quest-{{ $i }}" class="nav-item">Câu {{ $i }}
                        <span class="tick" id="tick-'.{{ $i++ }}.'">✓</span>
                    </a>
                </li>
                @endforeach
            </ul>
            <button type="submit" class="btn btn-success" id="test-submit">Hoàn Thành</button>
        </div>
        <div class="col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2 main">
            <div class="alert alert-success fade text-center" role="alert" id="message">
            </div>
            <h1 class="page-header">{{ $test->name }}</h1>

            <div class="align-content-center">
                <div class="">
                    @isset($test)
                    @php
                    $i = 1
                    @endphp
                    @foreach($test->questions as $q)
                    <div id="quest-{{ $i }}" class="" style="max-width: 45em">
                        <strong>Câu {{ $i }}</strong>
                        {!! htmlspecialchars_decode($q->content) !!}
                    </div>

                    @php
                    $j = 65
                    @endphp
                    @foreach($q->choices as $c)
                    <div class="row py-3">
                        <div class="col-md-1">
                            <strong>
                                {{ chr($j) }}.
                            </strong>
                        </div>
                        <div class="col-md-11 custom-control custom-radio">
                            <input id="choice-{{ $j }}-{{ $i }}" name="choice-{{ $q->id }}" type="radio"
                                class="custom-control-input" value="{{ $c->id }}" required>
                            <label class="custom-control-label" for="choice-{{ $j++ }}-{{ $i }}">
                                {!! htmlspecialchars_decode($c->content) !!}
                            </label>
                        </div>
                    </div>
                    @endforeach
                    @php
                    $i++
                    @endphp
                    <hr>
                    @endforeach
                    @endisset
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
@section('end')
<script>
    const notify = (msg, type) => {
        $('#message').addClass(`alert-${type}`);
        $('#message').html(`<strong> ${msg} </strong>`);
        $('#message').removeClass('fade');
        $('#message').delay(500);
        $('#message').fadeToggle(500);

    }

    $('#test-submit').click(function () {
        let CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');
        let data = {};
        let choice_ids = -1;
        let question_id = -1;
        data['test_id'] = '{{ $test -> id }}';
        data['_token'] = CSRF_TOKEN;
        data['question_id'] = [];
        data['choice_ids'] = [];
        @php
        $i = 1
        @endphp

        @foreach($test -> questions as $q)
        [choice_ids, question_id] = [ $('input[name="choice-{{ $q->id }}"]:checked').val() || '-1' , '{{ $q->id }}'];

        data['question_id'].push(question_id);
        data['choice_ids'].push(choice_ids);
        @endforeach
        console.log(data);
        $.ajax({
            method: "POST",
            url: '{{ route('student.test.finish') }}',
            data: data,
            success: function () {
                notify('sent', 'success');
                // window.location.assign('{{ route('student.test.result', Auth:: user() -> id) }}');
            }
        });

    })


</script>

@endsection
