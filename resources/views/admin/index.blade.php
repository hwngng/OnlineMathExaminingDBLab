@extends('layouts.app')

@section('title', 'Quản Trị Viên')

@section('content')
<div class="container">
	<a href="{{  route('admin.user.list') }}" class="btn btn-light ">User List</a>
</div>
@endsection
