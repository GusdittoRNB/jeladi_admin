@extends('layouts.cms.admin')

@section('header')
    <!-- Page Title  -->
    <title>Change Password | {{ config('app.name') }}</title>
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
                                                <h4 class="nk-block-title">Change Password</h4>
                                            </div>
                                            <div class="nk-block-head-content align-self-start d-lg-none">
                                                <a href="#" class="toggle btn btn-icon btn-trigger mt-n1" data-target="userAside"><em class="icon ni ni-menu-alt-r"></em></a>
                                            </div>
                                        </div>
                                    </div><!-- .nk-block-head -->
                                    <div class="nk-block">
                                        <div class="nk-data data-list">
                                            <form method="post" action="{{ route('password.update') }}" class="mt-6 space-y-6 form-validate">
                                                @csrf
                                                @method('put')
                                                <div class="row gy-4">
                                                    <div class="col-md-12">
                                                        <div class="form-group">
                                                            <label class="form-label" for="current_password">Current Password</label>
                                                            <input type="password" name="current_password" class="form-control form-control-lg {!! $errors->updatePassword->has('current_password') ? 'error' : '' !!}" value="" required>
                                                            {!! $errors->updatePassword->first('current_password', '<p class="help-block text-danger">:message</p>') !!}
                                                        </div>
                                                    </div>
                                                    <div class="col-md-12">
                                                        <div class="form-group">
                                                            <label class="form-label" for="password">Password</label>
                                                            <input type="password" name="password" class="form-control form-control-lg {!! $errors->updatePassword->has('password') ? 'error' : '' !!}" value="" required>
                                                            {!! $errors->updatePassword->first('password', '<p class="help-block text-danger">:message</p>') !!}
                                                        </div>
                                                    </div>
                                                    <div class="col-md-12">
                                                        <div class="form-group">
                                                            <label class="form-label" for="password_confirmation">Confirm Password</label>
                                                            <input type="password" name="password_confirmation" class="form-control form-control-lg {!! $errors->updatePassword->has('password_confirmation') ? 'error' : '' !!}" value="" required>
                                                            {!! $errors->updatePassword->first('password_confirmation', '<p class="help-block text-danger">:message</p>') !!}
                                                        </div>
                                                    </div>

                                                    <div class="col-12">
                                                        <ul class="align-center flex-wrap flex-sm-nowrap gx-4 gy-2">
                                                            <li>
                                                                <button class="btn btn-lg btn-primary" data-bs-dismiss="modal">Update Password</button>
                                                            </li>
                                                        </ul>
                                                    </div>
                                                </div>
                                            </form>
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
                                                                <li><a href="{{ route('profile.edit') }}" data-bs-toggle="modal"><em class="icon ni ni-edit-fill"></em><span>Update Profile</span></a></li>
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
                                                <li><a href="{{ route('profile.edit') }}"><em class="icon ni ni-user-fill-c"></em><span>Personal Information</span></a></li>
                                                <li><a class="active" href="{{ route('password.update') }}"><em class="icon ni ni-lock-alt-fill"></em><span>Change Password</span></a></li>
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
@endsection
