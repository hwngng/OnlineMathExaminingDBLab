@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Thông báo</div>
                <div class="card-body">
                    Chào bạn, @auth {{ Auth::user()->first_name }}! @else khách! @endauth
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
