@extends('layouts.cms.admin')

@section('header')
    <!-- Page Title  -->
    <title>Data Geografis Desa | {{ config('app.name') }}</title>
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
                var dataURLEdit = '{{ route('geografis-desa.edit', \Session::get('edit_fails_id')) }}';

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
                                <h3 class="nk-block-title page-title">Data Geografis Desa</h3>

                            </div><!-- .nk-block-head-content -->
                            <div class="nk-block-head-content">
                                <div class="toggle-wrap nk-block-tools-toggle">
                                    <div class="toggle-expand-content" data-content="pageMenu">
                                        <ul class="nk-block-tools g-3">
                                            <li><a href="#" data-bs-toggle="modal" data-bs-target="#modalAdd" class="btn btn-white btn-dim btn-outline-primary"><em class="icon ni ni-plus"></em><span>Tambah Lokasi</span></a></li>
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
                                        <th>Nama Lokasi</th>
                                        <th class="none">Deskripsi</th>
                                        <th>Link</th>
                                        <th class="text-center all">Publish</th>
                                        <th class="text-center all">Action</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach ($geografis as $ggd)
                                        <tr>
                                            <td>{{ $ggd->name }}</td>
                                            <td>{{ $ggd->description }}</td>
                                            <td><a href="{!! $ggd->link !!}" target="_blank">{!! $ggd->link !!}</a></td>
                                            <td class="text-center">{{ $ggd->publish == '1' ? 'Yes' : 'No' }}</td>
                                            <td class="text-center">
                                                <div>
                                                    <button type="button" href="{{ route('geografis-desa.edit', $ggd->id) }}" class="btn btn-sm btn-info editBtnModal" data-bs-placement="top" title="Edit" data-bs-toggle="tooltip" style="--bs-btn-padding-x: 0.35rem;">
                                                        <em class="icon ni ni-edit" style="font-size: 1.2em;"></em>
                                                    </button>
                                                    <form method="post" action="{{ route('geografis-desa.delete', $ggd->id) }}" style="display: inline;">
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
            <form method="post" action="{{ route('geografis-desa.store') }}" class="form-validate" style="width: 100%;">
                @csrf
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Tambah Geografis desa</h5>
                        <a href="#" class="close" data-bs-dismiss="modal" aria-label="Close">
                            <em class="icon ni ni-cross"></em>
                        </a>
                    </div>
                    <div class="modal-body">
                        <div class="form-group">
                            <label class="form-label" for="full-name">Nama Lokasi</label>
                            <input type="text" name="name" class="form-control form-control-lg {!! $errors->add->has('name') ? 'error' : '' !!}" value="{{ $errors->add->any() ? old('name') : '' }}" required>
                            {!! $errors->add->first('name', '<p class="help-block text-danger">:message</p>') !!}
                        </div>
                        <div class="form-group">
                            <label class="form-label" for="full-name">Deskripsi</label>
                            <input type="text" name="description" class="form-control form-control-lg {!! $errors->add->has('description') ? 'error' : '' !!}" value="{{ $errors->add->any() ? old('description') : '' }}" required>
                            {!! $errors->add->first('description', '<p class="help-block text-danger">:message</p>') !!}
                        </div>
                        <div class="form-group">
                            <label class="form-label" for="full-name">Link</label>
                            <input type="text" name="link" class="form-control form-control-lg {!! $errors->add->has('link') ? 'error' : '' !!}" value="{{ $errors->add->any() ? old('link') : '' }}" required>
                            {!! $errors->add->first('link', '<p class="help-block text-danger">:message</p>') !!}
                        </div>
                        <div class="form-group">
                            <label class="form-label" for="birth-day">Publish</label>
                            <div class="col-12">
                                <div class="custom-control custom-radio" style="margin-right: 15px;">
                                    <input type="radio" name="publish" id="customRadio3" class="custom-control-input" value="1" {{ $errors->add->any() ? (old('publish') == '1' ? 'checked' : '') : 'checked' }}>
                                    <label class="custom-control-label" for="customRadio3">Yes</label>
                                </div>
                                <div class="custom-control custom-radio">
                                    <input type="radio" name="publish" id="customRadio4" class="custom-control-input" value="0" {{ $errors->add->any() ? (old('publish') == '0' ? 'checked' : '') : '' }}>
                                    <label class="custom-control-label" for="customRadio4">No</label>
                                </div>
                            </div>
                            {!! $errors->add->first('publish', '<p class="help-block text-danger">:message</p>') !!}
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
