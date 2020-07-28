@extends('layouts.app')

@section('title', 'Học Sinh')

@section('dropdown-student')

@endsection

@section('header')

<link rel="stylesheet" href="{{ asset('css/avatar.css') }}">

<style>
    main {
        font-size: 1.4rem;
    }
</style>
@endsection

@section('content')
<div class="container">
    <h2 class="h2 text-body text-center">Cập nhật thông tin cá nhân</h2>
    <div class="container-fluid">
        <form class="needs-validation" novalidate action="{{route('student.update',[], false) }}" id="newUserForm"
            method="POST">
            @csrf
            <div class="row">

                <input type="text" class="form-control fade" id="id" name="id" value="{{ $user->id }}">

                {{-- AVATAR field --}}
                <div class="col-md-4 order-md-2 mb-4">
                    <h4 class="d-flex justify-content-center align-items-center mb-3">
                        <span class="badge badge-secondary badge-pill"> Avatar
                            <small class="quote">
                                &lt; 1MB
                            </small>
                        </span>

                    </h4>
                    <div class="avatar-wrapper">
                        <img class="profile-pic" src="{{ $user->avatar }}" alt="{{ $user->username }}" />
                        <div class="upload-button">
                        </div>
                        <input class="file-upload" type="file" accept="image/*" id="avatar" />
                    </div>
                </div>

                {{-- Main info field --}}
                <div class="col-md-8 order-md-1">
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="firstName">Tên </label>
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text"><i class="fa fa-info"></i></span>
                                </div>
                                <input type="text" class="form-control" id="firstName" name="first_name"
                                    value="{{ $user->first_name }}">
                            </div>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="lastName">Họ</label>
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text"><i class="fa fa-info-circle"></i></span>
                                </div>
                                <input type="text" class="form-control" id="lastName" name="last_name"
                                    value="{{ $user->last_name }}">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="email">
                                Email
                            </label>
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text"><i class="fa fa-envelope"></i></span>
                                </div>
                                <input type="email" class="form-control" name="email" id="email"
                                    placeholder="you@example.com" value="{{ $user->email }}">
                                <div class="invalid-feedback">Please enter a valid email address.
                                </div>
                            </div>
                        </div>
                    </div>


                    <div class="mb-3">
                        <label for="address">
                            Địa chỉ
                        </label>
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text"><i class="fa fa-map-marker"
                                        aria-hidden="true"></i></span>
                            </div>
                            <input type="text" class="form-control" id="address" name="address"
                                value="{{ $user->address }}">

                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-7 mb-3">
                            <label for="school"">Trường</label>
                            <div class=" input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text"><i class="fa fa-school"></i></span>

                                </div>
                                <input class=" form-control" id="school" name="school_name" required type=" text"
                                    list="schools" @foreach ($schools as $school) @if ($school->id ==
                                $user->school_id)
                                value="{{ $school->name }}"
                                @endif
                                @endforeach

                                />
                                <datalist id="schools">
                                    @foreach ($schools as $school)
                                    <option data-schoolid="{{ $school->id }}" value="{{ $school->name }}"></option>
                                    @endforeach
                                </datalist>
                        </div>
                    </div>
                    <div class="col-md-5 mb-3">
                        <label for="grade">Cấp học</label>
                        <select class="form_control custom-select d-block w-100" id="grade_id" name="grade_id" required>
                            <option {{ !isset($user->grade_id) ? 'selected value="-1"' : '' }}>....</option>
                            @foreach ($grades as $grade)
                            <option value="{{ $grade->id }}" {{ $user->grade_id == $grade->id ? 'selected' : '' }}>
                                {{ $grade->id }}
                            </option>
                            @endforeach
                        </select>

                    </div>
                </div>
                <div class="row">
                    <div class="col-md-4 mb-3">
                        <label for="telephone">Số Điện Thoại</label>
                        <div class=" input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text"><i class="fa fa-phone" aria-hidden="true"></i></span>

                            </div>
                            <input type="text" class="form-control" id="telephone" name="telephone"
                                value="{{ $user->telephone }}">
                        </div>
                    </div>
                    <div class="col-md-5 mb-3">
                        <label for="birthdate">
                            Ngày sinh
                            <span class="text-muted">(mm-dd-yyyy)</span>
                        </label>
                        <input type="date" class=" form-control" id="birthdate" name="birthdate"
                            value="{{ $user->birthdate }}">
                        <div class="invalid-feedback">birthdate required.
                        </div>
                    </div>

                </div>

                <hr class="mb-4">


                <button class="btn btn-primary btn-lg btn-block save-button" type="submit"
                    name="submit-btn">Save</button>
        </form>
    </div>


</div>
@endsection




@section('end')
<script src="{{ asset('js/avatar-upload.js') }}"></script>

<script>
    $('#newUserForm').submit(function (e) {
        e.preventDefault();
        let CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');
        let form_url = $(this).attr("action");
        let form_method = $(this).attr("method");

        let schoolName = $('#school').val();
        schoolId = $('#schools').children(`[value="${schoolName}"]`).data('schoolid');

        let form_data = $(this).serializeArray();


        form_data.push(
        {
            'name' : 'school_id',
            'value': schoolId,
        },
        );

        console.log($.param(form_data));
        $.ajax({
            type: form_method,
            url: form_url,
            data: form_data,
            success: function (response) {
                if (response['return_code'] == '0') {
                    window.location.replace('{{ route('student.index')}}');
                } else {
                    alert("Có lỗi xảy ra\nVui lòng thử lại")
                }
            }
        });
    })
</script>
@endsection
