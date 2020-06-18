@extends('layouts.app')

@section('title', '- Tạo đề thi')

@section('content')
<div class="container">
    <div class="align-content-center">
        @include('test.form', ['action' => 'create'])
    </div>
</div>
@endsection