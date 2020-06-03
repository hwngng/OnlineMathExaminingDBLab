@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Dashboard</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    You are logged in!
                    @can('be-admin')
                        <h1>I am admin</h1>
                    @endcan
                    @can('be-teacher')
                        <h1>I am teacher</h1>
                    @endcan
                    @can('be-student')
                        <h1>I am student</h1>
                    @endcan
                    @can('be-guest')
                        <h1>I am guest</h1>
                    @endcan
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
