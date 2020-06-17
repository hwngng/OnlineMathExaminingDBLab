@extends('layouts.app')

@section('title', '- Tạo đề thi')
	
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
	
@endsection