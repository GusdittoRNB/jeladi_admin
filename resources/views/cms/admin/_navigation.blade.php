<div class="nk-sidebar-element nk-sidebar-body">
    <div class="nk-sidebar-content">
        <div class="nk-sidebar-menu" data-simplebar>
            <ul class="nk-menu">
                <li class="nk-menu-heading">
                    <h6 class="overline-title text-primary-alt">Dashboard</h6>
                </li><!-- .nk-menu-item -->
                <li class="nk-menu-item @if(\Request::segment(2) == 'dashboard') active current-page @endif">
                    <a href="{{ url('dashboard') }}" class="nk-menu-link">
                        <span class="nk-menu-icon"><em class="icon ni ni-home"></em></span>
                        <span class="nk-menu-text">Dashboard</span>
                    </a>
                </li><!-- .nk-menu-item -->
                <li class="nk-menu-heading">
                    <h6 class="overline-title text-primary-alt">Administrasi Management</h6>
                </li><!-- .nk-menu-item -->
                <li class="nk-menu-item has-sub @if(\Request::segment(2) == 'surat') active current-page @endif">
                    <a href="#" class="nk-menu-link nk-menu-toggle">
                        <span class="nk-menu-icon"><em class="icon ni ni-file-docs"></em></span>
                        <span class="nk-menu-text">Administrasi Persuratan</span>
                    </a>
                    <ul class="nk-menu-sub">
                        <li class="nk-menu-item @if(\Request::segment(3) == 'admin') active current-page @endif">
                            <a href="{{ route('surat.permohonan.index') }}" class="nk-menu-link"><span class="nk-menu-text">Permohonan Surat</span></a>
                        </li>
                        <li class="nk-menu-item @if(\Request::segment(3) == 'enduser') active current-page @endif">
                            <a href="{{ route('surat.history-permohonan.index') }}" class="nk-menu-link"><span class="nk-menu-text">Riwayat Permohonan Surat</span></a>
                        </li>
                    </ul>
                </li><!-- .nk-menu-item -->
                <li class="nk-menu-item @if(\Request::segment(2) == 'geografis-desa') active current-page @endif">
                    <a href="{{ route('geografis-desa.index') }}" class="nk-menu-link">
                        <span class="nk-menu-icon"><em class="icon ni ni-location"></em></span>
                        <span class="nk-menu-text">Geografis Desa</span>
                    </a>
                </li><!-- .nk-menu-item -->
                <li class="nk-menu-item @if(\Request::segment(2) == 'layanan-kesehatan') active current-page @endif">
                    <a href="{{ route('layanan-kesehatan.article.index') }}" class="nk-menu-link">
                        <span class="nk-menu-icon"><em class="icon ni ni-plus-medi"></em></span>
                        <span class="nk-menu-text">Layanan Kesehatan</span>
                    </a>
                </li>
                <li class="nk-menu-item @if(\Request::segment(2) == 'demografi') active current-page @endif">
                    <a href="{{ route('demografi.jenis.index') }}" class="nk-menu-link">
                        <span class="nk-menu-icon"><em class="icon ni ni-bar-chart"></em></span>
                        <span class="nk-menu-text">Demografi Penduduk</span>
                    </a>
                </li>
                <li class="nk-menu-heading">
                    <h6 class="overline-title text-primary-alt">App Management</h6>
                </li><!-- .nk-menu-item -->
                <li class="nk-menu-item has-sub @if(\Request::segment(2) == 'user-management') active current-page @endif">
                    <a href="#" class="nk-menu-link nk-menu-toggle">
                        <span class="nk-menu-icon"><em class="icon ni ni-user-list"></em></span>
                        <span class="nk-menu-text">Data User</span>
                    </a>
                    <ul class="nk-menu-sub">
                        <li class="nk-menu-item @if(\Request::segment(3) == 'admin') active current-page @endif">
                            <a href="{{ route('usermanagement.admin.index') }}" class="nk-menu-link"><span class="nk-menu-text">User Admin</span></a>
                        </li>
                        <li class="nk-menu-item @if(\Request::segment(3) == 'enduser') active current-page @endif">
                            <a href="{{ route('usermanagement.enduser.index') }}" class="nk-menu-link"><span class="nk-menu-text">End User</span></a>
                        </li>
                    </ul>
                </li><!-- .nk-menu-item -->
                <li class="nk-menu-item @if(\Request::segment(2) == 'pusat-bantuan') active current-page @endif">
                    <a href="{{ route('pusat-bantuan.index') }}" class="nk-menu-link">
                        <span class="nk-menu-icon"><em class="icon ni ni-help"></em></span>
                        <span class="nk-menu-text">Pusat Bantuan</span>
                    </a>
                </li><!-- .nk-menu-item -->
            </ul><!-- .nk-menu -->
        </div><!-- .nk-sidebar-menu -->
    </div><!-- .nk-sidebar-content -->
</div><!-- .nk-sidebar-element -->
