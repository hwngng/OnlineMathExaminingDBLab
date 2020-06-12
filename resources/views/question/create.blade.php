@extends('layouts.app')

@section('title', '- Tạo câu hỏi')
    
@section('content')
<div class="container">
    <div class="align-content-center">
        @include('question.form', ['action' => 'create'])
    </div>
</div>
@endsection