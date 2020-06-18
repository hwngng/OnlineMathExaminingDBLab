@extends('layouts.app')

@section('header')
<link rel="stylesheet" href="{{ asset('css/user.css') }}">
<link rel="stylesheet" href="{{ asset('css/user-create.css') }}">

@endsection

@section('content')
@csrf
<!-- Editable table -->
<div class="card">
    <h3 class="card-header text-center font-weight-bold text-uppercase py-4">User Dashboard</h3>
    <div class="alert alert-success fade text-center" role="alert" id="message">
    </div>
    <div class="card-body">
        <div id="table" class="table-editable">
            <span class="table-add float-right mb-3 mr-2" class="text-success" data-toggle="modal"
                data-target="#exampleModal"><a href="javascript:void(0)"><i class="fas fa-plus fa-2x"
                        aria-hidden="true"></i></a></span>
            <table class="table table-bordered table-responsive-md table-striped text-center">
                <thead>
                    <tr>
                        <th class="text-center"></th>
                        <th class="text-center">Tên Đăng Nhập</th>
                        <th class="text-center">Email</th>
                        <th class="text-center">Họ</th>
                        <th class="text-center">Tên</th>
                        <th class="text-center">Chức vụ</th>
                        <th class="text-center">Khối</th>
                        <th class="text-center">Địa chỉ</th>
                        <th class="text-center">Trường</th>
                        <th class="text-center">Số Điện Thoại</th>
                        <th class="text-center">Ngày sinh</th>
                        <th class="text-center">Reset password</th>
                        <th class="text-center">Save</th>
                        <th class="text-center">Remove</th>
                    </tr>
                </thead>
                <tbody>
                    @php
                    $i = 1
                    @endphp
                    @isset($users)
                    @foreach ($users as $user)
                    <tr id=" user-{{ $user->id }}">
                        <td class="pt-3-half">{{ $user->avatar }}</td>
                        <td id="username" class="pt-3-half">{{ $user->username }}</td>
                        <td id="email" class="pt-3-half changeable" contenteditable="true">{{ $user->email }}</td>
                        <td id="last_name" class="pt-3-half changeable" contenteditable="true">
                            {{ $user->last_name }}</td>
                        <td id="first_name" class="pt-3-half changeable" contenteditable="true">
                            {{ $user->first_name }} </td>
                        <td class="pt-3-half changeable">
                            <select class=" custom-select d-block w-100" id="role_ids" required>
                                @foreach ($roles as $role)
                                <option value="{{ $role->id }}" {{ $user->role_id == $role->id ? 'selected' : '' }}>
                                    {{ $role->name }} </option>
                                @endforeach
                            </select>
                        </td>
                        <td class="pt-3-half changeable">
                            <select class=" custom-select d-block w-100" id="grade_id" required>
                                <option {{ !isset($user->grade_id) ? 'selected value="-1"' : '' }}>....</option>
                                @foreach ($grades as $grade)
                                <option value="{{ $grade->id }}" {{ $user->grade_id == $grade->id ? 'selected' : '' }}>
                                    {{ $grade->id }}
                                </option>
                                @endforeach
                            </select>


                        </td>
                        <td class="pt-3-half changeable" id="address" contenteditable="true">{{ $user->address }}</td>
                        <td class="pt-3-half changeable">
                            <select class=" custom-select d-block w-100" id="school_id" required>
                                <option {{ !isset($user->school_id) ? ' selected value="-1" ' : '' }}>....</option>
                                @foreach ($schools as $school)
                                <option value="{{ $school->id }}"
                                    {{ $user->school_id == $school->id ? 'selected' : '' }}> {{ $school->name }}
                                </option>
                                @endforeach
                            </select>
                        </td>
                        <td class="pt-3-half changeable" contenteditable="true" id="telephone">{{ $user->telephone }}</td>
                        <td class="pt-3-half changeable">
                            <input id="birthdate" type="date" value="{{ $user->birthdate }}">
                        </td>

                        <td>
                            <span class="table-reset">
                                <button type="button" class="btn btn-primary btn-rounded btn-sm my-0 table-reset-btn">
                                    <i class="fas fa-key" aria-hidden="true"></i>
                                </button>
                            </span>
                        </td>
                        <td class="table-save">
                            <button type="button" class="btn btn-success btn-rounded btn-sm my-0 table-save-btn"
                                disabled>
                                <i class="fas fa-check" aria-hidden="true"></i>
                            </button>
                        </td>
                        <td class='table-remove'>
                            <button type="button" class="btn btn-danger btn-rounded btn-sm my-0 table-remove-btn">
                                <i class="fas fa-trash" aria-hidden="true"></i>
                            </button>
                        </td>
                    </tr>
                    @endforeach
                    @endisset
                </tbody>
            </table>
        </div>
    </div>
</div>


<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle"
    aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Create new user</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                @include('admin.user.create')
            </div>
            <div class="modal-footer">
            </div>
        </div>
    </div>
</div>
@endsection


@section('end')


<script src="{{ asset('js/user.js') }}"></script>
<script>




    $(document).ready(function () {
        // $('.table-add').on('click', 'i', () => {

        //     const $clone = $tableID.find('tbody tr').last().clone(true).removeClass('hide table-line');

        //     if ($tableID.find('tbody tr').length === 0) {

        //         $('tbody').append(newTr);
        //     }

        //     $tableID.find('table').append($clone);
        // });


        // add change event on contenteditable field
        $('td[contenteditable=true]').focus(function () {
            $(this).data("initialText", $(this).html());
        }).on('input blur ', function () {
            if ($(this).data("initialText") !== $(this).html()) {
                let t = $(this).siblings('.table-save').data($(this).attr("id"), $(this).text());
                $(this).trigger('change');
            }
        }).on('change', function () {
            let btn = $(this).siblings('.table-save').children();
            let icon = $(btn).children();

            btn.removeClass('btn-success');
            btn.addClass('btn-warning');
            btn.prop('disabled', false);
            icon.removeClass('fa-check');
            icon.addClass('fa-minus')
        })


        // add change event on select field
        $('td select , td input').focus(function () {
            $(this).data("initialText", $(this).val());
        }).change(function () {
            if ($(this).data("initialText") !== $(this).val()) {
                let t = $(this).parent().siblings('.table-save');
                t.data( $(this).attr("id"), $(this).val() );
                let btn = t.children();
                let icon = $(btn).children();
                btn.removeClass('btn-success');
                btn.addClass('btn-warning');
                btn.prop('disabled', false);
                icon.removeClass('fa-check');
                icon.addClass('fa-minus')
            }
        })



        // remove row
        $tableID.on('click', '.table-remove-btn', function () {
            let selectedRow = $(this).parents()[1];
            let userId = $(selectedRow).attr('id').split('-')[1];
            if (confirm("Are you sure you want to delete this user ?")) {
                $.ajax({
                    method: "GET",
                    url: "{{ route('admin.user.destroy', '') }}" + '/' + userId,

                    success: () => {
                        notify('Deleted !', 'success');
                        $(this).parents('tr').detach();
                    },
                    failure: () => {
                        notify('Error ! Can not delete !', 'error');
                    }
                });
            }
        });





        //update row
        $tableID.on('click', '.table-save-btn', function () {
            let selectedRow = $(this).parents()[1];
            let CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');
            let userId = +$(selectedRow).attr('id').split('-')[1];
            let self = $(this);
            data = self.parent().data();
            data['_token'] = CSRF_TOKEN;
            data['id'] = userId;
            console.log(data);
            let icon = $(self).children();
            $.ajax({
                method: "post",
                url: "{{ route('admin.user.update', '') }}" + '/' + userId,
                data: data,
                success: () => {
                    self.removeClass('btn-warning');
                    self.addClass('btn-success');
                    self.prop('disabled', true);
                    icon.removeClass('fa-minus');
                    icon.addClass('fa-check');
                    notify('Updated !', 'success');
                }
            });



        });


        //reset password
        $tableID.on('click', '.table-reset', function () {



        });

    });




</script>

<script src="{{ asset('js/user-create-form.js') }}"></script>

@endsection
