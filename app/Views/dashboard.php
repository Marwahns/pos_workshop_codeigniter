<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <div class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1 class="m-0">Dashboard</h1>
        </div>
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="#">Home</a></li>
            <li class="breadcrumb-item active">Dashboard</li>
          </ol>
        </div>
      </div>
    </div>
  </div>

  <!-- Main content -->
  <section class="content">
    <div class="container-fluid">
      <div class="row">

        <!-- ## Spare Parts -->
        <div class="col-lg-3 col-6">
          <div class="small-box bg-info">
            <div class="inner">
              <h3><?= esc($spareParts) ?></h3>
              <p>Total Spare Parts</p>
            </div>
            <div class="icon">
              <i class="fas fa-boxes"></i>
            </div>
            <?php if (get_user('id_role') == 1 || get_user('id_role') == 2) { ?>
              <a href="<?= base_url('spareparts/index') ?>" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
            <?php } ?>
          </div>
        </div>

        <!-- ## Items -->
        <div class="col-lg-3 col-6">
          <div class="small-box bg-gradient-orange">
            <div class="inner">
              <?php foreach ($item as $value) { ?>
                <h3><?= $value ?></h3>
              <?php } ?>
              <p>Total Items</p>
            </div>
            <div class="icon">
              <i class="ion ion-bag"></i>
            </div>
            <?php if (get_user('id_role') == 1 || get_user('id_role') == 2) { ?>
              <a href="<?= base_url('spareparts/index') ?>" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
            <?php } ?>
          </div>
        </div>

        <!-- ## Category -->
        <div class="col-lg-3 col-6">
          <div class="small-box bg-pink">
            <div class="inner">
              <h3><?= esc($kategori) ?></h3>

              <p>Total Category</p>
            </div>
            <div class="icon">
              <i class="fas fa-project-diagram"></i>
            </div>
            <?php if (get_user('id_role') == 1 || get_user('id_role') == 2) { ?>
              <a href="<?= base_url('kategori/index') ?>" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
            <?php } ?>
          </div>
        </div>

        <!-- ## Supplier -->
        <div class="col-lg-3 col-6">
          <div class="small-box bg-fuchsia">
            <div class="inner">
              <h3><?= esc($supplier) ?></h3>
              <p>Total Supplier</p>
            </div>
            <div class="icon">
              <i class="fas fa-people-carry"></i>
            </div>
            <?php if (get_user('id_role') == 1 || get_user('id_role') == 2) { ?>
              <a href="<?= base_url('supplier/index') ?>" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
            <?php } ?>
          </div>
        </div>
      </div>

      <?php if (get_user('id_role') == 1 || get_user('id_role') == 2) { ?>
        <div class="row">

          <!-- ## Penjualan Harian -->
          <div class="col-lg-3 col-6">
            <div class="small-box bg-warning">
              <div class="inner">
                <?php foreach ($penjualan_harian as $value) { ?>
                  <h3><?= $value ?></h3>
                <?php } ?>
                <p>Total Penjualan Harian</p>
              </div>
              <div class="icon">
                <i class="fas fa-chart-pie"></i>
              </div>
              <?php if (get_user('id_role') == 1 || get_user('id_role') == 2) { ?>
                <a href="<?= base_url('pembayaran/invoice') ?>" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
              <?php } ?>
            </div>
          </div>

          <!-- ## Penjualan Mingguan -->
          <div class="col-lg-3 col-6">
            <div class="small-box bg-blue">
              <div class="inner">
                <?php foreach ($penjualan_mingguan as $value) { ?>
                  <h3><?= $value ?></h3>
                <?php } ?>
                <p>Total Penjualan Mingguan</p>
              </div>
              <div class="icon">
                <i class="fa fa-chart-line"></i>
              </div>
              <?php if (get_user('id_role') == 1 || get_user('id_role') == 2) { ?>
                <a href="<?= base_url('pembayaran/invoice') ?>" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
              <?php } ?>
            </div>
          </div>

          <!-- ## Penjualan Bulanan -->
          <div class="col-lg-3 col-6">
            <div class="small-box bg-lightblue">
              <div class="inner">
                <?php foreach ($penjualan_bulanan as $value) { ?>
                  <h3><?= $value ?></h3>
                <?php } ?>
                <p>Total Penjualan Bulanan</p>
              </div>
              <div class="icon">
                <i class="fas fa-chart-area"></i>
              </div>
              <?php if (get_user('id_role') == 1 || get_user('id_role') == 2) { ?>
                <a href="<?= base_url('pembayaran/invoice') ?>" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
              <?php } ?>
            </div>
          </div>

          <!-- ## Penjualan -->
          <div class="col-lg-3 col-6">
            <div class="small-box bg-gradient-pink">
              <div class="inner">
                <h3><?= esc($penjualan) ?></h3>
                <p>Total Penjualan</p>
              </div>
              <div class="icon">
                <i class="fas fa-chart-bar"></i>
              </div>
              <?php if (get_user('id_role') == 1 || get_user('id_role') == 2) { ?>
                <a href="<?= base_url('pembayaran/invoice') ?>" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
              <?php } ?>
            </div>
          </div>

        </div>

        <div class="row">

          <!-- ## Pendapatan Harian -->
          <div class="col-lg-3 col-6">
            <div class="small-box bg-lime">
              <div class="inner">
                <?php foreach ($pendapatan_harian as $value) { ?>
                  <h3><?= $value ?></h3>
                <?php } ?>

                <p>Total Pendapatan Harian</p>
              </div>
              <div class="icon">
                <i class="fa fa-cash-register"></i>
              </div>
              <?php if (get_user('id_role') == 1 || get_user('id_role') == 2) { ?>
                <a href="<?= base_url('pembayaran/invoice') ?>" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
              <?php } ?>
            </div>
          </div>

          <!-- ## Pendapatan Mingguan -->
          <div class="col-lg-3 col-6">
            <div class="small-box bg-success">
              <div class="inner">
                <?php foreach ($pendapatan_mingguan as $value) { ?>
                  <h3><?= $value ?></h3>
                <?php } ?>

                <p>Total Pendapatan Mingguan</p>
              </div>
              <div class="icon">
                <i class="fas fa-money-bill-alt"></i>
              </div>
              <?php if (get_user('id_role') == 1 || get_user('id_role') == 2) { ?>
                <a href="<?= base_url('pembayaran/invoice') ?>" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
              <?php } ?>
            </div>
          </div>

          <!-- ## Pendapatan Bulanan -->
          <div class="col-lg-3 col-6">
            <div class="small-box bg-teal">
              <div class="inner">
                <?php foreach ($pendapatan_bulanan as $value) { ?>
                  <h3><?= $value ?></h3>
                <?php } ?>

                <p>Total Pendapatan Bulanan</p>
              </div>
              <div class="icon">
                <i class="fas fa-money-check-alt"></i>
              </div>
              <?php if (get_user('id_role') == 1 || get_user('id_role') == 2) { ?>
                <a href="<?= base_url('pembayaran/invoice') ?>" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
              <?php } ?>
            </div>
          </div>

          <!-- ## Sales -->
          <div class="col-lg-3 col-6">
            <div class="small-box bg-gradient-olive">
              <div class="inner">
                <?php foreach ($amount as $value) { ?>
                  <h3><?= $value ?></h3>
                <?php } ?>

                <p>Total Sales</p>
              </div>
              <div class="icon">
                <i class="fas fa-dollar-sign"></i>
              </div>
              <?php if (get_user('id_role') == 1 || get_user('id_role') == 2) { ?>
                <a href="<?= base_url('pembayaran/invoice') ?>" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
              <?php } ?>
            </div>
          </div>

        </div>

        <div class="row">
          <!-- ## User -->
          <div class="col-lg-3 col-6">
            <div class="small-box bg-gradient-orange">
              <div class="inner">
                <h3><?= esc($users) ?></h3>
                <p>Total User Registrations</p>
              </div>
              <div class="icon">
                <i class="fas fa-user-friends"></i>
              </div>
              <?php if (get_user('id_role') == 1 || get_user('id_role') == 2) { ?>
                <a href="<?= base_url('users/index') ?>" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
              <?php } ?>
            </div>
          </div>
        </div>

      <?php } ?>

    </div>

    <!-- Main row -->
    <div class="row">
      <section class="col-lg-5 connectedSortable">

      </section>
      
    </div>

</div>