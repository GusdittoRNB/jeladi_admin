@extends('layouts.cms.admin')

@section('header')
    <!-- Page Title  -->
    <title>Detail Article | {{ config('app.name') }}</title>
@endsection

@section('js-custom')
    <script>
        $(document).ready(function () {

        })
    </script>
@endsection

@section('content')
    <div class="nk-content ">
        <div class="row">
            <div class="col-md-12" style="margin-bottom: 30px;">
                <div class="container-fluid">
                    <div class="nk-content-inner">
                        <div class="nk-content-body">
                            <div class="nk-block-head nk-block-head-sm" style="padding-bottom: 20px;">
                                <div class="nk-block-between">
                                    <div class="nk-block-head-content">
                                        <h5 class="nk-block-title">Detail Article</h5>
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
                                <div class="card card-bordered card-preview">
                                    <div class="card-inner">
                                        <div style="margin-bottom: 20px;">
                                            <h6>{{ $layananKesehatan->title }}</h6>
                                            <p class="help-block">Last Update: {{ date('Y, d F H:i', strtotime($layananKesehatan->updated_at)) }}</p>
                                        </div>
                                        <div>
                                            <div id="carouselExConInd" class="carousel slide" data-bs-ride="carousel"="carousel">
                                                <ol class="carousel-indicators">
                                                    <?php $no = 0; ?>
                                                    @foreach($layananKesehatan->article_image as $img)
                                                        <li data-bs-target="#carouselExConInd" data-bs-slide-to="{{ $no }}" class="{{ $img == $layananKesehatan->article_image->first() ? 'active' : '' }}"></li>
                                                        <?php $no++; ?>
                                                    @endforeach
                                                </ol>
                                                <div class="carousel-inner">
                                                    @foreach($layananKesehatan->article_image as $img)
                                                        <div class="carousel-item {{ $img == $layananKesehatan->article_image->first() ? 'active' : '' }}">
                                                            <img class="d-block w-100" src="{{ asset('storage/article-image/'.$img->image) }}" alt="{{ $img->title }}">
                                                        </div>
                                                    @endforeach
                                                </div>
                                                <a class="carousel-control-prev" href="#carouselExConInd" role="button" data-bs-slide="prev">
                                                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                                    <span class="visually-hidden">Previous</span>
                                                </a>
                                                <a class="carousel-control-next" href="#carouselExConInd" role="button" data-bs-slide="next">
                                                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                                    <span class="visually-hidden">Next</span>
                                                </a>
                                            </div>
                                        </div>
                                        <div style="margin-top: 30px;">
                                            <p style="">{!! $layananKesehatan->conten !!}</p>
                                        </div>
                                    </div>
                                </div><!-- .card-preview -->
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- content @e -->
@endsection
