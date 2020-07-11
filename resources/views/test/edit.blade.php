@extends('layouts.app')

@section('title', '- Chỉnh sửa đề thi')

@section('content')
<div class="container">
    <div class="align-content-center">
        @include('test.form', ['action' => 'edit'])
    </div>
</div>
@endsection