@extends('layouts.cms.admin')

@section('header')
    <!-- Page Title  -->
    <title>Layanan Kesehatan | {{ config('app.name') }}</title>
@endsection

@section('css-plugin')

@endsection

@section('js-custom')
    @include('cms._editor-textarea-init')
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
                                <h3 class="nk-block-title page-title">Layanan Kesehatan</h3>

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
                                    <h5 class="card-title">Edit Artikel Layanan Kesehatan</h5>
                                </div>
                                <form action="{{ route('layanan-kesehatan.article.update', $article->id) }}" class="gy-3 form-validate" method="post">
                                    @csrf
                                    @method('patch')
                                    <div class="row g-3 align-center">
                                        <div class="col-lg-2">
                                            <div class="form-group">
                                                <label class="form-label">Title</label>
                                            </div>
                                        </div>
                                        <div class="col-lg-10">
                                            <div class="form-group {!! $errors->has('title') ? 'has-error' : '' !!}">
                                                <div class="form-control-wrap">
                                                    <input type="text" class="form-control" name="title" value="{{ $article->title }}" required>
                                                </div>
                                                {!! $errors->first('title', '<p class="help-block">:message</p>') !!}
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row g-3 align-center">
                                        <div class="col-lg-2">
                                            <div class="form-group">
                                                <label class="form-label">Short Description</label>
                                            </div>
                                        </div>
                                        <div class="col-lg-10">
                                            <div class="form-group {!! $errors->has('short_description') ? 'has-error' : '' !!}">
                                                <div class="form-control-wrap">
                                                    <textarea name="short_description" class="form-control" rows="3" required>{{ $article->short_description }}</textarea>
                                                </div>
                                                {!! $errors->first('short_description', '<p class="help-block">:message</p>') !!}
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row g-3 align-center">
                                        <div class="col-lg-2">
                                            <div class="form-group">
                                                <label class="form-label">Conten</label>
                                            </div>
                                        </div>
                                        <div class="col-lg-10">
                                            <div class="form-group {!! $errors->has('conten') ? 'has-error' : '' !!}">
                                                <div class="form-control-wrap">
                                                    <textarea name="conten" class="form-control editor-textarea" rows="20" required>{!! $article->conten !!}</textarea>
                                                </div>
                                                {!! $errors->first('conten', '<p class="help-block">:message</p>') !!}
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row g-3 align-center">
                                        <div class="col-lg-2">
                                            <div class="form-group">
                                                <label class="form-label">Publish</label>
                                            </div>
                                        </div>
                                        <div class="col-lg-10">
                                            <div class="form-group {!! $errors->has('publish') ? 'has-error' : '' !!}">
                                                <ul class="custom-control-group g-3 align-center flex-wrap">
                                                    <li>
                                                        <div class="custom-control custom-radio">
                                                            <input type="radio" class="custom-control-input" value="1" name="publish" id="reg-enable" {{ $article->publish == '1' ? 'checked' : '' }}>
                                                            <label class="custom-control-label" for="reg-enable">Yes</label>
                                                        </div>
                                                    </li>
                                                    <li>
                                                        <div class="custom-control custom-radio">
                                                            <input type="radio" class="custom-control-input" value="0" name="publish" id="reg-disable" {{ $article->publish == '0' ? 'checked' : '' }}>
                                                            <label class="custom-control-label" for="reg-disable">No</label>
                                                        </div>
                                                    </li>
                                                </ul>
                                                {!! $errors->first('publish', '<p class="help-block">:message</p>') !!}
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row g-3">
                                        <div class="col-lg-10 offset-lg-2">
                                            <div class="form-group mt-2">
                                                <button type="submit" class="btn btn-primary">Update</button>
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
