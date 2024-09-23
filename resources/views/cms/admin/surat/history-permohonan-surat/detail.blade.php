@extends('layouts.cms.admin')

@section('header')
    <!-- Page Title  -->
    <title>Detail Riwayat Permohonan Surat | {{ config('app.name') }}</title>
@endsection

@section('css-plugin')
    <link href="{{ asset('assets/sweet-alert/sweetalert.css') }}" rel="stylesheet">
@endsection

@section('js-custom')
    <script src="{{ asset('assets/js/libs/datatable-btns.js?ver=3.2.3') }}"></script>
    <script src="{{ asset('assets/sweet-alert/sweetalert.min.js') }}"></script>
    <script>
        $(document).ready(function () {

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
                                <h3 class="nk-block-title page-title">Detail Riwayat Permohonan Surat</h3>

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
                                <div class="data-head">
                                    <h6 class="overline-title">Detail Informasi Pemohon</h6>
                                </div>
                                <div class="data-item">
                                    <div class="data-col">
                                        <span class="col-md-3">NIK</span>
                                        <span class="col-md-9">{{ $surat->user_nik }}</span>
                                    </div>
                                </div>
                                <div class="data-item">
                                    <div class="data-col">
                                        <span class="col-md-3">Nama</span>
                                        <span class="col-md-9">{{ $surat->user_name }}</span>
                                    </div>
                                </div>
                                <div class="data-item">
                                    <div class="data-col">
                                        <span class="col-md-3">No HP</span>
                                        <span class="col-md-9">{{ $surat->user_phone }}</span>
                                    </div>
                                </div>
                                <div class="data-item">
                                    <div class="data-col">
                                        <span class="col-md-3">Alamat</span>
                                        <span class="col-md-9">{{ $surat->user_alamat }}</span>
                                    </div>
                                </div>

                                <div class="data-head">
                                    <h6 class="overline-title">Detail Informasi Permohonan Surat</h6>
                                </div>
                                <div class="data-item">
                                    <div class="data-col">
                                        <span class="col-md-3">Jenis Surat</span>
                                        <span class="col-md-9">{{ $surat->jenis_surat }}</span>
                                    </div>
                                </div>
                                <div class="data-item">
                                    <div class="data-col">
                                        <span class="col-md-3">Tanggal Permohonan</span>
                                        <span class="col-md-9">{{ date('d F Y', strtotime($surat->tanggal_permohonan)) }}</span>
                                    </div>
                                </div>
                                <div class="data-item">
                                    <div class="data-col">
                                        <span class="col-md-3">Atas Nama Surat</span>
                                        <span class="col-md-9">{{ $surat->atas_nama_surat }}</span>
                                    </div>
                                </div>
                                <div class="data-item">
                                    <div class="data-col">
                                        <span class="col-md-3">Tujuan Permohonan</span>
                                        <span class="col-md-9">{{ $surat->tujuan_permohonan }}</span>
                                    </div>
                                </div>
                                <div class="data-item">
                                    <div class="data-col">
                                        <span class="col-md-3">Tipe Surat</span>
                                        <span class="col-md-9">{{ $surat->human_tipe }}</span>
                                    </div>
                                </div>
                                <div class="data-item">
                                    <div class="data-col">
                                        <span class="col-md-3">Status</span>
                                        <span class="col-md-9 {{ $surat->status == 'ditolak' ? 'text-danger' : 'text-success' }}">{{ $surat->human_status }}</span>
                                    </div>
                                </div>
                                @if($surat->status == 'disetujui' && $surat->file_surat != '')
                                    <div class="data-item" id="itemFileSurat">
                                        <div class="data-col">
                                            <span class="col-md-3">File Surat</span>
                                            <span class="col-md-9">
                                                <div>
                                                    <a href="{{ asset('storage/permohonan-surat/'.$surat->file_surat) }}" target="_blank" class="btn btn-info">File Surat</a>
                                                </div>
                                            </span>
                                        </div>
                                    </div>
                                @endif

                                @if($surat->status == 'ditolak')
                                    <div class="data-item" id="itemAlasanDitolak">
                                        <div class="data-col">
                                            <span class="col-md-3">Keterangan/Alasan Ditolak</span>
                                            <span class="col-md-9">
                                            {{ $surat->alasan_ditolak }}
                                        </span>
                                        </div>
                                    </div>
                                @endif
                                <div class="data-item">
                                    <div class="data-col">
                                        <span class="col-md-3">History Status</span>
                                        <span class="col-md-9">
                                            <table class="table table-bordered" width="100%">
                                                <tr>
                                                    <th>Status</th>
                                                    <th>Waktu</th>
                                                    <th>User</th>
                                                </tr>
                                                @foreach(json_decode($surat->history_status, true) as $hstatus)
                                                    <tr>
                                                        <td>{{ ucfirst($hstatus['status']) }}</td>
                                                        <td>{{ $hstatus['date_time'] }}</td>
                                                        <td>{{ $hstatus['user_name'] }}</td>
                                                    </tr>
                                                @endforeach
                                            </table>
                                        </span>
                                    </div>
                                </div>
                                <div class="data-item">
                                    <div class="data-col">
                                        <span class="col-md-3"></span>
                                        <span class="col-md-9">
                                            <a href="{{ route('surat.history-permohonan.index') }}" class="btn btn-secondary">Kembali</a>
                                        </span>
                                    </div>
                                </div>
                            </div>
                        </div><!-- .card-preview -->
                    </div>

                </div>
            </div>
        </div>
    </div>
    <!-- content @e -->
@endsection
