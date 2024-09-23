@extends('layouts.cms.admin')

@section('header')
    <!-- Page Title  -->
    <title>Dashboard | {{ config('app.name') }}</title>
@endsection

@section('js-custom')
    <script src="{{ asset('assets/js/libs/datatable-btns.js?ver=3.2.3') }}"></script>
    <script>
        $(document).ready(function () {
            $('.buttons-copy').attr({ 'data-bs-toggle':'tooltip', 'data-bs-placement':'top', 'title':'Copy to Clipboard' });
            $('.buttons-excel').attr({ 'data-bs-toggle':'tooltip', 'data-bs-placement':'top', 'title':'Export to Excel' });
            $('.buttons-csv').attr({ 'data-bs-toggle':'tooltip', 'data-bs-placement':'top', 'title':'Export to CSV' });
            $('.buttons-pdf').attr({ 'data-bs-toggle':'tooltip', 'data-bs-placement':'top', 'title':'Export to PDF' });
            $('.buttons-colvis').attr({ 'data-bs-toggle':'tooltip', 'data-bs-placement':'top', 'title':'Column Visibility' });

            $('.detailBtnModal').on('click',function(){
                var dataURL = $(this).attr('href');

                $.get(dataURL, function(data) {
                    $('#modalDetail .modal-content').html(data);
                    $('#modalDetail').modal('show');
                });
            });
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
                                        <h5 class="nk-block-title">Data Permohonan Surat Baru</h5>
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
                                        <table class="datatable-init-export nowrap table" data-export-title="Export">
                                            <thead>
                                            <tr>
                                                <th>User</th>
                                                <th>Tanggal Permohonan</th>
                                                <th>Jenis Surat</th>
                                                <th>Atas Nama</th>
                                                <th class="none">Tujuan Permohonan</th>
                                                <th>Tipe Surat</th>
                                                <th class="all">Status</th>
                                                <th class="text-center all">Action</th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            @foreach ($permohonanSurat as $surat)
                                                @if(!empty($surat->user))
                                                    <tr>
                                                        <td>{{ $surat->user->name }}</td>
                                                        <td>{{ date('Y-m-d', strtotime($surat->tanggal_permohonan)) }}</td>
                                                        <td>{{ $surat->jenis_surat->jenis_surat }}</td>
                                                        <td>{{ $surat->atas_nama_surat }}</td>
                                                        <td>{{ $surat->tujuan_permohonan }}</td>
                                                        <td>{{ $surat->human_tipe }}</td>
                                                        <td>
                                                            <span class="{{ $surat->status == 'diajukan' ? 'text-secondary' : ($surat->status == 'diterima' ? 'text-primary' : 'text-warning') }}">{{ $surat->human_status }}</span>
                                                        </td>
                                                        <td class="text-center">
                                                            <div>
                                                                <a href="{{ route('surat.permohonan.detail', $surat->id) }}" class="btn btn-sm btn-info editBtnModal" data-bs-placement="top" title="Detail" data-bs-toggle="tooltip" style="--bs-btn-padding-x: 0.35rem;">
                                                                    <em class="icon ni ni-eye" style="font-size: 1.2em;"></em>
                                                                </a>
                                                            </div>
                                                        </td>
                                                    </tr>
                                                @endif
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

            <div class="col-md-12" style="margin-bottom: 30px;">
               <div class="container-fluid">
                    <div class="nk-content-inner">
                        <div class="nk-content-body">
                            <div class="nk-block-head nk-block-head-sm" style="padding-bottom: 20px;">
                                <div class="nk-block-between">
                                    <div class="nk-block-head-content">
                                        <h5 class="nk-block-title">Geografis Desa</h5>
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
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="card card-bordered card-preview">
                                        <div class="card-inner">
                                            <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d105738.89618069604!2d115.2939998024831!3d-8.430269271528742!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2dd21978cd9b2b8b%3A0x5030bfbca830210!2sJehem%2C%20Kec.%20Tembuku%2C%20Kabupaten%20Bangli%2C%20Bali!5e1!3m2!1sid!2sid!4v1722059705001!5m2!1sid!2sid" width="100%" height="450" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
                                        </div>
                                    </div><!-- .card-preview -->
                                </div>
                                <div class="col-md-6">
                                    <div class="card card-bordered card-preview">
                                        <div class="card-inner-group">
                                            @foreach($geografisDesa as $geo)
                                                <div class="card-inner">
                                                    <div class="nk-wg-action">
                                                        <div class="nk-wg-action-content" style="padding-left: 0;">
                                                            <div class="title">{{ $geo->name }}</div>
                                                            <p>{{ $geo->description }}</p>
                                                        </div>
                                                        <a href="{!! $geo->link !!}" target="_blank" class="btn btn-icon btn-trigger me-n2"><em class="icon ni ni-forward-ios"></em></a>
                                                    </div>
                                                </div><!-- .card-inner -->
                                            @endforeach
                                        </div>
                                    </div><!-- .card-preview -->
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-md-6">
                <div class="card card-bordered">
                    <div class="card-inner-group">
                        <div class="card-inner card-inner-md">
                            <div class="card-title-group">
                                <div class="card-title">
                                    <h6 class="title">Layanan Kesehatan</h6>
                                </div>
                                <div class="card-tools me-n1">
                                    <div class="drodown">
                                        <a href="#" class="dropdown-toggle btn btn-icon btn-trigger" data-bs-toggle="dropdown"><em class="icon ni ni-more-h"></em></a>
                                        <div class="dropdown-menu dropdown-menu-end">
                                            <ul class="link-list-opt no-bdr">
                                                <li><a href="{{ route('layanan-kesehatan.article.index') }}"><em class="icon ni ni-eye"></em><span>Lihat Semua</span></a></li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div><!-- .card-inner -->
                        @foreach($layananKesehatan as $articleKes)
                            <div class="card-inner">
                                <div class="nk-wg-action">
                                    <div class="nk-wg-action-content" style="padding-left: 0;">
                                        <div class="title">{{ $articleKes->title  }}</div>
                                        <p>{{ $articleKes->short_description }}</p>
                                    </div>
                                    <a href="{{ route('dashboard.article', $articleKes->id) }}" target="_blank" class="btn btn-icon btn-trigger me-n2"><em class="icon ni ni-forward-ios"></em></a>
                                </div>
                            </div><!-- .card-inner -->
                        @endforeach
                    </div><!-- .card-inner-group -->
                </div><!-- .card -->
            </div>
            <div class="col-md-6">
                <div class="card card-bordered">
                    <div class="card-inner-group">
                        <div class="card-inner card-inner-md">
                            <div class="card-title-group">
                                <div class="card-title">
                                    <h6 class="title">Demografi Penduduk</h6>
                                </div>
                                <div class="card-tools me-n1">
                                    <div class="drodown">
                                        <a href="#" class="dropdown-toggle btn btn-icon btn-trigger" data-bs-toggle="dropdown"><em class="icon ni ni-more-h"></em></a>
                                        <div class="dropdown-menu dropdown-menu-end">
                                            <ul class="link-list-opt no-bdr">
                                                <li><a href="{{ route('demografi.jenis.index') }}"><em class="icon ni ni-eye"></em><span>Lihat Semua</span></a></li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div><!-- .card-inner -->
                        <div class="card-inner p-0 border-top">
                            <div class="nk-tb-list nk-tb-orders">
                                <div class="nk-tb-item nk-tb-head">
                                    <div class="nk-tb-col"><span>Jenis Demografi</span></div>
                                    <div class="nk-tb-col text-end"><span>Detail</span></div>
                                </div><!-- .nk-tb-item -->
                                @foreach($demografiJenis as $dj)
                                    <div class="nk-tb-item">
                                        <div class="nk-tb-col">
                                            <span class="tb-lead">{{ $dj->jenis_demografi }}</span>
                                        </div>
                                        <div class="nk-tb-col text-end">
                                            <button type="button" href="{{ route('dashboard.demografi', $dj->id) }}" class="btn btn-sm btn-primary detailBtnModal" data-bs-placement="top" title="Detail" data-bs-toggle="tooltip">
                                                <em class="icon ni ni-list-index" style="font-size: 1em;"></em>
                                            </button>
                                        </div>
                                    </div><!-- .nk-tb-item -->
                                @endforeach
                            </div>
                        </div>
                    </div><!-- .card-inner-group -->
                </div><!-- .card -->
            </div>
        </div>
    </div>
    <!-- content @e -->

    <div class="modal fade" id="modalDetail" role="basic" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-body">
                    <img src="{{ asset('assets/images/loading-spinner-grey.gif') }}" alt="" class="loading">
                    <span> &nbsp;&nbsp;Loading... </span>
                </div>
            </div>
        </div>
    </div>
@endsection
