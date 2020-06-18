@extends('layouts.app')

@section('title', '- Chỉnh sửa câu hỏi')

@section('content')
<div class="container">
    <div class="align-content-center">
        @include('question.form', ['action' => 'update'])
    </div>
</div>
@endsection

