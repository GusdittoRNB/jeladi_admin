@extends('layouts.cms.admin')

@section('header')
    <!-- Page Title  -->
    <title>Pusat Bantuan | {{ config('app.name') }}</title>
@endsection

@section('css-plugin')

@endsection

@section('js-custom')

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
                                <h3 class="nk-block-title page-title">Pusat Bantuan</h3>

                            </div><!-- .nk-block-head-content -->
                            <div class="nk-block-head-content">
                                <div class="toggle-wrap nk-block-tools-toggle">
                                    <div class="toggle-expand-content" data-content="pageMenu">
                                        <ul class="nk-block-tools g-3">

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
                                <div class="card-head">
                                    <h5 class="card-title">Pusat Bantuan</h5>
                                </div>
                                <form action="{{ route('pusat-bantuan.update') }}" class="gy-3 form-validate" method="post">
                                    @csrf
                                    @method('patch')
                                    @if(!empty($webfig->where('key', 'whatsapp')->first()))
                                        <div class="row g-3 align-center">
                                            <div class="col-lg-3">
                                                <div class="form-group">
                                                    <label class="form-label" for="site-name">Whatsapp</label>
                                                </div>
                                            </div>
                                            <div class="col-lg-1 text-center" style="padding-top: 5px;">
                                                <div class="custom-control custom-checkbox">
                                                    <input type="checkbox" class="custom-control-input" name="publish_wa" value="1" id="customCheck1" {{ $webfig->where('key', 'whatsapp')->first()->publish == '1' ? 'checked' : '' }}>
                                                    <label class="custom-control-label" for="customCheck1"></label>
                                                </div>
                                            </div>
                                            <div class="col-lg-8">
                                                <div class="form-group {!! $errors->has('whatsapp') ? 'has-error' : '' !!}">
                                                    <div class="form-control-wrap">
                                                        <input type="text" class="form-control" name="whatsapp" value="{{ $webfig->where('key', 'whatsapp')->first()->value }}" required>
                                                    </div>
                                                    {!! $errors->first('whatsapp', '<p class="help-block">:message</p>') !!}
                                                </div>
                                            </div>
                                        </div>
                                    @endif

                                    @if(!empty($webfig->where('key', 'email')->first()))
                                        <div class="row g-3 align-center">
                                            <div class="col-lg-3">
                                                <div class="form-group">
                                                    <label class="form-label" for="site-name">Email</label>
                                                </div>
                                            </div>
                                            <div class="col-lg-1 text-center" style="padding-top: 5px;">
                                                <div class="custom-control custom-checkbox">
                                                    <input type="checkbox" class="custom-control-input" name="publish_email" value="1" id="customCheck2" {{ $webfig->where('key', 'email')->first()->publish == '1' ? 'checked' : '' }}>
                                                    <label class="custom-control-label" for="customCheck2"></label>
                                                </div>
                                            </div>
                                            <div class="col-lg-8">
                                                <div class="form-group {!! $errors->has('email') ? 'has-error' : '' !!}">
                                                    <div class="form-control-wrap">
                                                        <input type="email" class="form-control" name="email" value="{{ $webfig->where('key', 'email')->first()->value }}" required>
                                                    </div>
                                                    {!! $errors->first('email', '<p class="help-block">:message</p>') !!}
                                                </div>
                                            </div>
                                        </div>
                                    @endif

                                    @if(!empty($webfig->where('key', 'telepon')->first()))
                                        <div class="row g-3 align-center">
                                            <div class="col-lg-3">
                                                <div class="form-group">
                                                    <label class="form-label" for="site-name">Telepon</label>
                                                </div>
                                            </div>
                                            <div class="col-lg-1 text-center" style="padding-top: 5px;">
                                                <div class="custom-control custom-checkbox">
                                                    <input type="checkbox" class="custom-control-input" name="publish_tlp" value="1" id="customCheck3" {{ $webfig->where('key', 'telepon')->first()->publish == '1' ? 'checked' : '' }}>
                                                    <label class="custom-control-label" for="customCheck3"></label>
                                                </div>
                                            </div>
                                            <div class="col-lg-8">
                                                <div class="form-group {!! $errors->has('telepon') ? 'has-error' : '' !!}">
                                                    <div class="form-control-wrap">
                                                        <input type="text" class="form-control" name="telepon" value="{{ $webfig->where('key', 'telepon')->first()->value }}" required>
                                                    </div>
                                                    {!! $errors->first('telepon', '<p class="help-block">:message</p>') !!}
                                                </div>
                                            </div>
                                        </div>
                                    @endif
                                    <div class="row g-3">
                                        <div class="col-lg-9 offset-lg-3">
                                            <div class="form-group mt-2">
                                                <button type="submit" class="btn btn-lg btn-primary">Update</button>
                                            </div>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div><!-- .card-preview -->
                    </div>

                </div>
            </div>
        </div>
    </div>
    <!-- content @e -->

@endsection
