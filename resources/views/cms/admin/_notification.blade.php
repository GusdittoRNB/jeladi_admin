@if (Session::has('notification'))
    <div class="col-md-12" style="margin-bottom: 15px;">
        <div class="alert alert-{{ Session::get('notification.level', 'info') }} alert-dismissible" role="alert" style="margin-top: 15px;">
            <button type="button" class="close" data-bs-dismiss="alert" aria-hidden="true"></button>
            {{ Session::get('notification.message') }}
        </div>
    </div>
@endif
