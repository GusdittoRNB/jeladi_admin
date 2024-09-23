@extends('layouts.cms.admin')

@section('header')
    <!-- Page Title  -->
    <title>Detail Permohonan Surat | {{ config('app.name') }}</title>
@endsection

@section('css-plugin')
    <link href="{{ asset('assets/sweet-alert/sweetalert.css') }}" rel="stylesheet">
@endsection

@section('js-custom')
    <script src="{{ asset('assets/js/libs/datatable-btns.js?ver=3.2.3') }}"></script>
    <script src="{{ asset('assets/sweet-alert/sweetalert.min.js') }}"></script>
    <script>
        $(document).ready(function () {
            var statusSurat = $('#statusSurat').value;
            if(statusSurat == 'ditolak') {
                $('#itemAlasanDitolak').show();
                $('#textareaAlasan').prop('required',true);
            } else if (statusSurat == 'diterima') {
                $('#itemAlasanDitolak').hide();
                $('#textareaAlasan').prop('required',false);
            } else {
                $('#itemAlasanDitolak').hide();
                $('#textareaAlasan').prop('required',false);
            }

            $('#statusSurat').on('change', function() {
                var statusSurat = this.value;
                if(statusSurat == 'ditolak') {
                    $('#itemAlasanDitolak').show();
                    $('#textareaAlasan').prop('required',true);
                } else if (statusSurat == 'diterima') {
                    $('#itemAlasanDitolak').hide();
                    $('#textareaAlasan').prop('required',false);
                } else {
                    $('#itemAlasanDitolak').hide();
                    $('#textareaAlasan').prop('required',false);
                }
            });
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
                                <h3 class="nk-block-title page-title">Detail Permohonan Surat</h3>

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
                                        <span class="col-md-9">{{ $surat->user->nik }}</span>
                                    </div>
                                </div>
                                <div class="data-item">
                                    <div class="data-col">
                                        <span class="col-md-3">Nama</span>
                                        <span class="col-md-9">{{ $surat->user->name }}</span>
                                    </div>
                                </div>
                                <div class="data-item">
                                    <div class="data-col">
                                        <span class="col-md-3">Email</span>
                                        <span class="col-md-9">{{ $surat->user->email }}</span>
                                    </div>
                                </div>
                                <div class="data-item">
                                    <div class="data-col">
                                        <span class="col-md-3">No HP</span>
                                        <span class="col-md-9">{{ $surat->user->phone }}</span>
                                    </div>
                                </div>
                                <div class="data-item">
                                    <div class="data-col">
                                        <span class="col-md-3">Alamat</span>
                                        <span class="col-md-9">{{ $surat->user->address }}</span>
                                    </div>
                                </div>

                                <div class="data-head">
                                    <h6 class="overline-title">Detail Informasi Permohonan Surat</h6>
                                </div>
                                <div class="data-item">
                                    <div class="data-col">
                                        <span class="col-md-3">Jenis Surat</span>
                                        <span class="col-md-9">{{ $surat->jenis_surat->jenis_surat }}</span>
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
                                <form action="{{ route('surat.permohonan.update', $surat->id) }}" method="post" class="form-validate" enctype="multipart/form-data">
                                @csrf
                                <div class="data-item">
                                    <div class="data-col">
                                        <span class="col-md-3">Status</span>
                                        <span class="col-md-9">
                                            <div class="form-control-wrap">
                                                <div class="form-control-select">
                                                    <select name="status" class="form-control {!! $errors->has('status') ? 'error' : '' !!}" id="statusSurat" required>
                                                        @foreach(\App\Models\PermohonanSurat::statusSuratList() as $key => $value)
                                                            <option value="{{ $key }}" {{ $key == $surat->status ? 'selected' : '' }}>{{ $value }}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                                {!! $errors->first('status', '<p class="help-block text-danger">:message</p>') !!}
                                            </div>
                                        </span>
                                    </div>
                                </div>
                                <div class="data-item" id="itemFileSurat">
                                    <div class="data-col">
                                        <span class="col-md-3">File Surat</span>
                                        <span class="col-md-9">
                                            @if($surat->file_surat != '')
                                                <div style="margin-bottom: 15px;">
                                                    <a href="{{ asset('storage/permohonan-surat/'.$surat->file_surat) }}" target="_blank" class="btn btn-info">File Surat</a>
                                                </div>
                                            @endif
                                            <div class="form-file {!! $errors->has('file_surat') ? 'error' : '' !!}">
                                                <input type="file" name="file_surat" class="form-file-input" id="customFile">
                                                <label class="form-file-label" for="customFile">Choose file</label>
                                            </div>
                                            {!! $errors->first('file_surat', '<p class="help-block text-danger">:message</p>') !!}
                                        </span>
                                    </div>
                                </div>
                                <div class="data-item" id="itemAlasanDitolak">
                                    <div class="data-col">
                                        <span class="col-md-3">Keterangan/Alasan Ditolak</span>
                                        <span class="col-md-9">
                                            <div class="form-control-wrap">
                                                <textarea name="alasan_ditolak" class="form-control {!! $errors->has('alasan_ditolak') ? 'error' : '' !!}" rows="3" id="textareaAlasan"></textarea>
                                            </div>
                                            {!! $errors->first('alasan_ditolak', '<p class="help-block text-danger">:message</p>') !!}
                                        </span>
                                    </div>
                                </div>
                                <div class="data-item">
                                    <div class="data-col">
                                        <span class="col-md-3"></span>
                                        <span class="col-md-9">
                                            <button type="submit" class="btn btn-primary">Simpan</button>
                                            <a href="{{ route('surat.permohonan.index') }}" class="btn btn-secondary">Kembali</a>
                                        </span>
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
