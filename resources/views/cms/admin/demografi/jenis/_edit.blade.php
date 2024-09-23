<form method="post" action="{{ route('demografi.jenis.update', $jd->id) }}" class="form-validate" style="width: 100%;">
    @csrf
    @method('patch')
    <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title">Edit Jenis Demografi</h5>
            <a href="#" class="close" data-bs-dismiss="modal" aria-label="Close">
                <em class="icon ni ni-cross"></em>
            </a>
        </div>
        <div class="modal-body">
            <div class="form-group">
                <label class="form-label" for="full-name">Jenis Demografi</label>
                <input type="text" name="jenis_demografi" class="form-control form-control-lg {!! $errors->edit->has('jenis_demografi') ? 'error' : '' !!}" value="{{ $errors->edit->any() ? old('jenis_demografi') : $jd->jenis_demografi }}" required>
                {!! $errors->edit->first('jenis_demografi', '<p class="help-block text-danger">:message</p>') !!}
            </div>
            <div class="form-group">
                <label class="form-label" for="full-name">Deskripsi</label>
                <input type="text" name="deskripsi" class="form-control form-control-lg {!! $errors->edit->has('deskripsi') ? 'error' : '' !!}" value="{{ $errors->edit->any() ? old('deskripsi') : $jd->deskripsi }}" required>
                {!! $errors->edit->first('deskripsi', '<p class="help-block text-danger">:message</p>') !!}
            </div>
            <div class="form-group {!! $errors->edit->has('publish') ? 'error' : '' !!}">
                <label class="form-label" for="birth-day">Publish</label>
                <div class="col-12">
                    <div class="custom-control custom-radio" style="margin-right: 15px;">
                        <input type="radio" name="publish" id="customRadio1" class="custom-control-input" value="1" {{ $errors->edit->any() ? (old('publish') == '1' ? 'checked' : '') : ($jd->publish == '1' ? 'checked' : '') }}>
                        <label class="custom-control-label" for="customRadio1">Yes</label>
                    </div>
                    <div class="custom-control custom-radio">
                        <input type="radio" name="publish" id="customRadio2" class="custom-control-input" value="0" {{ $errors->edit->any() ? (old('publish') == '0' ? 'checked' : '') : ($jd->publish == '0' ? 'checked' : '') }}>
                        <label class="custom-control-label" for="customRadio2">No</label>
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
