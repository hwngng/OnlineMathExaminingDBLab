@extends('layouts.app')

@section('title',$test->name )

@section('header')

<!-- <link rel="stylesheet" href="{{ asset('css/exam.min.css') }}"> -->
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
        <div class="col-sm-3 col-md-2 sidebar">
            <ul class="nav nav-sidebar">
                @php
                $i = 1
                @endphp
                @foreach($test->questions as $q)
                <li>
                    <a href="#quest-'.{{ $i }}.'" class="nav-item">Câu {{ $i }}
                        <span class="tick" id="tick-'.{{ $i++ }}.'">✓</span>
                    </a>
                </li>
                @endforeach
            </ul>
        </div>
        <div class="col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2 main">
            <h1 class="page-header">{{ $test->name }}</h1>


            <div class="align-content-center">
                <div class="">
                    @isset($test)
                    @foreach($test->questions as $q)
                    <div class="" style="max-width: 45em">
                        {!! htmlspecialchars_decode($q->content) !!}
                    </div>

                    <div class="custom-control custom-radio">
                        <input id="credit" name="choice" type="radio" class="custom-control-input" required>
                        <label class="custom-control-label" for="credit"></label>
                    </div>

                    @endforeach
                    @endisset
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
@section('end')
@endsection
