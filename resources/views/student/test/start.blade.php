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

<!-- how dash array value is calculated -->
<!-- perimeter = 2 * PI * radius -->
<!-- perimeter = 2 * PI * 190 = 1193.80 -->

<div class="container timer">
    <svg width="400" height="400">
        <circle r="190" cx="200" cy="200" stroke="green" stroke-width="15" fill="white"
            transform="rotate(-90 200 200)" />
    </svg>
    <div class="timer-container">
        <input id="duration" value="{{ 60 * $test->duration }}" disabled>
    </div>

</div>

<div class="container-fluid">
    <div class="row">
        <div class="col-sm-3 col-md-2 sidebar shadow-sm">
            <ul class="nav nav-sidebar flex-column">
                @php
                $i = 1
                @endphp
                @foreach($test->questions as $q)
                <li class="nav-item px-3 ">
                    <div class="row align-content-between full-height">
                        <a href="#quest-{{ $i-1 }}" class="col-7">
                            Câu {{ $i++ }}
                        </a>
                        <div class="col-1 mr-2 question-status" id="tick-{{ $q->id }}"></div>
                        <div class=" col-2">
                            <i class="fa fa-flag"></i>
                        </div>
                    </div>
                    <hr>
                </li>
                @endforeach
                <button type="submit" class="btn btn-success flex-end" id="test-submit">Hoàn Thành</button>
            </ul>
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
<script src="{{ asset('js/doing-test.js') }}"></script>
<script>
    const notify = (msg, type) => {
        $('#message').addClass(`alert-${type}`);
        $('#message').html(`<strong> ${msg} </strong>`);
        $('#message').removeClass('fade');
        $('#message').delay(500);
        $('#message').fadeToggle(500);

    };

    let getAllTestResult = () => {
        let CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');
        let data = {};
        data['test_id'] = '{{ $test -> id }}';
        data['_token'] = CSRF_TOKEN;
        data['question_id'] = [];
        data['choice_ids'] = [];
        data['length'] = {{ $test->no_of_questions }};

        for (let i = 1; i <=  data['length'] ; i++) {
            let choice_ids = -1;
            for (let j = 65; j < 65+4; j++) {
                answerDOM = $(`input[id="choice-${j}-${i}"]`);
                if(answerDOM.is(':checked')) {
                    choice_ids = answerDOM.val();
                }
                [_, question_id] = answerDOM.attr('name').split('-');
            }
            data['question_id'].push(question_id);
            data['choice_ids'].push(choice_ids);
        }

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
    }

    $('input[id^="choice-"]').change(function() {

        let CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');
        let data = {};
        data['_token'] = CSRF_TOKEN;
        [_, question_id] = $(this).attr('name').split('-');
        choice_ids = $(this).val();

        data['question_id'] = question_id;
        data['choice_ids'] = choice_ids;

        console.log(data);
        $.ajax({
            method: "POST",
            url: "{{ route('student.test.update','') }}" + '/' + '{{ $test->id }}',
            data: data,
            success: function () {
                $(`#tick-${question_id}`).addClass('tick');
                notify('Answered !!', 'success');
            }
        });
    })




    $('#test-submit').click(function () {
        getAllTestResult();
    })

</script>

@endsection
