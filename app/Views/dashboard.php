<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <div class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1 class="m-0">Dashboard</h1>
        </div><!-- /.col -->
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="#">Home</a></li>
            <li class="breadcrumb-item active">Dashboard</li>
          </ol>
        </div><!-- /.col -->
      </div><!-- /.row -->
    </div><!-- /.container-fluid -->
  </div>
  <!-- /.content-header -->

  <!-- Main content -->
  <section class="content">
    <div class="container-fluid">
      <!-- Small boxes (Stat box) -->
      <div class="row">
        <div class="col-lg-3 col-6">
          <!-- small box -->
          <div class="small-box bg-info">
            <div class="inner">
              <h3><?= esc($spareParts) ?></h3>

              <p>Spare Parts</p>
            </div>
            <div class="icon">
              <i class="ion ion-bag"></i>
            </div>
            <?php if (get_user('id_role') == 1 || get_user('id_role') == 2) { ?>
              <a href="<?= base_url('spareparts/index') ?>" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
            <?php } ?>
          </div>
        </div>
        <!-- ./col -->
        <div class="col-lg-3 col-6">
          <!-- small box -->
          <div class="small-box bg-success">
            <div class="inner">
              <h3><?= esc($kategori) ?></h3>

              <p>Kategori</p>
            </div>
            <div class="icon">
              <i class="ion ion-stats-bars"></i>
            </div>
            <?php if (get_user('id_role') == 1 || get_user('id_role') == 2) { ?>
              <a href="<?= base_url('kategori/index') ?>" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
            <?php } ?>
          </div>
        </div>
        <!-- ./col -->
        <div class="col-lg-3 col-6">
          <!-- small box -->
          <div class="small-box bg-warning">
            <div class="inner">
              <h3><?= esc($users) ?></h3>

              <p>User Registrations</p>
            </div>
            <div class="icon">
              <i class="ion ion-person-add"></i>
            </div>
            <?php if (get_user('id_role') == 1) { ?>
              <a href="<?= base_url('users/index') ?>" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
            <?php } ?>
          </div>
        </div>
        <!-- ./col -->
        <div class="col-lg-3 col-6">
          <!-- small box -->
          <div class="small-box bg-danger">
            <div class="inner">
              <h3><?= esc($supplier) ?></h3>

              <p>Supplier</p>
            </div>
            <div class="icon">
              <i class="ion ion-pie-graph"></i>
            </div>
            <?php if (get_user('id_role') == 1 || get_user('id_role') == 2) { ?>
              <a href="<?= base_url('supplier/index') ?>" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
            <?php } ?>
          </div>
        </div>
        <!-- ./col -->
      </div>
      <!-- /.row -->

      <div class="row">
        <div class="col-lg-3 col-6">
          <!-- small box -->
          <!-- <div class="small-box bg-info">
            <div class="inner">
              <h3><?= esc($spareParts) ?></h3>

              <p>Daily Sales</p>
            </div>
            <div class="icon">
              <i class="ion ion-bag"></i>
            </div>
          </div> -->
        </div>
        <!-- ./col -->
        <div class="col-lg-3 col-6">
          <!-- small box -->
          <!-- <div class="small-box bg-success">
            <div class="inner">
              <h3><?= esc($kategori) ?></h3>

              <p>Monthly Sales</p>
            </div>
            <div class="icon">
              <i class="ion ion-stats-bars"></i>
            </div>
          </div> -->
        </div>
        <!-- ./col -->
        <div class="col-lg-3 col-6">
          <!-- small box -->
          <!-- <div class="small-box bg-warning">
            <div class="inner">
              <h3><?= esc($users) ?></h3>

              <p>Sales Return</p>
            </div>
            <div class="icon">
              <i class="ion ion-person-add"></i>
            </div>
          </div> -->
        </div>
        <!-- ./col -->
      </div>

      <!-- Main row -->
      <div class="row">
        <!-- Left col -->
        <section class="col-lg-7 connectedSortable">
          <!-- Custom tabs (Charts with tabs)-->
          <div class="card">
            <!-- <div class="card-header">
              <h3 class="card-title">
                <i class="fas fa-chart-pie mr-1"></i>
                Sales
              </h3>
              <div class="card-tools">
                <ul class="nav nav-pills ml-auto">
                  <li class="nav-item">
                    <a class="nav-link active" href="#revenue-chart" data-toggle="tab">Area</a>
                  </li>
                  <li class="nav-item">
                    <a class="nav-link" href="#sales-chart" data-toggle="tab">Donut</a>
                  </li>
                </ul>
              </div>
            </div> -->
            <!-- /.card-header -->
            <!-- <div class="card-body">
              <div class="tab-content p-0">
                <div class="chart tab-pane active" id="revenue-chart" style="position: relative; height: 300px;">
                  <canvas id="revenue-chart-canvas" height="300" style="height: 300px;"></canvas>
                </div>
                <div class="chart tab-pane" id="sales-chart" style="position: relative; height: 300px;">
                  <canvas id="sales-chart-canvas" height="300" style="height: 300px;"></canvas>
                </div>
              </div>
            </div> -->
            <!-- /.card-body -->
          </div>
          <!-- /.card -->

        </section>
        <!-- /.Left col -->
        <!-- right col (We are only adding the ID to make the widgets sortable)-->
        <section class="col-lg-5 connectedSortable">

          <!-- solid sales graph -->
          <!-- <div class="card bg-gradient-info">
              <div class="card-header border-0">
                <h3 class="card-title">
                  <i class="fas fa-th mr-1"></i>
                  Sales Graph
                </h3>

                <div class="card-tools">
                  <button type="button" class="btn bg-info btn-sm" data-card-widget="collapse">
                    <i class="fas fa-minus"></i>
                  </button>
                  <button type="button" class="btn bg-info btn-sm" data-card-widget="remove">
                    <i class="fas fa-times"></i>
                  </button>
                </div>
              </div>
              <div class="card-body">
                <canvas class="chart" id="line-chart" style="min-height: 250px; height: 250px; max-height: 250px; max-width: 100%;"></canvas>
              </div> -->
          <!-- /.card-body -->
          <!-- <div class="card-footer bg-transparent">
                <div class="row">
                  <div class="col-4 text-center">
                    <input type="text" class="knob" data-readonly="true" value="20" data-width="60" data-height="60"
                           data-fgColor="#39CCCC">

                    <div class="text-white">Mail-Orders</div>
                  </div> -->
          <!-- ./col -->
          <!-- <div class="col-4 text-center">
                    <input type="text" class="knob" data-readonly="true" value="50" data-width="60" data-height="60"
                           data-fgColor="#39CCCC">

                    <div class="text-white">Online</div>
                  </div> -->
          <!-- ./col -->
          <!-- <div class="col-4 text-center">
                    <input type="text" class="knob" data-readonly="true" value="30" data-width="60" data-height="60"
                           data-fgColor="#39CCCC">

                    <div class="text-white">In-Store</div>
                  </div> -->
          <!-- ./col -->
          <!-- </div> -->
          <!-- /.row -->
          <!-- </div> -->
          <!-- /.card-footer -->
          <!-- </div> -->
          <!-- /.card -->
          <!-- /.card -->
        </section>
        <!-- right col -->
      </div>
      <!-- /.row (main row) -->
    </div><!-- /.container-fluid -->
  </section>
  <!-- /.content -->
</div>
<!-- /.content-wrapper -->