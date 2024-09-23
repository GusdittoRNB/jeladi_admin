<form method="post" action="{{ route('demografi.kelompok.update', $kd->id) }}" class="form-validate" style="width: 100%;">
    @csrf
    @method('patch')
    <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title">Edit Kelompok Demografi</h5>
            <a href="#" class="close" data-bs-dismiss="modal" aria-label="Close">
                <em class="icon ni ni-cross"></em>
            </a>
        </div>
        <div class="modal-body">
            <div class="form-group">
                <label class="form-label" for="full-name">Kelompok Demografi</label>
                <input type="text" name="kelompok_demografi" class="form-control form-control-lg {!! $errors->edit->has('kelompok_demografi') ? 'error' : '' !!}" value="{{ $errors->edit->any() ? old('kelompok_demografi') : $kd->kelompok_demografi }}" required>
                {!! $errors->edit->first('kelompok_demografi', '<p class="help-block text-danger">:message</p>') !!}
            </div>
            <div class="form-group">
                <label class="form-label" for="full-name">Jumlah</label>
                <input type="number" name="jumlah" class="form-control form-control-lg {!! $errors->edit->has('jumlah') ? 'error' : '' !!}" value="{{ $errors->edit->any() ? old('jumlah') : $kd->jumlah }}" required>
                {!! $errors->edit->first('jumlah', '<p class="help-block text-danger">:message</p>') !!}
            </div>
            <div class="form-group">
                <label class="form-label" for="full-name">Warna</label>
                <input type="text" name="color" class="form-control form-control-lg {!! $errors->edit->has('color') ? 'error' : '' !!}" value="{{ $errors->edit->any() ? old('color') : $kd->color }}" required>
                <p class="help-block">Referensi warna: <a href="https://colorsui.com" target="_blank">colorsui.com</a>, silakan pilih dan copy code pada form!</p>
                {!! $errors->edit->first('color', '<p class="help-block text-danger">:message</p>') !!}
            </div>
            <div class="form-group">
                <label class="form-label" for="full-name">Order Number</label>
                <input type="number" name="order_number" class="form-control form-control-lg {!! $errors->edit->has('order_number') ? 'error' : '' !!}" value="{{ $errors->edit->any() ? old('order_number') : $kd->order_number }}" required>
                {!! $errors->edit->first('order_number', '<p class="help-block text-danger">:message</p>') !!}
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
