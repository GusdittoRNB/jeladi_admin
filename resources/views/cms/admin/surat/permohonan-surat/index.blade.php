@extends('layouts.cms.admin')

@section('header')
    <!-- Page Title  -->
    <title>Data Permohonan Surat | {{ config('app.name') }}</title>
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
                                <h3 class="nk-block-title page-title">Data Permohonan Surat</h3>

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
    <!-- content @e -->
@endsection
