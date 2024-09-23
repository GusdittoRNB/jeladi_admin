<form method="post" action="{{ route('usermanagement.enduser.update', $user->id) }}" class="form-validate" style="width: 100%;">
    @csrf
    @method('patch')
    <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title">Edit User</h5>
            <a href="#" class="close" data-bs-dismiss="modal" aria-label="Close">
                <em class="icon ni ni-cross"></em>
            </a>
        </div>
        <div class="modal-body">
            <div class="form-group">
                <label class="form-label" for="full-name">NIK</label>
                <input type="text" name="nik" class="form-control form-control-lg {!! $errors->edit->has('nik') ? 'error' : '' !!}" value="{{ $errors->edit->any() ? old('nik') : $user->nik }}" required>
                {!! $errors->edit->first('nik', '<p class="help-block text-danger">:message</p>') !!}
            </div>
            <div class="form-group">
                <label class="form-label" for="full-name">Name</label>
                <input type="text" name="name" class="form-control form-control-lg {!! $errors->edit->has('name') ? 'error' : '' !!}" value="{{ $errors->edit->any() ? old('name') : $user->name }}" required>
                {!! $errors->edit->first('name', '<p class="help-block text-danger">:message</p>') !!}
            </div>
            <div class="form-group">
                <label class="form-label" for="birth-day">Jenis Kelamin</label>
                <div class="col-12">
                    <div class="custom-control custom-radio" style="margin-right: 15px;">
                        <input type="radio" name="gender" id="customRadio7" class="custom-control-input" value="L" {{ $errors->edit->any() ? (old('gender') == 'L' ? 'checked' : '') : ($user->gender == 'L' ? 'checked' : '') }}>
                        <label class="custom-control-label" for="customRadio7">Laki-laki</label>
                    </div>
                    <div class="custom-control custom-radio">
                        <input type="radio" name="gender" id="customRadio8" class="custom-control-input" value="P" {{ $errors->edit->any() ? (old('gender') == 'P' ? 'checked' : '') : ($user->gender == 'P' ? 'checked' : '') }}>
                        <label class="custom-control-label" for="customRadio8">Perempuan</label>
                    </div>
                </div>
                {!! $errors->edit->first('gender', '<p class="help-block text-danger">:message</p>') !!}
            </div>
            <div class="form-group">
                <label class="form-label" for="display-name">Email</label>
                <input type="email" name="email" class="form-control form-control-lg {!! $errors->edit->has('email') ? 'error' : '' !!}" value="{{ $errors->edit->any() ? old('email') : $user->email }}" required>
                {!! $errors->edit->first('email', '<p class="help-block text-danger">:message</p>') !!}
            </div>
            <div class="form-group">
                <label class="form-label" for="display-name">Password</label>
                <input type="password" name="password" class="form-control form-control-lg {!! $errors->edit->has('password') ? 'error' : '' !!}" value="{{ $errors->edit->any() ? old('password') : '' }}">
                {!! $errors->edit->first('password', '<p class="help-block text-danger">:message</p>') !!}
            </div>
            <div class="form-group">
                <label class="form-label" for="display-name">Confirm Password</label>
                <input type="password" name="password_confirmation" class="form-control form-control-lg {!! $errors->edit->has('password_confirmation') ? 'error' : '' !!}" value="{{ $errors->edit->any() ? old('password_confirmation') : '' }}">
                {!! $errors->edit->first('password_confirmation', '<p class="help-block text-danger">:message</p>') !!}
            </div>
            <div class="form-group">
                <label class="form-label" for="phone-no">No HP</label>
                <input type="text" name="phone" class="form-control form-control-lg {!! $errors->edit->has('phone') ? 'error' : '' !!}" value="{{ $errors->edit->any() ? old('phone') : $user->phone }}" required>
                {!! $errors->edit->first('phone', '<p class="help-block text-danger">:message</p>') !!}
            </div>
            <div class="form-group">
                <label class="form-label" for="birth-day">Alamat</label>
                <input type="text" name="address" class="form-control form-control-lg {!! $errors->edit->has('address') ? 'error' : '' !!}" value="{{ $errors->edit->any() ? old('address') : $user->address }}" required>
                {!! $errors->edit->first('address', '<p class="help-block text-danger">:message</p>') !!}
            </div>
            <div class="form-group">
                <label class="form-label" for="birth-day">Status</label>
                <div class="col-12">
                    <div class="custom-control custom-radio" style="margin-right: 15px;">
                        <input type="radio" name="status" id="customRadio5" class="custom-control-input" value="active" {{ $errors->edit->any() ? (old('status') == 'active' ? 'checked' : '') : ($user->status == 'active' ? 'checked' : '') }}>
                        <label class="custom-control-label" for="customRadio5">Active</label>
                    </div>
                    <div class="custom-control custom-radio">
                        <input type="radio" name="status" id="customRadio6" class="custom-control-input" value="suspend" {{ $errors->edit->any() ? (old('status') == 'suspend' ? 'checked' : '') : ($user->status == 'suspend' ? 'checked' : '') }}>
                        <label class="custom-control-label" for="customRadio6">Suspend</label>
                    </div>
                </div>
                {!! $errors->edit->first('status', '<p class="help-block text-danger">:message</p>') !!}
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
