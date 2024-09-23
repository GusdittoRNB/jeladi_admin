@extends('layouts.cms.admin')

@section('header')
    <!-- Page Title  -->
    <title>Data Kelompok Demografi | {{ config('app.name') }}</title>
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

            @if ($errors->add->any())
                $('#modalAdd').modal('show');
            @elseif($errors->edit->any())
                <?php session()->reflash(); ?>
                var dataURLEdit = '{{ route('demografi.kelompok.edit', \Session::get('edit_fails_id')) }}';

                $.get(dataURLEdit, function(data) {
                    $('#modalEdit .modal-content').html(data);
                    $('#modalEdit').modal('show');
                });
            @endif

            $('.editBtnModal').on('click',function(){
                var dataURL = $(this).attr('href');

                $.get(dataURL, function(data) {
                    $('#modalEdit .modal-content').html(data);
                    $('#modalEdit').modal('show');
                });
            });

            $(document.body).on('click', '.js-submit-confirm', function (event) {
                event.preventDefault()
                var $form = $(this).closest('form')
                swal({
                        title: "Are you sure?",
                        text: "You can not undo this process!",
                        type: "warning",
                        showCancelButton: true,
                        confirmButtonColor: '#DD6B55',
                        confirmButtonText: 'Yes, delete it!',
                        cancelButtonText: "Cancel",
                        closeOnConfirm: true
                    },
                    function () {
                        $form.submit()
                    });
            })
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
                                <h3 class="nk-block-title page-title">Data Kelompok Demografi</h3>
                                <div class="nk-block-des">
                                    <p class="lead">Jenis Demografi: {{ $jenisDemografi->jenis_demografi }}</p>
                                </div>
                            </div><!-- .nk-block-head-content -->
                            <div class="nk-block-head-content">
                                <div class="toggle-wrap nk-block-tools-toggle">
                                    <div class="toggle-expand-content" data-content="pageMenu">
                                        <ul class="nk-block-tools g-3">
                                            <li><a href="#" data-bs-toggle="modal" data-bs-target="#modalAdd" class="btn btn-white btn-dim btn-outline-primary"><em class="icon ni ni-plus"></em><span>Tambah Kelompok Demografi</span></a></li>
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
                                        <th>Order No</th>
                                        <th>Kelompok Demografi</th>
                                        <th>Jumlah</th>
                                        <th class="text-center">Warna</th>
                                        <th class="text-center all">Action</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach ($kelompokDemografi as $kd)
                                        <tr>
                                            <td>{{ $kd->order_number }}</td>
                                            <td>{{ $kd->kelompok_demografi }}</td>
                                            <td>{{ $kd->jumlah }}</td>
                                            <td class="text-center">
                                                <button type="button" class="btn btn-sm" style="background-color: {{ $kd->color }}">{{ $kd->color }}</button>
                                            </td>
                                            <td class="text-center">
                                                <div>
                                                    <button type="button" href="{{ route('demografi.kelompok.edit', $kd->id) }}" class="btn btn-sm btn-info editBtnModal" data-bs-placement="top" title="Edit" data-bs-toggle="tooltip" style="--bs-btn-padding-x: 0.35rem;">
                                                        <em class="icon ni ni-edit" style="font-size: 1.2em;"></em>
                                                    </button>
                                                    <form method="post" action="{{ route('demografi.kelompok.delete', $kd->id) }}" style="display: inline;">
                                                        @csrf
                                                        @method('delete')
                                                        <button type="submit" class="btn btn-sm btn-danger js-submit-confirm" data-bs-toggle="tooltip" data-bs-placement="top" title="Delete" style="--bs-btn-padding-x: 0.35rem;">
                                                            <em class="icon ni ni-trash" style="font-size: 1.2em;"></em>
                                                        </button>
                                                    </form>
                                                </div>
                                            </td>
                                        </tr>
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
    <div class="modal fade" id="modalAdd">
        <div class="modal-dialog modal-lg" role="document">
            <form method="post" action="{{ route('demografi.kelompok.store', $jenisDemografi->id) }}" class="form-validate" style="width: 100%;">
                @csrf
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Tambah Kelompok Demografi</h5>
                        <a href="#" class="close" data-bs-dismiss="modal" aria-label="Close">
                            <em class="icon ni ni-cross"></em>
                        </a>
                    </div>
                    <div class="modal-body">
                        <div class="form-group">
                            <label class="form-label" for="full-name">Kelompok Demografi</label>
                            <input type="text" name="kelompok_demografi" class="form-control form-control-lg {!! $errors->add->has('kelompok_demografi') ? 'error' : '' !!}" value="{{ $errors->add->any() ? old('kelompok_demografi') : '' }}" required>
                            {!! $errors->add->first('kelompok_demografi', '<p class="help-block text-danger">:message</p>') !!}
                        </div>
                        <div class="form-group">
                            <label class="form-label" for="full-name">Jumlah</label>
                            <input type="number" name="jumlah" class="form-control form-control-lg {!! $errors->add->has('jumlah') ? 'error' : '' !!}" value="{{ $errors->add->any() ? old('jumlah') : '' }}" required>
                            {!! $errors->add->first('jumlah', '<p class="help-block text-danger">:message</p>') !!}
                        </div>
                        <div class="form-group">
                            <label class="form-label" for="full-name">Warna</label>
                            <input type="text" name="color" class="form-control form-control-lg {!! $errors->add->has('color') ? 'error' : '' !!}" value="{{ $errors->add->any() ? old('color') : '' }}" required>
                            <p class="help-block">Referensi warna: <a href="https://colorsui.com" target="_blank">colorsui.com</a>, silakan pilih dan copy code pada form!</p>
                            {!! $errors->add->first('color', '<p class="help-block text-danger">:message</p>') !!}
                        </div>
                        <div class="form-group">
                            <label class="form-label" for="full-name">Order Number</label>
                            <input type="number" name="order_number" class="form-control form-control-lg {!! $errors->add->has('order_number') ? 'error' : '' !!}" value="{{ $errors->add->any() ? old('order_number') : ($maxNumber + 1) }}" required>
                            {!! $errors->add->first('order_number', '<p class="help-block text-danger">:message</p>') !!}
                        </div>
                    </div>
                    <div class="modal-footer bg-light">
                        <div class="form-group">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                            <button type="submit" class="btn btn-primary">Save</button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <div class="modal fade" id="modalEdit" role="basic" aria-hidden="true">
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
