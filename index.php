<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>Yield Data Report</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="icon" href="img/IMR_ARC_STEEL3.png" type="image/png">
	  <script src="https://code.jquery.com/jquery-1.10.2.min.js"></script>
    <script src='https://kit.fontawesome.com/a076d05399.js' crossorigin='anonymous'></script>
    <link rel="stylesheet" href="AdminLTE/adminlte.min.css">
</head>
<body >

<div id="wrapper" class="wrapper-content">
  <?php
    include "sidebar.php"
  ?>
  <div id="page-content-wrapper">
    <nav class="navbar navbar-default">
          <div class="container">
                <div class="navbar-header">
                      <button class="btn-menu btn btn-toggle-menu" type="button"
                            style="background :#466d69; color:#E9E8E8;"><i class='fas fa-bars'></i>
                      </button>
                </div>
          </div>
    </nav>
    <br>
    <div class="container">
      <div class="" style="border-radius:0.25rem; width:100%;">
          <div class="tab-content">
            <div class="container-fluid">
              <div class="row mb-2">
                <div class="col-sm-6 px-1">
                  <h2 class="m-0" style="float:left; color: #565757;">Dashboard</h2>
                </div><!-- /.col -->
                <div class="col-sm-6">
                  <ol class="breadcrumb" style="float : right;">
                    <li class="breadcrumb-item"><a href="">Home</a></li>
                    <li class="breadcrumb-item active">Dashboard</li>
                  </ol>
                </div><!-- /.col -->
              </div><!-- /.row -->
            </div><!-- /.container-fluid -->
          </div>
      </div>
      <div class="row">
        <div class="col-lg-4">
          <!-- small card -->
          <div class="small-box bg-warning shadow rounded overflow-hidden">
            <div class="inner text-white">
              <?php 
                include "database/koneksi.php";
                $slt = mysqli_query($koneksi, "SELECT COUNT(*) AS MAIN FROM `tbl_report`");
                while($tampil = mysqli_fetch_array($slt)){
              ?>
              <h3><?php echo $tampil['MAIN']; }?></h3>

              <p>Main Records</p>
            </div>
            <div class="icon">
              <i class="fa fa-database"></i>
            </div>
            <div class="small-box-footer">
              <a class="small text-white link" href="data-report.php">
                <div class="row">
                  <div class="col-sm-12 mt-2 mb-2">
                    View Details <i class="fas fa-arrow-circle-right"></i>
                  </div>
                </div>
              </a>
            </div>
          </div>
        </div>
        <div class="col-lg-4">
          <!-- small card -->
          <div class="small-box bg-primary shadow rounded overflow-hidden">
            <div class="inner text-white">
              <?php 
                include "database/koneksi.php";
                $slt = mysqli_query($koneksi, "SELECT COUNT(*) AS SLT FROM `slt`");
                while($tampil = mysqli_fetch_array($slt)){
              ?>
              <h3><?php echo $tampil['SLT']; }?></h3>

              <p>SLT Records</p>
            </div>
            <div class="icon">
              <i class="fas fa-chart-pie"></i>
            </div>
            <div class="small-box-footer">
              <a class="small text-white link" href="data-report-slt.php">
                <div class="row">
                  <div class="col-sm-12 mt-2 mb-2">
                    View Details <i class="fas fa-arrow-circle-right"></i>
                  </div>
                </div>
              </a>
            </div>
          </div>
        </div>
        <div class="col-lg-4">
          <!-- small card -->
          <div class="small-box bg-danger shadow rounded overflow-hidden">
            <div class="inner text-white">
              <?php 
                include "database/koneksi.php";
                $slt = mysqli_query($koneksi, "SELECT COUNT(*) AS BAL FROM `bal`");
                while($tampil = mysqli_fetch_array($slt)){
              ?>
              <h3><?php echo $tampil['BAL']; }?></h3>

              <p>BAL Records</p>
            </div>
            <div class="icon">
              <i class="fa fa-folder"></i>
            </div>
            <div class="small-box-footer">
              <a class="small text-white link" href="data-report-slt.php">
                <div class="row">
                  <div class="col-sm-12 mt-2 mb-2">
                    View Details <i class="fas fa-arrow-circle-right"></i>
                  </div>
                </div>
              </a>
            </div>
          </div>
        </div>
      </div>
      
      <div class="row">
        <?php 
          $tahun= date('Y');
        ?>
        <!-- /.col (RIGHT) -->
        <div class="col-md-7">
          <!-- AREA CHART -->
          <div class="card card-info shadow rounded overflow-hidden">
            <div class="card-header">
              <h3 class="card-title">Incoming Raw Matrial And Prime <?php echo $tahun ?></h3>

              <div class="card-tools">
                <button type="button" class="btn btn-tool" data-card-widget="collapse">
                  <i class="fas fa-minus"></i>
                </button>
                <button type="button" class="btn btn-tool" data-card-widget="remove">
                  <i class="fas fa-times"></i>
                </button>
              </div>
            </div>
            <div class="card-body">
              <div class="chart">
                <canvas id="myChart" style="min-height: 350px; height: 300px; max-height: 250px; width: 100%;"></canvas>
              </div>
            </div>
            <!-- /.card-body -->
          </div>
          <!-- /.card -->
        </div>
        <div class="col-md-5">
          <!-- AREA CHART -->
          <div class="card card-secondary shadow rounded overflow-hidden">
            <div class="card-header">
              <h3 class="card-title">Yield Performance <?php echo $tahun ?></h3>

              <div class="card-tools">
                <button type="button" class="btn btn-tool" data-card-widget="collapse">
                  <i class="fas fa-minus"></i>
                </button>
                <button type="button" class="btn btn-tool" data-card-widget="remove">
                  <i class="fas fa-times"></i>
                </button>
              </div>
            </div>
            <div class="card-body">
              <div class="chart">
                <canvas id="myChart1" style="min-height: 350px; height: 300px; max-height: 250px; max-width: 100%;"></canvas>
              </div>
            </div>
            <!-- /.card-body -->
          </div>
          <!-- /.card -->
        </div>
      </div>

      <div class="row">
        <div class="col-lg-3">
          <!-- small card -->
          <div class="small-box bg-white shadow rounded overflow-hidden">
            <div class="inner text-white" style="border-radius:0.25rem; background-color: #466d69;">
              <div class="py-2 px-2">
                <label for="logo"><img src="img/IMR_ARC_STEEL.png" alt="logo" class="img-cover-profile rounded img-thumbnail" width="120px" height="120px"></label>
                <br>
                <h5 class="mt-0 mb-0">PT IMR ARC STEEL</h5>
                <p class="small mb-0">Administrator</p>
              </div>
            </div>
            <div class="py-2 px-4">
              <form method="post">
                <div class="row">
                    <div class="container mb-1">
                        <label for="namatoko" style = "float : left;">Company Name :</label>
                        <input name="nama_toko" type="text" class="form-control" value="IMR ARC STEEL" id="namaperusahaan" placeholder="Nama Perusahaan" readonly required>
                    </div>
                    <div class="container mb-1">
                        <label for="username" style = "float : left;">Email :</label>
                        <input name="email" type="text" class="form-control" value="info@arcsteelasia.com" id="username" placeholder="email" readonly required>
                    </div>
                    <div class="container mb-1">
                        <label for="telepon" style = "float : left;">Telepon :</label>
                        <input name="telepon" type="text" class="form-control" value="+62321-6820101" id="telepon" placeholder="0821xxx" readonly required>
                    </div>
                </div>
              </form>
            </div>
          </div>
        </div>
        <div class="col-lg-9">
          <!-- small card -->
          <div class="small-box bg-white shadow rounded overflow-hidden">
            <div class="py-2 px-2">
              <div class="row">
                <iframe src="https://www.google.com/maps/embed?pb=!1m14!1m8!1m3!1d10105.94368952096!2d112.59098893043956!3d-7.546167456810217!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e7875130143dea9%3A0xdded0819103eeae6!2sPT.%20IMR%20ARC%20STEEL!5e1!3m2!1sid!2sid!4v1675405738323!5m2!1sid!2sid" width="940" height="380" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

<script src="AdminLTE/adminlte.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
const data = {
  labels: [
  <?php
    include 'database/koneksi.php';
    $tahun= date('Y');
    $query_material_prime = "SELECT Grade, SUM(PRIME_SLT) AS 'PRIME', SUM(Material_Processed) AS 'IncomingRM', (SUM(PRIME_SLT)/SUM(Material_Processed)*100) AS 'Yield' FROM `tbl_report` WHERE RIGHT(tanggal,4) = $tahun GROUP BY (Grade)";
    $hasil_query = mysqli_query($koneksi, $query_material_prime);
    if ($hasil_query == false){
        echo("Error description: ". mysqli_error($koneksi));die;
    }
    if (mysqli_num_rows($hasil_query) > 0){
        while ($row = mysqli_fetch_assoc($hasil_query)){
            echo "'".str_replace("'", "", $row['Grade'])."',";
        }
    }      
  ?>
  ],
  datasets: [{
    type: 'line',
    label: 'PRIME',
    data: [
          <?php
                $hasil_query = mysqli_query($koneksi, $query_material_prime);
                if ($hasil_query == false){
                      echo("Error description: ". mysqli_error($koneksi));die;
                }
                if (mysqli_num_rows($hasil_query) > 0){
                      while ($row = mysqli_fetch_assoc($hasil_query)){
                      echo "'".$row['PRIME']."',";
                      }
                }      
          ?>
    ],
    fill: false,
    borderWidth: 1,
    tension: 0.5,
    fill:true
  },
  {
    type: 'line',
    label: 'Incoming RM',
    data: [
          <?php
                $hasil_query = mysqli_query($koneksi, $query_material_prime);
                if ($hasil_query == false){
                      echo("Error description: ". mysqli_error($koneksi));die;
                }
                if (mysqli_num_rows($hasil_query) > 0){
                      while ($row = mysqli_fetch_assoc($hasil_query)){
                      echo "'".$row['IncomingRM']."',";
                      }
                }      
          ?>
    ],
    borderWidth: 1,
    tension: 0.4,
    fill:true
  }
  ]
};

const config = {
  type: 'scatter',
  data: data,
  options: {
        responsive: false
  }
};

const datayield = {
  labels: [
        <?php
      include 'database/koneksi.php';
      $query_yield = "SELECT Grade, SUM(PRIME_SLT) AS 'PRIME', SUM(Material_Processed) AS 'IncomingRM', (SUM(PRIME_SLT)/SUM(Material_Processed)*100) AS 'Yield' FROM `tbl_report` WHERE RIGHT(tanggal,4) = $tahun GROUP BY (Grade)";
      $hasil_yield = mysqli_query($koneksi, $query_yield);
      if ($hasil_yield == false){
          echo("Error description: ". mysqli_error($koneksi));die;
      }
      if (mysqli_num_rows($hasil_yield) > 0){
          while ($row = mysqli_fetch_assoc($hasil_yield)){
              echo "'".str_replace("'", "", $row['Grade'])."',";
          }
      }      
  ?>
  ],
  datasets: [{
        label: 'Yield',
        data: [
              <?php
          $hasil_yield = mysqli_query($koneksi, $query_yield);
          if ($hasil_yield == false){
              echo("Error description: ". mysqli_error($koneksi));die;
          }
          if (mysqli_num_rows($hasil_yield) > 0){
              while ($row = mysqli_fetch_assoc($hasil_yield)){
                  echo "'".$row['Yield']."',";
              }
          }      
      ?>
        ],
        hoverOffset: 4
  }]
};

const configyield = {
  type: 'doughnut',
  data: datayield,
  options: {
        responsive: false
  }
};

const myChart = new Chart(document.getElementById('myChart'), config);
const myChart1 = new Chart(document.getElementById('myChart1'), configyield);
</script>
</body>
</html>
