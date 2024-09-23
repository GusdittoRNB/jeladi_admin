<form method="post" action="{{ route('geografis-desa.update', $ggd->id) }}" class="form-validate" style="width: 100%;">
    @csrf
    @method('patch')
    <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title">Edit Geografis Desa</h5>
            <a href="#" class="close" data-bs-dismiss="modal" aria-label="Close">
                <em class="icon ni ni-cross"></em>
            </a>
        </div>
        <div class="modal-body">
            <div class="form-group">
                <label class="form-label" for="full-name">Nama Lokasi</label>
                <input type="text" name="name" class="form-control form-control-lg {!! $errors->edit->has('name') ? 'error' : '' !!}" value="{{ $errors->edit->any() ? old('name') : $ggd->name }}" required>
                {!! $errors->edit->first('name', '<p class="help-block text-danger">:message</p>') !!}
            </div>
            <div class="form-group">
                <label class="form-label" for="full-name">Deskripsi</label>
                <input type="text" name="description" class="form-control form-control-lg {!! $errors->edit->has('description') ? 'error' : '' !!}" value="{{ $errors->edit->any() ? old('description') : $ggd->description }}" required>
                {!! $errors->edit->first('description', '<p class="help-block text-danger">:message</p>') !!}
            </div>
            <div class="form-group">
                <label class="form-label" for="full-name">Link</label>
                <input type="text" name="link" class="form-control form-control-lg {!! $errors->edit->has('link') ? 'error' : '' !!}" value="{!! $errors->edit->any() ? old('link') : $ggd->link !!}" required>
                {!! $errors->edit->first('link', '<p class="help-block text-danger">:message</p>') !!}
            </div>
            <div class="form-group">
                <label class="form-label" for="birth-day">Publish</label>
                <div class="col-12">
                    <div class="custom-control custom-radio" style="margin-right: 15px;">
                        <input type="radio" name="publish" id="customRadio5" class="custom-control-input" value="1" {{ $errors->edit->any() ? (old('publish') == '1' ? 'checked' : '') : ($ggd->publish == '1' ? 'checked' : '') }}>
                        <label class="custom-control-label" for="customRadio5">Yes</label>
                    </div>
                    <div class="custom-control custom-radio">
                        <input type="radio" name="publish" id="customRadio6" class="custom-control-input" value="0" {{ $errors->edit->any() ? (old('publish') == '0' ? 'checked' : '') : ($ggd->publish == '0' ? 'checked' : '') }}>
                        <label class="custom-control-label" for="customRadio6">No</label>
                    </div>
                </div>
                {!! $errors->edit->first('publish', '<p class="help-block text-danger">:message</p>') !!}
            </div>
        </div>
        <div class="modal-footer bg-light">
            <div class="form-group">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                <button type="submit" class="btn btn-primary">Update</button>
            </div>
        </div>
    </div>
</form>
