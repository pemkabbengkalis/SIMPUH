<aside class="main-sidebar sidebar-dark-primary elevation-4">

    <!-- Sidebar -->
    <div class="sidebar">
        <!-- Sidebar user panel (optional) -->
        <div class="user-panel mt-3 pb-3 mb-3 d-flex">
            <div class="image">
                <img src="https://pixsector.com/cache/94bed8d5/av3cbfdc7ee86dab9a41d.png" class="img-circle elevation-2"
                    alt="User Image">
            </div>
            <div class="info">
                <a href="/" class="d-block">{{ sesiowner() }}</a>
            </div>
        </div>

        <!-- SidebarSearch Form -->
        <div class="form-inline">
            <div class="input-group" data-widget="sidebar-search">
                <input class="form-control form-control-sidebar" type="search" placeholder="Search"
                    aria-label="Search">
                <div class="input-group-append">
                    <button class="btn btn-sidebar">
                        <i class="fas fa-search fa-fw"></i>
                    </button>
                </div>
            </div>
        </div>

        <!-- Sidebar Menu -->
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu"
                data-accordion="false">
                <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->

                @foreach (collect(config('app.menu'))->where('level', session('level'))->sortBy('sort') as $row)
                    @if ($row['child'])
                        <li
                            class="nav-item {{ in_array(config('app.module')['path'],collect($row['child'])->pluck('path')->toArray())? 'menu-is-opening menu-open': '' }}">
                            <a href="#" class="nav-link">
                                <i class="nav-icon fas {{ $row['icon'] }}"></i>
                                <p>
                                    {{ $row['nama_menu'] }}
                                    <i class="fas fa-angle-left right"></i>
                                </p>
                            </a>
                            <ul class="nav nav-treeview">
                                @foreach (collect($row['child'])->sortBy('sort') as $row2)
                                    <li class="nav-item">
                                        <a href="{{ url($row2['path']) }}"
                                            class="nav-link {{ config('app.module')['path'] == $row2['path'] ? 'active' : '' }}">
                                            <i class="far fa-dot-circle nav-icon"></i>
                                            <p>{{ $row2['nama_menu'] }}</p>
                                        </a>
                                    </li>
                                @endforeach
                            </ul>
                        </li>
                    @else
                        <li class="nav-item ">
                            <a href="{{ url($row['path']) }}"
                                class="nav-link {{ config('app.module')['path'] == $row['path'] ? 'active' : '' }}">
                                <i class="nav-icon fas {{ $row['icon'] }}"></i>
                                <p>
                                    {{ $row['nama_menu'] }}
                                </p>
                            </a>
                        </li>
                    @endif
                @endforeach


                <li class="nav-header">PENGATURAN</li>
                <li class="nav-item">
                    <a href="{{ url('settings') }}" class="nav-link">
                        <i class="nav-icon fas fa-user"></i>
                        <p>Pengaturan Akun</p>
                    </a>
                </li>
                <li class="nav-item">
                <a id="logoutButton" onclick="konfirmasiLogout();" class="nav-link">
    <i class="nav-icon fas fa-power-off"></i>
    <p>Keluar</p>
</a>
                </li>

            </ul>
        </nav>
        <!-- /.sidebar-menu -->
        <div class="user-panel mt-3 pb-3 mb-3 d-flex" style="margin-top: 100px !important;">
            <div class="image">
            <img src="https://simpuh.bengkaliskab.go.id/public/green2.png" alt="User Image" style="width: 150px;">
            </div>
        </div>          
    </div>

    <!-- /.sidebar -->
</aside>

<script>
    function konfirmasiLogout() {
        Swal.fire({
            title: 'Apakah Anda yakin ingin keluar?',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonText: 'Ya',
            cancelButtonText: 'Batal'
        }).then((result) => {
            if (result.isConfirmed) {
                Swal.fire(
                    'Terima kasih!',
                    'Anda telah keluar dari Aplikasi SIMPUH.',
                    'success'
                ).then(() => {
                    // Redirect ke URL logout
                    window.location.href = "{{ url('logout') }}";
                });
            }
        });
    }
</script>