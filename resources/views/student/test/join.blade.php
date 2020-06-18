@extends('layouts.app')

@section('title',$test->name )

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
        <h3 class="title text-center mb-3"> {{ $test->name }} </h3>


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
@endsection
@section('end')
@endsection
