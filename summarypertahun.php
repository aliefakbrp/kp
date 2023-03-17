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
                              <button class="btn-menu btn btn-toggle-menu" type="button"
                                    style="background :#466d69; color:#E9E8E8;"><i class='fas fa-bars'></i>
                              </button>
                        </div>
                  </div>
            </nav>
            <br>
            <div class="container">
                  <h1 class="text-center font-weight-bold" style="color: #565757;">Summary Yeild Report Per Year</h1>
                  <br>
            </div>
            <div class="container">
                  <div class="row">
                        <div class="col-lg-12">
                              <form class="row g-4" method="GET" action="">
                                    <div class="col-auto">
                                          <select class="form-control" name="tahun">
                                                <option value="">Tahun</option>
                                                <?php
                                    $mulai= date('Y') - 10;
                                    for($i = $mulai;$i<$mulai + 20;$i++){
                                        #$sel = $i == date('Y') ? ' selected="selected"' : '';
                                        echo '<option value="'.$i.'">'.$i.'</option>';
                                    }
                                    ?>
                                          </select>
                                    </div>
                                    <div class="col-auto">
                                          <input class="form-control btn btn-primary" type="submit" value="Cari">
                                    </div>
                                    <div class="col-auto">
                                          <a href="data-report.php"><button
                                                      class="form-control btn btn-secondary">Reset</button></a>
                                    </div>
                                    <div class="col-auto">
                                          <?php
                                          $tahun = (isset($_GET['tahun']))? $_GET['tahun'] : ""
                                          ?>
                                          <a class="btn btn-success text-white" href="exportsummarypertahun.php?tahun=<?php echo $tahun?>">Export To Excel Files</a><br />
                                          <br>
                                    </div>
                              </form>
                              <div style="overflow-x : auto;">
                                     <table id="example" class="table table-bordered table-hover">
                                          <thead class="bg-secondary text-white">
                                                <tr class="bg-secondary text-white">
                                                      <th></th>
                                                      <th>RM/Incoming</th>
                                                      <th>PRIME_SLT</th>
                                                      <th>Secondary </th>
                                                      <th>BabyCoil</th>
                                                      <th>Scrap</th>
                                                      <th>SS</th>
                                                      <th>Weighing Balance</th>
                                                      <th>Yeild</th>
                                                </tr>
                                          </thead>

                                          <tbody>
                                                <?php
                                          include "database/koneksi.php";  
                                          
                                          //Total
                                          $tahun    = (isset($_GET['tahun']))? $_GET['tahun'] : "";
                                          $jmp=[];
                                          $jpslt=[];
                                          $jkw2=[];
                                          $jbc=[];
                                          $js=[];
                                          $jss=[];
                                          $jwb=[];
                                          ($tahun == "")?$total = mysqli_query($koneksi, "SELECT * FROM tbl_report"):$total = mysqli_query($koneksi, "SELECT * FROM tbl_report WHERE RIGHT(tanggal,4) = '$tahun'");
                                          while ($ttampil = mysqli_fetch_array($total)){
                                                $jmp[]=$ttampil["Material_Processed"];
                                                $jpslt[]=$ttampil["PRIME_SLT"];
                                                $jkw2[]=$ttampil["KW2"];
                                                $jbc[]=$ttampil["BabyCoil"];
                                                $js[]=$ttampil["Scrap"];
                                                $jss[]=$ttampil["SS"];
                                                $jwb[]=$ttampil["Weighing_Balance"];
                                          }
                                          $tjmp=($jmp==[])? 0: array_sum($jmp);
                                          $tjpslt=($jpslt==[])? 0: array_sum($jpslt);
                                          $tjkw2=($jkw2==[])? 0: array_sum($jkw2);
                                          $tjbc=($jbc==[])? 0: array_sum($jbc);
                                          $tjs=($js==[])? 0: array_sum($js);
                                          $tjss=($jss==[])? 0: array_sum($jss);
                                          $tjwb=($jwb==[])? 0: array_sum($jwb);
                                          echo '
                                          <tr>
                                          <th>total</th>
                                          <td>'.$tjmp.'</td>
                                          <td>'.$tjpslt.'</td>
                                          <td>'.$tjkw2.'</td>
                                          <td>'.$tjbc.'</td>
                                          <td>'.$tjs.'</td>
                                          <td>'.$tjss.'</td>
                                          <td>'.$tjwb.'</td>
                                          <td>'.(($tjpslt==0)?0:number_format($tjpslt/$tjmp*100, 2, '.', '')).'%</td>
                                          </tr>';


                                          //304
                                          ($tahun == "")?$total304 = mysqli_query($koneksi, "SELECT * FROM tbl_report where Grade = '304'"):$total304 = mysqli_query($koneksi, "SELECT * FROM tbl_report where Grade = '304' AND RIGHT(tanggal,4) = '$tahun'");
                                          $jmp304=[];
                                          $jpslt304=[];
                                          $jkw304=[];
                                          $jbc304=[];
                                          $js304=[];
                                          $jss304=[];
                                          $jwb304=[];
                                          while ($h304 = mysqli_fetch_array($total304)){
                                                $jmp304[]=$h304["Material_Processed"];
                                                $jpslt304[]=$h304["PRIME_SLT"];
                                                $jkw304[]=$h304["KW2"];
                                                $jbc304[]=$h304["BabyCoil"];
                                                $js304[]=$h304["Scrap"];
                                                $jss304[]=$h304["SS"];
                                                $jwb304[]=$h304["Weighing_Balance"];
                                          }
                                          $tjmp304=($jmp304==[])? 0: array_sum($jmp304);
                                          $tjpslt304=($jpslt304==[])? 0: array_sum($jpslt304);
                                          $tjkw304=($jkw304==[])? 0: array_sum($jkw304);
                                          $tjbc304=($jbc304==[])? 0: array_sum($jbc304);
                                          $tjs304=($js304==[])? 0: array_sum($js304);
                                          $tjss304=($jss304==[])? 0: array_sum($jss304);
                                          $tjwb304=($jwb304==[])? 0: array_sum($jwb304);
                                                                                          
                                          echo '
                                          <tr>
                                          <th>304</th>
                                          <td>'.$tjmp304.'</td>
                                          <td>'.$tjpslt304.'</td>
                                          <td>'.$tjkw304.'</td>
                                          <td>'.$tjbc304.'</td>
                                          <td>'.$tjs304.'</td>
                                          <td>'.$tjss304.'</td>
                                          <td>'.$tjwb304.'</td>
                                          <td>'.(($tjpslt304==0)?0:number_format($tjpslt304/$tjmp304*100, 2, '.', '')).'%</td>
                                          </tr>';

                                          //340L
                                          ($tahun == "")?$total304L = mysqli_query($koneksi, "SELECT * FROM tbl_report where Grade = '304L'"):$total304L = mysqli_query($koneksi, "SELECT * FROM tbl_report where Grade = '304L' AND RIGHT(tanggal,4) = '$tahun'");
                                          $jmp304L=[];
                                          $jpslt304L=[];
                                          $jkw304L=[];
                                          $jbc304L=[];
                                          $js304L=[];
                                          $jss304L=[];
                                          $jwb304L=[];
                                          while ($h304L = mysqli_fetch_array($total304L)){
                                                $jmp304L[]=$h304L["Material_Processed"];
                                                $jpslt304L[]=$h304L["PRIME_SLT"];
                                                $jkw304L[]=$h304L["KW2"];
                                                $jbc304L[]=$h304L["BabyCoil"];
                                                $js304L[]=$h304L["Scrap"];
                                                $jss304L[]=$h304L["SS"];
                                                $jwb304L[]=$h304L["Weighing_Balance"];
                                          }
                                          $tjmp304L=($jmp304L==[])? 0: array_sum($jmp304L);
                                          $tjpslt304L=($jpslt304L==[])? 0: array_sum($jpslt304L);
                                          $tjkw304L=($jkw304L==[])? 0: array_sum($jkw304L);
                                          $tjbc304L=($jbc304L==[])? 0: array_sum($jbc304L);
                                          $tjs304L=($js304L==[])? 0: array_sum($js304L);
                                          $tjss304L=($jss304L==[])? 0: array_sum($jss304L);
                                          $tjwb304L=($jwb304L==[])? 0: array_sum($jwb304L);
                                          echo '
                                          <tr>
                                          <th>304L</th>
                                          <td>'.$tjmp304L.'</td>
                                          <td>'.$tjpslt304L.'</td>
                                          <td>'.$tjkw304L.'</td>
                                          <td>'.$tjbc304L.'</td>
                                          <td>'.$tjs304L.'</td>
                                          <td>'.$tjss304L.'</td>
                                          <td>'.$tjwb304L.'</td>
                                          <td>'.(($tjpslt304L==0)?0:number_format($tjpslt304L/$tjmp304L*100, 2, '.', '')).'%</td>
                                          </tr>';

                                          //316L
                                          ($tahun == "")?$total316L = mysqli_query($koneksi, "SELECT * FROM tbl_report where Grade = '316L'"):$total316L = mysqli_query($koneksi, "SELECT * FROM tbl_report where Grade = '316L' AND RIGHT(tanggal,4) = '$tahun'");
                                          $jmp316L=[];
                                          $jpslt316L=[];
                                          $jkw316L=[];
                                          $jbc316L=[];
                                          $js316L=[];
                                          $jss316L=[];
                                          $jwb316L=[];
                                          while ($h316L = mysqli_fetch_array($total316L)){
                                                $jmp316L[]=$h316L["Material_Processed"];
                                                $jpslt316L[]=$h316L["PRIME_SLT"];
                                                $jkw316L[]=$h316L["KW2"];
                                                $jbc316L[]=$h316L["BabyCoil"];
                                                $js316L[]=$h316L["Scrap"];
                                                $jss316L[]=$h316L["SS"];
                                                $jwb316L[]=$h316L["Weighing_Balance"];
                                          }
                                          $tjmp316L=($jmp316L==[])? 0: array_sum($jmp316L);
                                          $tjpslt316L=($jpslt316L==[])? 0: array_sum($jpslt316L);
                                          $tjkw316L=($jkw316L==[])? 0: array_sum($jkw316L);
                                          $tjbc316L=($jbc316L==[])? 0: array_sum($jbc316L);
                                          $tjs316L=($js316L==[])? 0: array_sum($js316L);
                                          $tjss316L=($jss316L==[])? 0: array_sum($jss316L);
                                          $tjwb316L=($jwb316L==[])? 0: array_sum($jwb316L);
                                          echo '
                                          <tr>
                                          <th>316L</th>
                                          <td>'.$tjmp316L.'</td>
                                          <td>'.$tjpslt316L.'</td>
                                          <td>'.$tjkw316L.'</td>
                                          <td>'.$tjbc316L.'</td>
                                          <td>'.$tjs316L.'</td>
                                          <td>'.$tjss316L.'</td>
                                          <td>'.$tjwb316L.'</td>
                                          <td>'.(($tjpslt316L==0)?0:number_format($tjpslt316L/$tjmp316L*100, 2, '.', '')).'%</td>
                                          </tr>';
                                          
                                          //301
                                          ($tahun == "")?$total301 = mysqli_query($koneksi, "SELECT * FROM tbl_report where Grade = '301'"):$total301 = mysqli_query($koneksi, "SELECT * FROM tbl_report where Grade = '301' AND RIGHT(tanggal,4) = '$tahun'");
                                          $jmp301=[];
                                          $jpslt301=[];
                                          $jkw301=[];
                                          $jbc301=[];
                                          $js301=[];
                                          $jss301=[];
                                          $jwb301=[];
                                          while ($h301 = mysqli_fetch_array($total301)){
                                                $jmp301[]=$h301["Material_Processed"];
                                                $jpslt301[]=$h301["PRIME_SLT"];
                                                $jkw301[]=$h301["KW2"];
                                                $jbc301[]=$h301["BabyCoil"];
                                                $js301[]=$h301["Scrap"];
                                                $jss301[]=$h301["SS"];
                                                $jwb301[]=$h301["Weighing_Balance"];
                                          }
                                          $tjmp301=($jmp301==[])? 0: array_sum($jmp301);
                                          $tjpslt301=($jpslt301==[])? 0: array_sum($jpslt301);
                                          $tjkw301=($jkw301==[])? 0: array_sum($jkw301);
                                          $tjbc301=($jbc301==[])? 0: array_sum($jbc301);
                                          $tjs301=($js301==[])? 0: array_sum($js301);
                                          $tjss301=($jss301==[])? 0: array_sum($jss301);
                                          $tjwb301=($jwb301==[])? 0: array_sum($jwb301);
                                          echo '
                                          <tr>
                                          <th>301</th>
                                          <td>'.$tjmp301.'</td>
                                          <td>'.$tjpslt301.'</td>
                                          <td>'.$tjkw301.'</td>
                                          <td>'.$tjbc301.'</td>
                                          <td>'.$tjs301.'</td>
                                          <td>'.$tjss301.'</td>
                                          <td>'.$tjwb301.'</td>
                                          <td>'.(($tjpslt301==0)?0:number_format($tjpslt301/$tjmp301*100, 2, '.', '')).'%</td>
                                          </tr>';

                                          //409L
                                          ($tahun == "")?$total409L = mysqli_query($koneksi, "SELECT * FROM tbl_report where Grade = '409L'"):$total409L = mysqli_query($koneksi, "SELECT * FROM tbl_report where Grade = '409L' AND RIGHT(tanggal,4) = '$tahun'");
                                          $jmp409L=[];
                                          $jpslt409L=[];
                                          $jkw409L=[];
                                          $jbc409L=[];
                                          $js409L=[];
                                          $jss409L=[];
                                          $jwb409L=[];
                                          while ($h409L = mysqli_fetch_array($total409L)){
                                                $jmp409L[]=$h409L["Material_Processed"];
                                                $jpslt409L[]=$h409L["PRIME_SLT"];
                                                $jkw409L[]=$h409L["KW2"];
                                                $jbc409L[]=$h409L["BabyCoil"];
                                                $js409L[]=$h409L["Scrap"];
                                                $jss409L[]=$h409L["SS"];
                                                $jwb409L[]=$h409L["Weighing_Balance"];
                                          }
                                          $tjmp409L=($jmp409L==[])? 0: array_sum($jmp409L);
                                          $tjpslt409L=($jpslt409L==[])? 0: array_sum($jpslt409L);
                                          $tjkw409L=($jkw409L==[])? 0: array_sum($jkw409L);
                                          $tjbc409L=($jbc409L==[])? 0: array_sum($jbc409L);
                                          $tjs409L=($js409L==[])? 0: array_sum($js409L);
                                          $tjss409L=($jss409L==[])? 0: array_sum($jss409L);
                                          $tjwb409L=($jwb409L==[])? 0: array_sum($jwb409L);
                                          echo '
                                          <tr>
                                          <th>409L</th>
                                          <td>'.$tjmp409L.'</td>
                                          <td>'.$tjpslt409L.'</td>
                                          <td>'.$tjkw409L.'</td>
                                          <td>'.$tjbc409L.'</td>
                                          <td>'.$tjs409L.'</td>
                                          <td>'.$tjss409L.'</td>
                                          <td>'.$tjwb409L.'</td>
                                          <td>'.(($tjpslt409L==0)?0:number_format($tjpslt409L/$tjmp409L*100, 2, '.', '')).'%</td>
                                          </tr>';

                                          //J1
                                          ($tahun == "")?$totalJ1 = mysqli_query($koneksi, "SELECT * FROM tbl_report where Grade = 'J1'"):$totalJ1 = mysqli_query($koneksi, "SELECT * FROM tbl_report where Grade = 'J1' AND RIGHT(tanggal,4) = '$tahun'");
                                          $jmpJ1=[];
                                          $jpsltJ1=[];
                                          $jkwJ1=[];
                                          $jbcJ1=[];
                                          $jsJ1=[];
                                          $jssJ1=[];
                                          $jwbJ1=[];
                                          while ($hJ1 = mysqli_fetch_array($totalJ1)){
                                                $jmpJ1[]=$hJ1["Material_Processed"];
                                                $jpsltJ1[]=$hJ1["PRIME_SLT"];
                                                $jkwJ1[]=$hJ1["KW2"];
                                                $jbcJ1[]=$hJ1["BabyCoil"];
                                                $jsJ1[]=$hJ1["Scrap"];
                                                $jssJ1[]=$hJ1["SS"];
                                                $jwbJ1[]=$hJ1["Weighing_Balance"];
                                          }
                                          $tjmpJ1=($jmpJ1==[])? 0: array_sum($jmpJ1);
                                          $tjpsltJ1=($jpsltJ1==[])? 0: array_sum($jpsltJ1);
                                          $tjkwJ1=($jkwJ1==[])? 0: array_sum($jkwJ1);
                                          $tjbcJ1=($jbcJ1==[])? 0: array_sum($jbcJ1);
                                          $tjsJ1=($jsJ1==[])? 0: array_sum($jsJ1);
                                          $tjssJ1=($jssJ1==[])? 0: array_sum($jssJ1);
                                          $tjwbJ1=($jwbJ1==[])? 0: array_sum($jwbJ1);
                                          echo '
                                          <tr>
                                          <th>J1</th>
                                          <td>'.$tjmpJ1.'</td>
                                          <td>'.$tjpsltJ1.'</td>
                                          <td>'.$tjkwJ1.'</td>
                                          <td>'.$tjbcJ1.'</td>
                                          <td>'.$tjsJ1.'</td>
                                          <td>'.$tjssJ1.'</td>
                                          <td>'.$tjwbJ1.'</td>
                                          <td>'.(($tjpsltJ1==0)?0:number_format($tjpsltJ1/$tjmpJ1*100, 2, '.', '')).'%</td>
                                          </tr>';

                                          //J2
                                          ($tahun == "")?$totalJ2 = mysqli_query($koneksi, "SELECT * FROM tbl_report where Grade = 'J2'"):$totalJ2 = mysqli_query($koneksi, "SELECT * FROM tbl_report where Grade = 'J2' AND RIGHT(tanggal,4) = '$tahun'");
                                          $jmpJ2=[];
                                          $jpsltJ2=[];
                                          $jkwJ2=[];
                                          $jbcJ2=[];
                                          $jsJ2=[];
                                          $jssJ2=[];
                                          $jwbJ2=[];
                                          while ($hJ2 = mysqli_fetch_array($totalJ2)){
                                                $jmpJ2[]=$hJ2["Material_Processed"];
                                                $jpsltJ2[]=$hJ2["PRIME_SLT"];
                                                $jkwJ2[]=$hJ2["KW2"];
                                                $jbcJ2[]=$hJ2["BabyCoil"];
                                                $jsJ2[]=$hJ2["Scrap"];
                                                $jssJ2[]=$hJ2["SS"];
                                                $jwbJ2[]=$hJ2["Weighing_Balance"];
                                          }
                                          $tjmpJ2=($jmpJ2==[])? 0: array_sum($jmpJ2);
                                          $tjpsltJ2=($jpsltJ2==[])? 0: array_sum($jpsltJ2);
                                          $tjkwJ2=($jkwJ2==[])? 0: array_sum($jkwJ2);
                                          $tjbcJ2=($jbcJ2==[])? 0: array_sum($jbcJ2);
                                          $tjsJ2=($jsJ2==[])? 0: array_sum($jsJ2);
                                          $tjssJ2=($jssJ2==[])? 0: array_sum($jssJ2);
                                          $tjwbJ2=($jwbJ2==[])? 0: array_sum($jwbJ2);
                                          echo '
                                          <tr>
                                          <th>J2</th>
                                          <td>'.$tjmpJ2.'</td>
                                          <td>'.$tjpsltJ2.'</td>
                                          <td>'.$tjkwJ2.'</td>
                                          <td>'.$tjbcJ2.'</td>
                                          <td>'.$tjsJ2.'</td>
                                          <td>'.$tjssJ2.'</td>
                                          <td>'.$tjwbJ2.'</td>
                                          <td>'.(($tjpsltJ2==0)?0:number_format($tjpsltJ2/$tjmpJ2*100, 2, '.', '')).'%</td>
                                          </tr>';

                                          //J3
                                          ($tahun == "")?$totalJ3 = mysqli_query($koneksi, "SELECT * FROM tbl_report where Grade = 'J3'"):$totalJ3 = mysqli_query($koneksi, "SELECT * FROM tbl_report where Grade = 'J3' AND RIGHT(tanggal,4) = '$tahun'");
                                          $jmpJ3=[];
                                          $jpsltJ3=[];
                                          $jkwJ3=[];
                                          $jbcJ3=[];
                                          $jsJ3=[];
                                          $jssJ3=[];
                                          $jwbJ3=[];
                                          while ($hJ3 = mysqli_fetch_array($totalJ3)){
                                                $jmpJ3[]=$hJ3["Material_Processed"];
                                                $jpsltJ3[]=$hJ3["PRIME_SLT"];
                                                $jkwJ3[]=$hJ3["KW2"];
                                                $jbcJ3[]=$hJ3["BabyCoil"];
                                                $jsJ3[]=$hJ3["Scrap"];
                                                $jssJ3[]=$hJ3["SS"];
                                                $jwbJ3[]=$hJ3["Weighing_Balance"];
                                          }
                                          $tjmpJ3=($jmpJ3==[])? 0: array_sum($jmpJ3);
                                          $tjpsltJ3=($jpsltJ3==[])? 0: array_sum($jpsltJ3);
                                          $tjkwJ3=($jkwJ3==[])? 0: array_sum($jkwJ3);
                                          $tjbcJ3=($jbcJ3==[])? 0: array_sum($jbcJ3);
                                          $tjsJ3=($jsJ3==[])? 0: array_sum($jsJ3);
                                          $tjssJ3=($jssJ3==[])? 0: array_sum($jssJ3);
                                          $tjwbJ3=($jwbJ3==[])? 0: array_sum($jwbJ3);
                                                echo '
                                          <tr>
                                          <th>J3</th>
                                          <td>' . $tjmpJ3 . '</td>
                                          <td>' . $tjpsltJ3 . '</td>
                                          <td>' . $tjkwJ3 . '</td>
                                          <td>' . $tjbcJ3 . '</td>
                                          <td>' . $tjsJ3 . '</td>
                                          <td>' . $tjssJ3 . '</td>
                                          <td>' . $tjwbJ3 . '</td>
                                          <td>'.(($tjpsltJ3==0)?0:number_format($tjpsltJ3/$tjmpJ3*100, 2, '.', '')).'%</td>                                    
                                          </tr>'
                                                ;    
                                                
                                          //J4
                                          ($tahun == "")?$totalJ4 = mysqli_query($koneksi, "SELECT * FROM tbl_report where Grade = 'J4'"):$totalJ4 = mysqli_query($koneksi, "SELECT * FROM tbl_report where Grade = 'J4' AND RIGHT(tanggal,4) = '$tahun'");
                                          $jmpJ4=[];
                                          $jpsltJ4=[];
                                          $jkwJ4=[];
                                          $jbcJ4=[];
                                          $jsJ4=[];
                                          $jssJ4=[];
                                          $jwbJ4=[];
                                          while ($hJ4 = mysqli_fetch_array($totalJ4)){
                                                $jmpJ4[]=$hJ4["Material_Processed"];
                                                $jpsltJ4[]=$hJ4["PRIME_SLT"];
                                                $jkwJ4[]=$hJ4["KW2"];
                                                $jbcJ4[]=$hJ4["BabyCoil"];
                                                $jsJ4[]=$hJ4["Scrap"];
                                                $jssJ4[]=$hJ4["SS"];
                                                $jwbJ4[]=$hJ4["Weighing_Balance"];
                                          }
                                          $tjmpJ4=($jmpJ4==[])? 0: array_sum($jmpJ4);
                                          $tjpsltJ4=($jpsltJ4==[])? 0: array_sum($jpsltJ4);
                                          $tjkwJ4=($jkwJ4==[])? 0: array_sum($jkwJ4);
                                          $tjbcJ4=($jbcJ4==[])? 0: array_sum($jbcJ4);
                                          $tjsJ4=($jsJ4==[])? 0: array_sum($jsJ4);
                                          $tjssJ4=($jssJ4==[])? 0: array_sum($jssJ4);
                                          $tjwbJ4=($jwbJ4==[])? 0: array_sum($jwbJ4);
                                          echo '
                                          <tr>
                                          <th>J4</th>
                                          <td>'.$tjmpJ4.'</td>
                                          <td>'.$tjpsltJ4.'</td>
                                          <td>'.$tjkwJ4.'</td>
                                          <td>'.$tjbcJ4.'</td>
                                          <td>'.$tjsJ4.'</td>
                                          <td>'.$tjssJ4.'</td>
                                          <td>'.$tjwbJ4.'</td>
                                          <td>'.(($tjpsltJ4==0)?0:number_format($tjpsltJ4/$tjmpJ4*100, 2, '.', '')).'%</td>
                                          </tr>';

                                          //410
                                          ($tahun == "")?$total410 = mysqli_query($koneksi, "SELECT * FROM tbl_report where Grade = '410'"):$total410 = mysqli_query($koneksi, "SELECT * FROM tbl_report where Grade = '410' AND RIGHT(tanggal,4) = '$tahun'");
                                          $jmp410=[];
                                          $jpslt410=[];
                                          $jkw410=[];
                                          $jbc410=[];
                                          $js410=[];
                                          $jss410=[];
                                          $jwb410=[];
                                          while ($h410 = mysqli_fetch_array($total410)){
                                                $jmp410[]=$h410["Material_Processed"];
                                                $jpslt410[]=$h410["PRIME_SLT"];
                                                $jkw410[]=$h410["KW2"];
                                                $jbc410[]=$h410["BabyCoil"];
                                                $js410[]=$h410["Scrap"];
                                                $jss410[]=$h410["SS"];
                                                $jwb410[]=$h410["Weighing_Balance"];
                                          }
                                          $tjmp410=($jmp410==[])? 0: array_sum($jmp410);
                                          $tjpslt410=($jpslt410==[])? 0: array_sum($jpslt410);
                                          $tjkw410=($jkw410==[])? 0: array_sum($jkw410);
                                          $tjbc410=($jbc410==[])? 0: array_sum($jbc410);
                                          $tjs410=($js410==[])? 0: array_sum($js410);
                                          $tjss410=($jss410==[])? 0: array_sum($jss410);
                                          $tjwb410=($jwb410==[])? 0: array_sum($jwb410);
                                          echo '
                                          <tr>
                                          <th>410</th>
                                          <td>'.$tjmp410.'</td>
                                          <td>'.$tjpslt410.'</td>
                                          <td>'.$tjkw410.'</td>
                                          <td>'.$tjbc410.'</td>
                                          <td>'.$tjs410.'</td>
                                          <td>'.$tjss410.'</td>
                                          <td>'.$tjwb410.'</td>
                                          <td>'.(($tjpslt410==0)?0:number_format($tjpslt410/$tjmp410*100, 2, '.', '')).'%</td>
                                          </tr>';

                                          //430
                                          ($tahun == "")?$total430 = mysqli_query($koneksi, "SELECT * FROM tbl_report where Grade = '430'"):$total430 = mysqli_query($koneksi, "SELECT * FROM tbl_report where Grade = '430' AND RIGHT(tanggal,4) = '$tahun'");
                                          $jmp430=[];
                                          $jpslt430=[];
                                          $jkw430=[];
                                          $jbc430=[];
                                          $js430=[];
                                          $jss430=[];
                                          $jwb430=[];
                                          while ($h430 = mysqli_fetch_array($total430)){
                                                $jmp430[]=$h430["Material_Processed"];
                                                $jpslt430[]=$h430["PRIME_SLT"];
                                                $jkw430[]=$h430["KW2"];
                                                $jbc430[]=$h430["BabyCoil"];
                                                $js430[]=$h430["Scrap"];
                                                $jss430[]=$h430["SS"];
                                                $jwb430[]=$h430["Weighing_Balance"];
                                          }
                                          $tjmp430=($jmp430==[])? 0: array_sum($jmp430);
                                          $tjpslt430=($jpslt430==[])? 0: array_sum($jpslt430);
                                          $tjkw430=($jkw430==[])? 0: array_sum($jkw430);
                                          $tjbc430=($jbc430==[])? 0: array_sum($jbc430);
                                          $tjs430=($js430==[])? 0: array_sum($js430);
                                          $tjss430=($jss430==[])? 0: array_sum($jss430);
                                          $tjwb430=($jwb430==[])? 0: array_sum($jwb430);
                                          echo '
                                          <tr>
                                          <th>430</th>
                                          <td>'.$tjmp430.'</td>
                                          <td>'.$tjpslt430.'</td>
                                          <td>'.$tjkw430.'</td>
                                          <td>'.$tjbc430.'</td>
                                          <td>'.$tjs430.'</td>
                                          <td>'.$tjss430.'</td>
                                          <td>'.$tjwb430.'</td>
                                          <td>'.(($tjpslt430==0)?0:number_format($tjpslt430/$tjmp430*100, 2, '.', '')).'%</td>
                                          </tr>';
                                          ?>
                                          </tbody>
                              </table>
                              </div>
                        </div>
                  </div>
            </div>
      </div>
</div>
</body>
</html>

