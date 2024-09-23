@extends('layouts.cms.auth')

@section('header')
    <!-- Page Title  -->
    <title>Forgot Password | {{ config('app.name') }}</title>
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
                                    <h5 class="nk-block-title">Reset password</h5>
                                    <div class="nk-block-des">
                                        <p>If you forgot your password, well, then we’ll email you instructions to reset your password.</p>
                                    </div>
                                    @if (session('status'))
                                        <div class="alert alert-success alert-dismissible" style="margin-top: 15px;">
                                            <button type="button" class="close" data-bs-dismiss="alert"></button>
                                            {{ session('status') }}
                                        </div>
                                    @endif
                                </div>
                            </div>
                            <form method="POST" action="{{ route('password.email') }}">
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
                                <div class="form-group">
                                    <button class="btn btn-lg btn-primary btn-block">Send Reset Link</button>
                                </div>
                            </form>
                            <div class="form-note-s2 text-center pt-4">
                                <a href="{{ url('/') }}"><strong>Return to login</strong></a>
                            </div>
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
