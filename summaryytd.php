<!DOCTYPE html>
<html lang="en">

<head>
      <meta charset="utf-8">
      <title>Yield Data Report</title>
      <meta name="viewport" content="width=device-width, initial-scale=1">
      <link rel="icon" href="img/IMR_ARC_STEEL3.png" type="image/png">
      <script src="https://code.jquery.com/jquery-1.10.2.min.js"></script>
      <script src='https://kit.fontawesome.com/a076d05399.js' crossorigin='anonymous'></script>
      <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
</head>

<body>
      <div id="wrapper" class="wrapper-content">
            <?php
        include "sidebar.php"
    ?>
            <div id="page-content-wrapper">
                  <nav class="navbar navbar-default">
                        <div class="container">
                              <div class="navbar-header">
                                    <button class="btn-menu btn btn-toggle-menu" type="button" style="background :#466d69; color:#E9E8E8;"><i class='fas fa-bars'></i>
                                    </button>
                              </div>
                        </div>
                  </nav>
                  <div class="container">
                        <div class="row">
                              <div class="col-lg-12">
                                    <div class="container">
                                          <br>
                                          <form class="row g-4" action="" method="GET">
                                                <div class="col-auto">
                                                      <select class="form-control" name="tahun">
                                                            <option value="">Tahun</option>
                                                            <?php
                                                            $mulai= date('Y') - 10;
                                                            for($i = $mulai;$i<$mulai + 20;$i++){
                                                                  $sel = $i == date('Y') ? ' selected="selected"' : '';
                                                                  echo '<option value="'.$i.'"'.$sel.'>'.$i.'</option>';
                                                            }
                                                            ?>
                                                      </select>
                                                </div>
                                                <div class="col-auto">
                                                      <input class="form-control btn btn-primary" type="submit" name="submit" value="Cari">
                                                </div>
                                          </form>
                                          <br>
                                          <h1 class="text-center font-weight-bold" style="color: #565757;">Yield Performance of <?php echo  (isset($_GET['tahun']))? $_GET['tahun'] : $i-10; ?></h1>
                                          <br>
                                          <?php
                                                include 'database/koneksi.php';
                                          ?>
                                          <?php  
                                              $TahunSekarang = (isset($_GET['tahun']))? $_GET['tahun'] : $i-10;
                                          ?>
                                          <div style="overflow-x : auto;">
                                                <table id="example" class="table table-bordered table-hover">
                                                      <thead class="bg-secondary text-white">
                                                            <tr class="bg-secondary text-white">
                                                                  <th></th>
                                                                  <th></th>
                                                                  <th>Average <?php echo $TahunSekarang-1 ?></th>
                                                                  <th>January</th>
                                                                  <th>February</th>
                                                                  <th>March</th>
                                                                  <th>April</th>
                                                                  <th>May</th>
                                                                  <th>June</th>
                                                                  <th>July</th>
                                                                  <th>Agustus</th>
                                                                  <th>September</th>
                                                                  <th>Oktober</th>
                                                                  <th>November</th>
                                                                  <th>Desember</th>
                                                                  <th>Acumulation Year To Date</th>
                                                            </tr>
                                                      </thead>
                                                      <tbody>
                                                            <tr>
                                                                  <?php
                                                                  $tahun = (isset($_GET['tahun']))? $_GET['tahun'] : $i-10;
                                                                  $months = ["01","02","03","04","05","06","07","08","09","10","11","12","total"];
                                                                  $grades = ["304","304L","316L","301","409L","J1","J2","J3","J4","410","430"];
                                                                  // $grades = ["304"];
                                                                  $kategories = ["PRIME_SLT","Material_Processed","Yeild"];
                                                                  // $kategoriesindb = ["Prime","Incoming","Yeild","Rolling"];
                                                                  foreach ($grades as $grade ) {
                                                                        echo "<tr>";
                                                                        echo"<th rowspan='4'>$grade</th>";
                                                                        // echo"<th rowspan=''>$grade</th>";
                                                                        foreach ($kategories as $kategori ) {
                                                                              if ($kategori=="Yeild") {
                                                                                    $tahuns = (int) $tahun;
                                                                                    $tahuns -= 1;
                                                                                    $tahuns = (string) $tahuns;
                                                                                    // $Yeild = 0;
                                                                                    $queryaverage=mysqli_query($koneksi, "SELECT * FROM tbl_report WHERE Grade = '$grade' AND RIGHT(tanggal,4) = $tahuns;");
                                                                                    $hqaverage1 = [];
                                                                                    $hqaverage2 = [];
                                                                                    while($hq = mysqli_fetch_array($queryaverage)){
                                                                                          $hqaverage1[]=$hq[$kategories[0]];
                                                                                          $hqaverage2[]=$hq[$kategories[1]];
                                                                                    }
                                                                                    // die(var_dump($hqaverage));
                                                                                    $hqaverage1 = ($hqaverage1 == []) ? 0 : array_sum($hqaverage1);
                                                                                    $hqaverage2 = ($hqaverage2 == []) ? 0 : array_sum($hqaverage2);
                                                                                    // $haverage = ($hqaverage == []) ? array_push($hqaverage,0) : ((array_sum($hqaverage))/12);
                                                                                    $haverage = ($hqaverage2== 0) ? 0 : (($hqaverage1 / $hqaverage2)*100);                                                                                    
                                                                                    echo "<tr>
                                                                                    <th>".$kategori."</th>
                                                                                    <td>".sprintf('%0.2f', $haverage)."%</td>
                                                                                    ";
                                                                                    foreach ($months as $month ) {
                                                                                          if ($month=="total") {
                                                                                                # code...
                                                                                                $query=mysqli_query($koneksi, "SELECT * FROM tbl_report WHERE Grade = '$grade' AND RIGHT(tanggal,4) = $tahun;");
                                                                                                $hasil1 = [];
                                                                                                $hasil2 = [];
                                                                                                while ($hq = mysqli_fetch_array($query)) {
                                                                                                      $hasil1[] = $hq[$kategories[0]];
                                                                                                      $hasil2[] = $hq[$kategories[1]];
                                                                                                      // die(var_dump($hasil));
                                                                                                }
                                                                                                $hasilakhir1 = ($hasil1 == []) ? 0 : array_sum($hasil1);
                                                                                                $hasilakhir2 = ($hasil2 == []) ? 0 : array_sum($hasil2);
                                                                                                $hasilakhir = ($hasilakhir2== 0) ? 0 : (($hasilakhir1 / $hasilakhir2)*100);
                                                                                                echo "<td>".sprintf('%0.2f', $hasilakhir)."%</td>";
                                                                                          } else {
                                                                                                $query = mysqli_query($koneksi, "SELECT * FROM tbl_report WHERE Grade = '$grade' AND tanggal = $month.$tahun;");
                                                                                                // $query=mysqli_query($koneksi, "SELECT * FROM tbl_report WHERE Grade = '$grade';");
                                                                                                $hasil1 = [];
                                                                                                $hasil2 = [];
                                                                                                while ($hq = mysqli_fetch_array($query)) {
                                                                                                      $hasil1[] = $hq[$kategories[0]];
                                                                                                      $hasil2[] = $hq[$kategories[1]];                                                                                                      
                                                                                                      // die(var_dump($hasil1));
                                                                                                }
                                                                                                $hasilakhir1 = ($hasil1 == []) ? 0 : array_sum($hasil1);
                                                                                                $hasilakhir2 = ($hasil2 == []) ? 0 : array_sum($hasil2);
                                                                                                $hasilakhir = ($hasilakhir2==0) ? 0 : ($hasilakhir1 / $hasilakhir2*100);
                                                                                                echo "<td>".sprintf('%0.2f', $hasilakhir)."%</td>";
                                                                                          }
                                                                                    }
                                                                              }else {
                                                                                    $tahuns = (int) $tahun;
                                                                                    $tahuns -= 1;
                                                                                    $tahuns = (string) $tahuns;
                                                                                    $queryaverage=mysqli_query($koneksi, "SELECT * FROM tbl_report WHERE Grade = '$grade' AND RIGHT(tanggal,4) = $tahuns;");
                                                                                    $hqaverage = [];
                                                                                    while($hq = mysqli_fetch_array($queryaverage)){
                                                                                          $hqaverage[]=$hq[$kategori];
                                                                                    }
                                                                                    // $haverage = ($hqaverage == []) ? array_push($hqaverage,0) : ((array_sum($hqaverage))/12);
                                                                                    $haverage = ($hqaverage == []) ? 0 : array_sum($hqaverage)/12;  
                                                                                    $selek=($kategori=="PRIME_SLT")?'':'';
                                                                                    // die(var_dump($kategori));
                                                                                    echo "<tr>
                                                                                    <th>".$kategori."</th>
                                                                                    <td>".sprintf('%0.2f', $haverage)."</td>
                                                                                    $selek";
                                                                                    foreach ($months as $month ) {
                                                                                          if ($month=="total") {
                                                                                                # code...
                                                                                                $query=mysqli_query($koneksi, "SELECT * FROM tbl_report WHERE Grade = '$grade' AND RIGHT(tanggal,4) = $tahun;");
                                                                                                $hasil = [];
                                                                                                while ($hq = mysqli_fetch_array($query)) {
                                                                                                      $hasil[] = $hq[$kategori];
                                                                                                      // die(var_dump($hasil));
                                                                                                }
                                                                                                $hasilakhir=($hasil==[])? 0: array_sum($hasil);
                                                                                                echo "<td>" . $hasilakhir . "</td>";
                                                                                          } else {
                                                                                                $query = mysqli_query($koneksi, "SELECT * FROM tbl_report WHERE Grade = '$grade' AND tanggal = $month.$tahun;");
                                                                                                // $query=mysqli_query($koneksi, "SELECT * FROM tbl_report WHERE Grade = '$grade';");
                                                                                                $hasil = [];
                                                                                                while ($hq = mysqli_fetch_array($query)) {
                                                                                                      $hasil[] = $hq[$kategori];
                                                                                                      // die(var_dump($hasil));
                                                                                                }
                                                                                                $hasilakhir = ($hasil == []) ? 0 : array_sum($hasil);
                                                                                                echo "<td>" . $hasilakhir . "</td>";
                                                                                          }
                                                                                    }
                                                                                    
                                                                              }
                                                                        }
                                                                        echo "</tr>";
                                                                        echo "</tr>";
                                                                  }                                                                  
                                                                ?>
                                                            </tr>

                                                      </tbody>
                                                </table>
                                          </div>
                                    </div>
                              </div>
                        </div>
                  </div>
            </div>
      </div>
</body>

</html>