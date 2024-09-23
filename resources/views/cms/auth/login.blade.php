@extends('layouts.cms.auth')

@section('header')
    <!-- Page Title  -->
    <title>Login | {{ config('app.name') }}</title>
@endsection

@section('content')
<div class="nk-app-root">
    <!-- main @s -->
    <div class="nk-main ">
        <!-- wrap @s -->
        <div class="nk-wrap nk-wrap-nosidebar">
            <!-- content @s -->
            <div class="nk-content ">
                <div class="nk-block nk-block-middle nk-auth-body  wide-xs">
                    <div class="brand-logo pb-4 text-center">
                        <a href="{{ url('/') }}" class="logo-link">
                            <img class="logo-light logo-img logo-img-lg" src="{{ asset('assets/images/logo-jeladi3.png') }}" srcset="{{ asset('assets/images/logo-jeladi3.png') }} 2x" alt="logo" style="max-height: 100px;">
                            <img class="logo-dark logo-img logo-img-lg" src="{{ asset('assets/images/logo-jeladi3.png') }}" srcset="{{ asset('assets/images/logo-jeladi3.png') }} 2x" alt="logo-dark" style="max-height: 100px;">
                        </a>
                    </div>
                    <div class="card card-bordered">
                        <div class="card-inner card-inner-lg">
                            <div class="nk-block-head">
                                <div class="nk-block-head-content">
                                    <h4 class="nk-block-title">Sign-In</h4>
                                    <div class="nk-block-des">
                                        <p>Access the Jeladi CMS panel using your email and password.</p>
                                    </div>
                                    @if (session('status'))
                                        <div class="alert alert-success alert-dismissible" style="margin-top: 15px;">
                                            <button type="button" class="close" data-bs-dismiss="alert"></button>
                                            {{ session('status') }}
                                        </div>
                                    @endif
                                    @if(Session::has('notification'))
                                        <div class="alert alert-{{ Session::get('notification.level', 'info') }} alert-dismissible" role="alert" style="margin-top: 15px;">
                                            <button type="button" class="close" data-bs-dismiss="alert"></button>
                                            {{ Session::get('notification.message') }}
                                        </div>
                                    @endif
                                </div>
                            </div>
                            <form method="POST" action="{{ url('/login') }}">
                                @csrf
                                <div class="form-group {!! $errors->has('email') ? 'has-error' : '' !!}">
                                    <div class="form-label-group">
                                        <label class="form-label" for="default-01">Email</label>
                                    </div>
                                    <div class="form-control-wrap">
                                        <input type="text" name="email" class="form-control form-control-lg" id="default-01" placeholder="Enter your email address">
                                    </div>
                                    {!! $errors->first('email', '<p class="help-block">:message</p>') !!}
                                </div>
                                <div class="form-group {!! $errors->has('password') ? 'has-error' : '' !!}">
                                    <div class="form-label-group">
                                        <label class="form-label" for="password">Password</label>
                                        <a class="link link-primary link-sm" href="{{ route('password.request') }}">Forgot Password?</a>
                                    </div>
                                    <div class="form-control-wrap">
                                        <a href="#" class="form-icon form-icon-right passcode-switch lg" data-target="password">
                                            <em class="passcode-icon icon-show icon ni ni-eye"></em>
                                            <em class="passcode-icon icon-hide icon ni ni-eye-off"></em>
                                        </a>
                                        <input type="password" name="password" class="form-control form-control-lg" id="password" placeholder="Enter your password">
                                    </div>
                                    {!! $errors->first('password', '<p class="help-block">:message</p>') !!}
                                </div>
                                <div class="form-group">
                                    <button class="btn btn-lg btn-primary btn-block">Sign in</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                <div class="nk-footer nk-auth-footer-full">
                    <div class="container wide-lg">
                        <div class="row g-3">
                            <div class="col-lg-12">
                                <div class="nk-block-content text-center text-lg-start">
                                    <p class="text-soft">&copy; 2024 Jeladi powered by <a href="https://ganeshcomstudio.com" target="_blank">Ganeshcom Studio</a> </p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- wrap @e -->
        </div>
        <!-- content @e -->
    </div>
    <!-- main @e -->
</div>
<!-- app-root @e -->
@endsection
