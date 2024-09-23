@extends('layouts.cms.admin')

@section('header')
    <!-- Page Title  -->
    <title>Data Article Image | {{ config('app.name') }}</title>
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
                var dataURLEdit = '{{ route('layanan-kesehatan.article-image.edit', \Session::get('edit_fails_id')) }}';

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
                                <h3 class="nk-block-title page-title">Article Image</h3>
                                <div class="nk-block-des">
                                    <p class="lead">Artikel: {{ $article->title }}</p>
                                </div>
                            </div><!-- .nk-block-head-content -->
                            <div class="nk-block-head-content">
                                <div class="toggle-wrap nk-block-tools-toggle">
                                    <div class="toggle-expand-content" data-content="pageMenu">
                                        <ul class="nk-block-tools g-3">
                                            <li><a href="#" data-bs-toggle="modal" data-bs-target="#modalAdd" class="btn btn-white btn-dim btn-outline-primary"><em class="icon ni ni-plus"></em><span>Tambah Image</span></a></li>
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
                                        <th>Title</th>
                                        <th class="col-6">Image</th>
                                        <th class="col-2 text-center all">Action</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach ($articleImages as $img)
                                        <tr>
                                            <td>{{ $img->title }}</td>
                                            <td>
                                                <div class="img-thumbnail">
                                                    <img src="{{ asset('storage/article-image/'.$img->image) }}" alt="{{ $img->title }}">
                                                </div>
                                            </td>
                                            <td class="text-center">
                                                <div>
                                                    <button type="button" href="{{ route('layanan-kesehatan.article-image.edit', $img->id) }}" class="btn btn-sm btn-info editBtnModal" data-bs-placement="top" title="Edit" data-bs-toggle="tooltip" style="--bs-btn-padding-x: 0.35rem;">
                                                        <em class="icon ni ni-edit" style="font-size: 1.2em;"></em>
                                                    </button>
                                                    <form method="post" action="{{ route('layanan-kesehatan.article-image.delete', $img->id) }}" style="display: inline;">
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
            <form method="post" action="{{ route('layanan-kesehatan.article-image.store', $article->id) }}" class="form-validate" enctype="multipart/form-data" style="width: 100%;">
                @csrf
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Tambah Article Image</h5>
                        <a href="#" class="close" data-bs-dismiss="modal" aria-label="Close">
                            <em class="icon ni ni-cross"></em>
                        </a>
                    </div>
                    <div class="modal-body">
                        <div class="row">
                            <label class="form-label col-md-3" for="full-name" style="margin-top: 5px;">Title</label>
                            <div class="col-md-9">
                                <input type="text" name="title" id="" class="form-control {!! $errors->add->has('title') ? 'error' : '' !!}" value="{{ $errors->add->any() ? old('title') : '' }}" required>
                                {!! $errors->add->first('title', '<p class="help-block text-danger">:message</p>') !!}
                            </div>
                        </div>
                        <div class="row" style="margin-top: 15px;">
                            <label class="form-label col-md-3" for="import-file" style="margin-top: 5px;">Image</label>
                            <div class="col-md-9">
                                <div class="form-control-wrap {!! $errors->add->has('image') ? 'error' : '' !!}">
                                    <div class="form-file">
                                        <input type="file" name="image" class="form-file-input" id="customFile" required>
                                        <label class="form-file-label" for="customFile">Choose file</label>
                                    </div>
                                </div>
                                {!! $errors->add->first('image', '<p class="help-block text-danger">:message</p>') !!}
                            </div>
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
