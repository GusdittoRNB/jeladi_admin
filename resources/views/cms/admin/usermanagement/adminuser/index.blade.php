@extends('layouts.cms.admin')

@section('header')
    <!-- Page Title  -->
    <title>Data User Admin | {{ config('app.name') }}</title>
@endsection

@section('css-plugin')
    <link href="{{ asset('assets/sweet-alert/sweetalert.css') }}" rel="stylesheet">
@endsection

@section('js-custom')
    <script src="{{ asset('assets/js/libs/datatable-btns.js?ver=3.2.3') }}"></script>
    <script src="{{ asset('assets/sweet-alert/sweetalert.min.js') }}"></script>
    <script>
        $(document).ready(function () {
            $('.buttons-copy').attr({ 'data-bs-toggle':'tooltip', 'data-bs-placement':'top', 'title':'Copy to Clipboard' });
            $('.buttons-excel').attr({ 'data-bs-toggle':'tooltip', 'data-bs-placement':'top', 'title':'Export to Excel' });
            $('.buttons-csv').attr({ 'data-bs-toggle':'tooltip', 'data-bs-placement':'top', 'title':'Export to CSV' });
            $('.buttons-pdf').attr({ 'data-bs-toggle':'tooltip', 'data-bs-placement':'top', 'title':'Export to PDF' });
            $('.buttons-colvis').attr({ 'data-bs-toggle':'tooltip', 'data-bs-placement':'top', 'title':'Column Visibility' });

            @if ($errors->add->any())
                $('#modalAdd').modal('show');
            @elseif($errors->edit->any())
                <?php session()->reflash(); ?>
                var dataURLEdit = '{{ route('usermanagement.admin.edit', \Session::get('edit_fails_id')) }}';

                $.get(dataURLEdit, function(data) {
                    $('#modalEdit .modal-content').html(data);
                    $('#modalEdit').modal('show');
                });
            @endif


            $('.editBtnModal').on('click',function(){
                var dataURL = $(this).attr('href');

                $.get(dataURL, function(data) {
                    $('#modalEdit .modal-content').html(data);
                    $('#modalEdit').modal('show');
                });
            });

            $(document.body).on('click', '.js-submit-confirm', function (event) {
                event.preventDefault()
                var $form = $(this).closest('form')
                swal({
                        title: "Are you sure?",
                        text: "You can not undo this process!",
                        type: "warning",
                        showCancelButton: true,
                        confirmButtonColor: '#DD6B55',
                        confirmButtonText: 'Yes, delete it!',
                        cancelButtonText: "Cancel",
                        closeOnConfirm: true
                    },
                    function () {
                        $form.submit()
                    });
            })
        })
    </script>
@endsection

@section('content')
    <!-- content @s -->
    <div class="nk-content ">
        <div class="container-fluid">
            <div class="nk-content-inner">
                <div class="nk-content-body">
                    <div class="nk-block-head nk-block-head-sm">
                        <div class="nk-block-between">
                            <div class="nk-block-head-content">
                                <h3 class="nk-block-title page-title">Data User Admin</h3>

                            </div><!-- .nk-block-head-content -->
                            <div class="nk-block-head-content">
                                <div class="toggle-wrap nk-block-tools-toggle">
                                    <div class="toggle-expand-content" data-content="pageMenu">
                                        <ul class="nk-block-tools g-3">
                                            @if (\Gate::allows('be_super_admin'))
                                                <li><a href="#" data-bs-toggle="modal" data-bs-target="#modalAdd" class="btn btn-white btn-dim btn-outline-primary"><em class="icon ni ni-plus"></em><span>Tambah Admin</span></a></li>
                                            @endif
                                        </ul>
                                    </div><!-- .toggle-expand-content -->
                                </div><!-- .toggle-wrap -->
                            </div><!-- .nk-block-head-content -->
                        </div><!-- .nk-block-between -->
                    </div><!-- .nk-block-head -->
                    <div class="nk-block nk-block-lg">
                        @include('cms.admin._notification')
                        <div class="card card-bordered card-preview">
                            <div class="card-inner">
                                <table class="datatable-init-export nowrap table" data-export-title="Export">
                                    <thead>
                                        <tr>
                                            <th>Nama</th>
                                            <th>Email</th>
                                            <th>No HP</th>
                                            <th>Alamat</th>
                                            <th class="all">Status</th>
                                            @if (\Gate::allows('be_super_admin'))
                                                <th class="text-center all">Action</th>
                                            @endif
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($users as $user)
                                        <tr>
                                            <td>{{ $user->name }}</td>
                                            <td>{{ $user->email }}</td>
                                            <td>{{ $user->phone }}</td>
                                            <td>{{ $user->address }}</td>
                                            <td>
                                                @if ($user->status == 'active')
                                                    <span class="text-success">Active</span>
                                                @else
                                                    <span class="text-danger">Suspended</span>
                                                @endif
                                            </td>
                                            @if (\Gate::allows('be_super_admin'))
                                            <td class="text-center">
                                                <div>
                                                    <button type="button" href="{{ route('usermanagement.admin.edit', $user->id) }}" class="btn btn-sm btn-info editBtnModal" data-bs-placement="top" title="Edit" data-bs-toggle="tooltip" style="--bs-btn-padding-x: 0.35rem;">
                                                        <em class="icon ni ni-edit" style="font-size: 1.2em;"></em>
                                                    </button>
                                                    <form method="post" action="{{ route('usermanagement.admin.destroy', $user->id) }}" style="display: inline;">
                                                        @csrf
                                                        @method('delete')
                                                        <button type="submit" class="btn btn-sm btn-danger js-submit-confirm" data-bs-toggle="tooltip" data-bs-placement="top" title="Delete" style="--bs-btn-padding-x: 0.35rem;">
                                                            <em class="icon ni ni-trash" style="font-size: 1.2em;"></em>
                                                        </button>
                                                    </form>
                                                </div>
                                            </td>
                                            @endif
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div><!-- .card-preview -->
                    </div>

                </div>
            </div>
        </div>
    </div>
    <!-- content @e -->
    @if (\Gate::allows('be_super_admin'))
    <div class="modal fade" id="modalAdd">
        <div class="modal-dialog modal-lg" role="document">
            <form method="post" action="{{ route('usermanagement.admin.store') }}" class="form-validate" style="width: 100%;">
                @csrf
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Tambah Admin</h5>
                        <a href="#" class="close" data-bs-dismiss="modal" aria-label="Close">
                            <em class="icon ni ni-cross"></em>
                        </a>
                    </div>
                    <div class="modal-body">
                        <div class="form-group">
                            <label class="form-label" for="full-name">Name</label>
                            <input type="text" name="name" class="form-control form-control-lg {!! $errors->add->has('name') ? 'error' : '' !!}" value="{{ $errors->add->any() ? old('name') : '' }}" required>
                            {!! $errors->add->first('name', '<p class="help-block text-danger">:message</p>') !!}
                        </div>
                        <div class="form-group">
                            <label class="form-label" for="display-name">Email</label>
                            <input type="email" name="email" class="form-control form-control-lg {!! $errors->add->has('email') ? 'error' : '' !!}" value="{{ $errors->add->any() ? old('email') : '' }}" required>
                            {!! $errors->add->first('email', '<p class="help-block text-danger">:message</p>') !!}
                        </div>
                        <div class="form-group">
                            <label class="form-label" for="display-name">Password</label>
                            <input type="password" name="password" class="form-control form-control-lg {!! $errors->add->has('password') ? 'error' : '' !!}" value="{{ $errors->add->any() ? old('password') : '@jeladi2024' }}" required>
                            {!! $errors->add->first('password', '<p class="help-block text-danger">:message</p>') !!}
                        </div>
                        <div class="form-group">
                            <label class="form-label" for="display-name">Confirm Password</label>
                            <input type="password" name="password_confirmation" class="form-control form-control-lg {!! $errors->add->has('password_confirmation') ? 'error' : '' !!}" value="{{ $errors->add->any() ? old('password_confirmation') : '@jeladi2024' }}" required>
                            {!! $errors->add->first('password_confirmation', '<p class="help-block text-danger">:message</p>') !!}
                        </div>
                        <div class="form-group">
                            <label class="form-label" for="phone-no">No HP</label>
                            <input type="text" name="phone" class="form-control form-control-lg {!! $errors->add->has('phone') ? 'error' : '' !!}" value="{{ $errors->add->any() ? old('phone') : '' }}" required>
                            {!! $errors->add->first('phone', '<p class="help-block text-danger">:message</p>') !!}
                        </div>
                        <div class="form-group">
                            <label class="form-label" for="birth-day">Alamat</label>
                            <input type="text" name="address" class="form-control form-control-lg {!! $errors->add->has('address') ? 'error' : '' !!}" value="{{ $errors->add->any() ? old('address') : '' }}" required>
                            {!! $errors->add->first('address', '<p class="help-block text-danger">:message</p>') !!}
                        </div>
                        <div class="form-group">
                            <label class="form-label" for="birth-day">Status</label>
                            <div class="col-12">
                                <div class="custom-control custom-radio" style="margin-right: 15px;">
                                    <input type="radio" name="status" id="customRadio1" class="custom-control-input" value="active" {{ $errors->add->any() ? (old('status') == 'active' ? 'checked' : '') : 'checked' }}>
                                    <label class="custom-control-label" for="customRadio1">Active</label>
                                </div>
                                <div class="custom-control custom-radio">
                                    <input type="radio" name="status" id="customRadio2" class="custom-control-input" value="suspend" {{ $errors->add->any() ? (old('status') == 'suspend' ? 'checked' : '') : '' }}>
                                    <label class="custom-control-label" for="customRadio2">Suspend</label>
                                </div>
                            </div>
                            {!! $errors->add->first('status', '<p class="help-block text-danger">:message</p>') !!}
                        </div>
                        <div class="form-group">
                            <label class="form-label" for="birth-day">Role</label>
                            <div class="col-12">
                                <div class="custom-control custom-radio" style="margin-right: 15px;">
                                    <input type="radio" name="role" id="customRadio3" class="custom-control-input" value="admin" {{ $errors->add->any() ? (old('role') == 'admin' ? 'checked' : '') : 'checked' }}>
                                    <label class="custom-control-label" for="customRadio3">Admin</label>
                                </div>
                                <div class="custom-control custom-radio">
                                    <input type="radio" name="role" id="customRadio4" class="custom-control-input" value="super_admin" {{ $errors->add->any() ? (old('role') == 'super_admin' ? 'checked' : '') : '' }}>
                                    <label class="custom-control-label" for="customRadio4">Super Admin</label>
                                </div>
                            </div>
                            {!! $errors->add->first('role', '<p class="help-block text-danger">:message</p>') !!}
                        </div>
                    </div>
                    <div class="modal-footer bg-light">
                        <div class="form-group">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                            <button type="submit" class="btn btn-primary">Save</button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <div class="modal fade" id="modalEdit" role="basic" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-body">
                    <img src="{{ asset('assets/images/loading-spinner-grey.gif') }}" alt="" class="loading">
                    <span> &nbsp;&nbsp;Loading... </span>
                </div>
            </div>
        </div>
    </div>
    @endif
@endsection
