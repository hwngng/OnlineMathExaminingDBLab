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
    <div class="container-fluid">
        <form class="needs-validation" novalidate action="{{route('admin.user.create', [], false) }}" id="newUserForm"
            method="POST">
            @csrf
            <div class="row">


                {{-- AVATAR field --}}
                <div class="col-md-4 order-md-2 mb-4">
                    <h4 class="d-flex justify-content-center align-items-center mb-3">
                        <span class="badge badge-secondary badge-pill"> Avatar</span>
                    </h4>
                    <div class="avatar-wrapper">
                        <img class="profile-pic" src="" />
                        <div class="upload-button">
                            <i class="fa fa-arrow-circle-up" aria-hidden="true"></i>
                        </div>
                        <label for="avatar"> &lt; 1MB</label>
                        <input class="file-upload" type="file" accept="image/*" id="avatar" />
                    </div>
                </div>

                {{-- Main info field --}}
                <div class="col-md-8 order-md-1">
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="firstName">First name</label>
                            <input type="text" class="form-control" id="firstName" name="first_name"
                                value="{{ $user->first_name }}">
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="lastName">Last name</label>
                            <input type="text" class="form-control" id="lastName" name="last_name"
                                value="{{ $user->last_name }}">
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
                                <span class="input-group-text"><i class="fa fa-address-book"></i></span>
                            </div>
                            <input type="text" class="form-control" id="address" name="address"
                                value="{{ $user->address }}">
                            <div class="invalid-feedback">Please enter your address.
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-7 mb-3">
                            <label for="school"">Trường</label>
                            <div class=" input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text"><i class="fa fa-school"></i></span>

                                </div>
                                <input class=" form-control" id="school" name="school" required type=" text"
                                    list="schools" @foreach ($schools as $school) @if ($school->id ==
                                $user->school_id)
                                value="{{ $school->name }}"
                                @endif
                                @endforeach

                                />
                                <datalist id="schools">
                                    @foreach ($schools as $school)
                                    <option data-schoolid="{{ $school->id }}">{{ $school->name }}</option>
                                    @endforeach
                                </datalist>
                        </div>
                    </div>
                    <div class="col-md-5 mb-3">
                        <label for="grade">Cấp học</label>
                        <div class=" input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text"><i class="fa fa-snowflake" aria-hidden="true"></i></span>

                            </div>
                            <input class=" form-control" id="grade" name="school" required type=" text" list="grades"
                                value="{{ $user->grade_id }}" autocomplete="off" />
                            <datalist id="grades">
                                @foreach ($grades as $grade)
                                <option>{{ $grade->id }}</option>
                                @endforeach
                            </datalist>
                            </select>
                        </div>
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
    $(".info").click(function() {

    let input = $(`<input type="text"
                    class="form-control"
                    id="telephone"
                    name="telephone">`,
                    {
                    val: $(this).text(),
                    }
                );
    $(this).replaceWith(input);
    input.select();
});


</script>
@endsection
