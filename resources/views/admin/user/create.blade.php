<div class="container-fluid">
    <form class="needs-validation" novalidate action="{{route('admin.user.create', [], false) }}" id="newUserForm"
        method="POST">
        @csrf
        <div class="row">
            <div class="col-md-4 order-md-2 mb-4">
                <h4 class="d-flex justify-content-center align-items-center mb-3">
                    <span class="badge badge-secondary badge-pill"> Avatar</span>
                </h4>

                <div class="avatar-wrapper">
                    <img class="profile-pic" src="" />
                    <div class="upload-button">
                        <i class="fa fa-arrow-circle-up" aria-hidden="true"></i>
                    </div>
                    <label for="avatar"> &lt; 2MB</label>
                    <input class="file-upload" type="file" accept="image/*" id="avatar" />
                </div>
            </div>
            <div class="col-md-8 order-md-1">
                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label for="firstName">First name</label>
                        <input type="text" class="form-control @error('first_name') is-invalid @enderror" id="firstName"
                            name="first_name" placeholder="" value="{{ old('first_name') }}" required>
                        @error('first_name')
                        <div class="invalid-feedback">Valid first name is required.
                        </div>
                        @enderror

                    </div>
                    <div class="col-md-6 mb-3">
                        <label for="lastName">Last name</label>
                        <input type="text" class="form-control @error('last_name') is-invalid @enderror" id="lastName"
                            name="last_name" placeholder="" value="{{ old('last_name') }}" required>
                        @error('last_name')
                        <div class="invalid-feedback">Valid last name is required.
                        </div>
                        @enderror
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label for="username">Username</label>
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text"><i class="fa fa-user"></i></span>
                            </div>
                            <input type="text" class="form-control @error('username') is-invalid @enderror"
                                id="username" placeholder="Username" name="username" value="{{ old('username') }}"
                                required>
                            @error('username')
                            <div class="invalid-feedback" style="width: 100%;">Your username is required.
                            </div>
                            @enderror

                        </div>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label for="email">
                            Email <span class="text-muted">(Optional)</span>
                        </label>
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text"><i class="fa fa-envelope"></i></span>
                            </div>
                            <input type="email" class="form-control" name="email" id="email"
                                placeholder="you@example.com">
                            <div class="invalid-feedback">Please enter a valid email address.
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label for="password">Mật khẩu</label>
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text"><i class="fa fa-lock"></i></span>
                            </div>
                            <input type="password"" class=" form-control @error('password') is-invalid @enderror"
                                name="password" id="password" placeholder="password" required>
                            @error('password')

                            <div class="invalid-feedback" style="width: 100%;">Your password is required.
                            </div>
                            @enderror

                        </div>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label for="password-confirm">Nhập lại mật khẩu</label>
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text"><i class="fa fa-lock"></i></span>
                            </div>
                            <input type="password" class=" form-control" name="password_confirmation"
                                id="password-confirm" autocomplete required>

                            <div class="invalid-feedback " style="width: 100%;">Password does not match.
                            </div>
                        </div>


                    </div>
                </div>

                <div class="mb-3">
                    <label for="address">Address <span class="text-muted">(Optional)</label>
                    <input type="text" class="form-control" id="address" name="address" placeholder="1234 Main St">
                    <div class="invalid-feedback">Please enter your address.
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-7 mb-3">
                        <label for="school"">School</label>
                        <select class=" custom-select d-block w-100" id="school" name="school" required>
                            <option value="">Choose...</option>
                            @foreach ($schools as $school)
                            <option value="{{ $school->id }}">{{ $school->name }}</option>
                            @endforeach
                            </select>
                            <div class="invalid-feedback">Please provide a valid school.
                            </div>
                    </div>
                    <div class="col-md-5 mb-3">
                        <label for="grade">Cấp học</label>
                        <select class=" custom-select d-block w-100" id="grade" name="grade_id" required>
                            <option value="">
                                Choose...
                                <!-- <input type="number" id="newGrade" name="newGrade" placeholder=""> -->
                            </option>
                            @foreach ($grades as $grade)
                            <option value="{{ $grade->id }}">
                                {{ $grade->id }}
                            </option>
                            @endforeach
                        </select>
                        <div class="invalid-feedback">Please provide a valid grade.
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-4 mb-3">
                        <label for="telephone">Phone number<span class="text-muted">(Optional)</label>
                        <input type="text" class="form-control" id="telephone" name="telephone" placeholder="012345678">
                        <div class="invalid-feedback">Telephone number required.
                        </div>
                    </div>
                    <div class="col-md-5 mb-3">
                        <label for="birthdate">Ngày sinh <span class="text-muted">(Optional)</label>
                        <input type="date"" class=" form-control" id="birthdate" name="birthdate"
                            placeholder="01/01/1999">
                        <div class="invalid-feedback">birthdate required.
                        </div>
                    </div>
                    <div class="col-md-3 mb-3">
                        <label for="grade">Role</label>
                        <select class=" custom-select d-block w-100" id="role" name="role_ids" required>
                            @foreach ($roles as $role)
                            <option value="{{ $role->id }}">
                                {{ $role->name }}
                            </option>
                            @endforeach
                        </select>
                        <div class=" invalid-feedback">Please provide a valid grade.
                        </div>
                    </div>
                </div>

                <hr class="mb-4">


                <button class="btn btn-primary btn-lg btn-block save-button" type="submit"
                    name="submit-btn">Continue</button>
    </form>
</div>

@section('script')

<script>

    $('#newUserForm').submit(function (e) {
        e.preventDefault();
        let CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');
        let form_url = $(this).attr("action");
        let form_method = $(this).attr("method");


        //TODO: get school_id from form
        // let schoolId = $('#school').attr("value");
        // console.log(schoolId);

        let form_data = $(this).serialize();
        $(this)['school_id'] = $('#school').val();


        console.log(form_data);
        $.ajax({
            type: form_method,
            url: form_url,
            data: form_data,
            success: function (response) {
                if (response['return_code'] == '0') {
                    if (!confirm("Thêm tài khoản thành công!")) {
                        close();
                    } else {
                        window.location.reload();
                    }
                } else {
                    alert("Thêm tài khoản thất bại.\nVui lòng thử lại hoặc ấn Ctrl + F5 rồi tạo lại tài khoản")
                }
            }
        });
    })
</script>

@endsection
