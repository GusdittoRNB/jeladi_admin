<form method="post" action="{{ route('layanan-kesehatan.article-image.update', $image->id) }}" class="form-validate" enctype="multipart/form-data" style="width: 100%;">
    @csrf
    @method('patch')
    <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title">Edit Article Image</h5>
            <a href="#" class="close" data-bs-dismiss="modal" aria-label="Close">
                <em class="icon ni ni-cross"></em>
            </a>
        </div>
        <div class="modal-body">
            <div class="row">
                <label class="form-label col-md-3" for="full-name" style="margin-top: 5px;">Title</label>
                <div class="col-md-9">
                    <input type="text" name="title" id="" class="form-control {!! $errors->edit->has('title') ? 'error' : '' !!}" value="{{ $errors->edit->any() ? old('tite') : $image->title }}" required>
                    {!! $errors->edit->first('title', '<p class="help-block text-danger">:message</p>') !!}
                </div>
            </div>
            <div class="row" style="margin-top: 15px;">
                <label class="form-label col-md-3" for="full-name" style="margin-top: 5px;">Current Image</label>
                <div class="col-md-9">
                    <div class="img-thumbnail">
                        <img src="{{ asset('storage/article-image/'.$image->image) }}" alt="{{ $image->title }}">
                    </div>
                </div>
            </div>
            <div class="row" style="margin-top: 15px;">
                <label class="form-label col-md-3" for="import-file" style="margin-top: 5px;">Image</label>
                <div class="col-md-9">
                    <div class="form-control-wrap {!! $errors->edit->has('image') ? 'error' : '' !!}">
                        <div class="form-file">
                            <input type="file" name="image" class="form-file-input" id="customFile">
                            <label class="form-file-label" for="customFile">Choose file</label>
                        </div>
                    </div>
                    {!! $errors->edit->first('image', '<p class="help-block text-danger">:message</p>') !!}
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
