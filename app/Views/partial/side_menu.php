<!-- Main Sidebar Container -->
<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="#" class="brand-link">
        <!-- <img src="<?= base_url('adminLTE/dist/img/AdminLTELogo.png') ?>" alt="AdminLTELogo" height="60" width="60" class="brand-image img-circle elevation-3" style="opacity: .8"> -->
        <i class="fas fa-tools ml-3 mr-1"></i>
        <!-- <?php if (get_user('id_role') == 1) {
                    //     echo '<span class="brand-text font-weight-light">Super Admin</span>';
                    // } elseif(get_user('id_role')==2){
                    //     echo '<span class="brand-text font-weight-light">Admin</span>';
                    // } elseif(get_user('id_role')==3){
                    //     echo '<span class="brand-text font-weight-light">Kasir</span>';
                } ?> -->

        <!-- <span class="brand-text font-weight-light"><?= get_user('nama') ?></span> -->
        <span class="brand-text font-weight-light">POS Bengkel Motor</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
        <!-- Sidebar user (optional) -->
        <div class="user-panel mt-3 pb-3 mb-3 d-flex">
            <div class="image">
                <img src="<?= base_url('adminLTE/dist/img/user1-128x128.jpg') ?>" alt="User Avatar" class="img-size-50 mr-3 img-circle">
            </div>
            <div class="info">
                <a href="#" class="d-block"><?= get_user('username') ?></a>
            </div>
        </div>

        <!-- SidebarSearch Form -->
        <!-- <div class="form-inline">
            <div class="input-group" data-widget="sidebar-search">
                <input class="form-control form-control-sidebar" type="search" placeholder="Search" aria-label="Search">
                <div class="input-group-append">
                    <button class="btn btn-sidebar">
                        <i class="fas fa-search fa-fw"></i>
                    </button>
                </div>
            </div>
        </div> -->

        <!-- Sidebar Menu -->
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
                <li class="nav-item">
                    <a href="<?= base_url('dashboard/index') ?>" class="nav-link">
                        <i class="nav-icon fas fa-tachometer-alt"></i>
                        <p>
                            Dashboard
                        </p>
                    </a>
                </li>
                <li class="nav-header">FEATURES</li>
                <?php if (esc(get_user('id_role') == 1) || esc(get_user('id_role') == 2)) : ?>
                    <li class="nav-item">
                        <a href="<?= base_url('supplier/index') ?>" class="nav-link">
                            <i class="nav-icon fa fa-truck-moving"></i>
                            <p>
                                Supplier
                            </p>
                        </a>
                    </li>
                <?php endif ?>
                <?php if (esc(get_user('id_role') == 1) || esc(get_user('id_role') == 2)) : ?>
                    <li class="nav-item">
                        <a href="#" class="nav-link">
                            <i class="nav-icon fas fa-edit"></i>
                            <p>
                                Master
                                <i class="fas fa-angle-left right"></i>
                            </p>
                        </a>

                        <ul class="nav nav-treeview">
                            <li class="nav-item">
                                <a href="<?= base_url('kategori/index') ?>" class="nav-link">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>Kategori</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="<?= base_url('spareparts/index') ?>" class="nav-link">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>Spare Parts</p>
                                </a>
                            </li>
                        </ul>
                    </li>
                <?php endif ?>
                <li class="nav-item">
                    <a href="#" class="nav-link">
                        <i class="nav-icon fas fa-cart-plus"></i>
                        <p>
                            Transaksi
                            <i class="fas fa-angle-left right"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="<?= base_url('pembayaran/index') ?>" class="nav-link">
                                <!-- <a href="<?= base_url('main/pos') ?>" class="nav-link"> -->
                                <i class="far fa-circle nav-icon"></i>
                                <p>Penjualan</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <!-- <a href="<?= base_url('penjualan/invoice') ?>" class="nav-link"> -->
                            <a href="<?= base_url('pembayaran/invoice') ?>" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Invoice</p>
                            </a>
                        </li>
                        <?php if (esc(get_user('id_role') == 1) || esc(get_user('id_role') == 2)) : ?>
                            <li class="nav-item">
                                <a href="<?= base_url('stok/index') ?>" class="nav-link">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>Stok Masuk</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="<?= base_url('stok/indexStokKeluar') ?>" class="nav-link">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>Stok Keluar</p>
                                </a>
                            </li>
                        <?php endif ?>
                    </ul>
                </li>
                <li class="nav-header">ADMINISTRATOR</li>
                <li class="nav-item">
                    <a href="<?= base_url('users/profile') ?>" class="nav-link">
                        <i class="nav-icon fa fa-user"></i>
                        <p>
                            Profile
                        </p>
                    </a>
                </li>
                <?php if (esc(get_user('id_role') == 1)) : ?>
                    <li class="nav-item">
                        <a href="<?= base_url('users/index') ?>" class="nav-link">
                            <i class="nav-icon fa fa-users"></i>
                            <p>
                                Pengguna
                            </p>
                        </a>
                    </li>
                <?php endif ?>
                <li class="nav-item">
                    <a href="<?= base_url('auth/logout') ?>" class="nav-link">
                        <i class="nav-icon fa fa-sign-out-alt"></i>
                        <p>
                            Logout
                        </p>
                    </a>
                </li>
            </ul>
        </nav>
        <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
</aside>