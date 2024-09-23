<div class="modal-content">
    <div class="modal-header">
        <h5 class="modal-title">Demografi {{ $demografiJenis->jenis_demografi }}</h5>
        <a href="#" class="close" data-bs-dismiss="modal" aria-label="Close">
            <em class="icon ni ni-cross"></em>
        </a>
    </div>
    <div class="modal-body" style="padding: 0 0 10px;">
        <table class="nowrap table">
            <thead>
                <tr>
                    <th>Kelompok Demografi</th>
                </tr>
            </thead>
            <tbody>
            @foreach($demografiJenis->kelompok as $dk)
                <tr>
                    <td>
                        <button class="btn btn-round btn-sm" style="background-color: {{ $dk->color }}"></button>
                        <span style="margin-left: 8px;">{{ $dk->kelompok_demografi.' : '.$dk->jumlah }}</span>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
</div>
