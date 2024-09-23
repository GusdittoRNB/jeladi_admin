@extends('layouts.cms.admin')

@section('header')
    <!-- Page Title  -->
    <title>Edit Profile | {{ config('app.name') }}</title>
@endsection

@section('js-custom')
    <script>
        $(document).ready(function () {
            @if ($errors->any() || $errors->photo->any())
                $('#profile-edit').modal('show');
            @endif

        });
    </script>
@endsection

@section('content')
    <!-- content @s -->
    <div class="nk-content ">
        <div class="container-fluid">
            <div class="nk-content-inner">
                <div class="nk-content-body">
                    @if (Session::has('notification'))
                        <div class="col-md-12" style="margin-bottom: 15px;">
                            <div class="alert alert-{{ Session::get('notification.level', 'info') }} alert-dismissible" role="alert" style="margin-top: 15px;">
                                <button type="button" class="close" data-bs-dismiss="alert" aria-hidden="true"></button>
                                {{ Session::get('notification.message') }}
                            </div>
                        </div>
                    @endif

                    <div class="nk-block">
                        <div class="card card-bordered">
                            <div class="card-aside-wrap">
                                <div class="card-inner card-inner-lg">
                                    <div class="nk-block-head nk-block-head-lg">
                                        <div class="nk-block-between">
                                            <div class="nk-block-head-content">
                                                <h4 class="nk-block-title">Personal Information</h4>
                                                <div class="nk-block-des">
                                                    <p>Basic info, like your name and address, that you use on Jeladi CMS.</p>
                                                </div>
                                            </div>
                                            <div class="nk-block-head-content align-self-start d-lg-none">
                                                <a href="#" class="toggle btn btn-icon btn-trigger mt-n1" data-target="userAside"><em class="icon ni ni-menu-alt-r"></em></a>
                                            </div>
                                        </div>
                                    </div><!-- .nk-block-head -->
                                    <div class="nk-block">
                                        <div class="nk-data data-list">
                                            <div class="data-head">
                                                <h6 class="overline-title">Basics</h6>
                                            </div>
                                            <div class="data-item" data-bs-toggle="modal" data-bs-target="#profile-edit">
                                                <div class="data-col">
                                                    <span class="data-label">Nama</span>
                                                    <span class="data-value">{{ $user->name }}</span>
                                                </div>
                                                <div class="data-col data-col-end"><span class="data-more"><em class="icon ni ni-forward-ios"></em></span></div>
                                            </div><!-- data-item -->
                                            <div class="data-item" data-bs-toggle="modal" data-bs-target="#profile-edit">
                                                <div class="data-col">
                                                    <span class="data-label">Email</span>
                                                    <span class="data-value">{{ $user->email }}</span>
                                                </div>
                                                <div class="data-col data-col-end"><span class="data-more"><em class="icon ni ni-forward-ios"></em></span></div>
                                            </div><!-- data-item -->
                                            <div class="data-item" data-bs-toggle="modal" data-bs-target="#profile-edit">
                                                <div class="data-col">
                                                    <span class="data-label">No HP</span>
                                                    <span class="data-value">{{ $user->phone }}</span>
                                                </div>
                                                <div class="data-col data-col-end"><span class="data-more"><em class="icon ni ni-forward-ios"></em></span></div>
                                            </div><!-- data-item -->
                                            <div class="data-item" data-bs-toggle="modal" data-bs-target="#profile-edit">
                                                <div class="data-col">
                                                    <span class="data-label">Alamat</span>
                                                    <span class="data-value text-soft">{{ $user->address }}</span>
                                                </div>
                                                <div class="data-col data-col-end"><span class="data-more"><em class="icon ni ni-forward-ios"></em></span></div>
                                            </div><!-- data-item -->
                                        </div><!-- data-list -->

                                    </div><!-- .nk-block -->
                                </div>
                                <div class="card-aside card-aside-left user-aside toggle-slide toggle-slide-left toggle-break-lg" data-toggle-body="true" data-content="userAside" data-toggle-screen="lg" data-toggle-overlay="true">
                                    <div class="card-inner-group" data-simplebar>
                                        <div class="card-inner">
                                            <div class="user-card">
                                                <div class="user-avatar bg-primary">
                                                    <img src="{{ auth()->user()->user_profile }}" alt="User Profile">
                                                </div>
                                                <div class="user-info">
                                                    <span class="lead-text">{{ auth()->user()->name }}</span>
                                                    <span class="sub-text">{{ auth()->user()->email }}</span>
                                                </div>
                                                <div class="user-action">
                                                    <div class="dropdown">
                                                        <a class="btn btn-icon btn-trigger me-n2" data-bs-toggle="dropdown" href="#"><em class="icon ni ni-more-v"></em></a>
                                                        <div class="dropdown-menu dropdown-menu-end">
                                                            <ul class="link-list-opt no-bdr">
                                                                <li><a href="#profile-edit" data-bs-toggle="modal"><em class="icon ni ni-edit-fill"></em><span>Update Profile</span></a></li>
                                                            </ul>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div><!-- .user-card -->
                                        </div><!-- .card-inner -->
                                        <div class="card-inner">
                                            <div class="user-account-info py-0">
                                                <div class="image-responsive">
                                                    <img src="{{ auth()->user()->user_profile }}" alt="User Profile">
                                                </div>
                                            </div>
                                        </div><!-- .card-inner -->
                                        <div class="card-inner p-0">
                                            <ul class="link-list-menu">
                                                <li><a class="active" href="{{ route('profile.edit') }}"><em class="icon ni ni-user-fill-c"></em><span>Personal Information</span></a></li>
                                                <li><a href="{{ route('password.update') }}"><em class="icon ni ni-lock-alt-fill"></em><span>Change Password</span></a></li>
                                            </ul>
                                        </div><!-- .card-inner -->
                                    </div><!-- .card-inner-group -->
                                </div><!-- card-aside -->
                            </div><!-- .card-aside-wrap -->
                        </div><!-- .card -->
                    </div><!-- .nk-block -->
                </div>
            </div>
        </div>
    </div>
    <!-- content @e -->
    <!-- @@ Profile Edit Modal @e -->
    <div class="modal fade" role="dialog" id="profile-edit">
        <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
            <div class="modal-content">
                <a href="#" class="close" data-bs-dismiss="modal"><em class="icon ni ni-cross-sm"></em></a>
                <div class="modal-body modal-body-lg">
                    <h5 class="title">Update Profile</h5>
                    <ul class="nk-nav nav nav-tabs">
                        <li class="nav-item">
                            <a class="nav-link {{ $errors->photo->any() ? '' : 'active' }}" data-bs-toggle="tab" href="#personal">Personal Info</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link {{ $errors->photo->any() ? 'active' : '' }}" data-bs-toggle="tab" href="#photo">Profile Picture</a>
                        </li>
                    </ul><!-- .nav-tabs -->
                    <div class="tab-content">
                        <div class="tab-pane {{ $errors->photo->any() ? '' : 'active show' }}" id="personal">
                            <form method="post" action="{{ route('profile.update') }}" class="mt-6 space-y-6 form-validate">
                                @csrf
                                @method('patch')
                                <div class="row gy-4">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label class="form-label" for="full-name">Name</label>
                                            <input type="text" name="name" class="form-control form-control-lg {!! $errors->has('name') ? 'error' : '' !!}" value="{{ $user->name }}" required>
                                            {!! $errors->first('name', '<p class="help-block text-danger">:message</p>') !!}
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label class="form-label" for="display-name">Email</label>
                                            <input type="email" name="email" class="form-control form-control-lg {!! $errors->has('email') ? 'error' : '' !!}" value="{{ $user->email }}" required>
                                            {!! $errors->first('email', '<p class="help-block text-danger">:message</p>') !!}
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label class="form-label" for="phone-no">No HP</label>
                                            <input type="text" name="phone" class="form-control form-control-lg {!! $errors->has('phone') ? 'error' : '' !!}" value="{{ $user->phone }}" required>
                                            {!! $errors->first('phone', '<p class="help-block text-danger">:message</p>') !!}
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label class="form-label" for="birth-day">Alamat</label>
                                            <input type="text" name="address" class="form-control form-control-lg {!! $errors->has('address') ? 'error' : '' !!}" value="{{ $user->address }}" required>
                                            {!! $errors->first('address', '<p class="help-block text-danger">:message</p>') !!}
                                        </div>
                                    </div>
                                    <div class="col-12">
                                        <ul class="align-center flex-wrap flex-sm-nowrap gx-4 gy-2">
                                            <li>
                                                <button class="btn btn-lg btn-primary" data-bs-dismiss="modal">Update Profile</button>
                                            </li>
                                            <li>
                                                <a href="#" data-bs-dismiss="modal" class="link link-light">Cancel</a>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            </form>
                        </div><!-- .tab-pane -->
                        <div class="tab-pane {{ $errors->photo->any() ? 'active show' : '' }}" id="photo">
                            <form method="post" action="{{ route('profile.update-photo') }}" class="mt-6 space-y-6" enctype="multipart/form-data">
                                @csrf
                                @method('patch')
                                <div class="row gy-4">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label class="form-label" for="customFileLabel">Select Picture</label>
                                            <div class="form-control-wrap {!! $errors->photo->has('photo') ? 'error' : '' !!}">
                                                <div class="form-file">
                                                    <input type="file" name="photo" class="form-file-input" id="customFile">
                                                    <label class="form-file-label" for="customFile">Choose file</label>
                                                </div>
                                            </div>
                                            {!! $errors->photo->first('photo', '<p class="help-block text-danger">:message</p>') !!}
                                        </div>
                                    </div>
                                    <div class="col-12">
                                        <ul class="align-center flex-wrap flex-sm-nowrap gx-4 gy-2">
                                            <li>
                                                <button class="btn btn-lg btn-primary" data-bs-dismiss="modal">Update Profile Picture</button>
                                            </li>
                                            <li>
                                                <a href="#" data-bs-dismiss="modal" class="link link-light">Cancel</a>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            </form>
                        </div><!-- .tab-pane -->
                    </div><!-- .tab-content -->
                </div><!-- .modal-body -->
            </div><!-- .modal-content -->
        </div><!-- .modal-dialog -->
    </div><!-- .modal -->
@endsection
