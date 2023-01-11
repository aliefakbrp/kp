<div id="wrapper" class="wrapper-content">
    <?php
        include "sidebar1.php"
    ?>
    <div id="page-content-wrapper">
        <nav class="navbar navbar-default">
            <div class="container">
                <div class="navbar-header">
                    <button class="btn-menu btn btn-toggle-menu" type="button" style="background :#138D75; color:#E9E8E8;"><i class='fas fa-bars'></i>
                    </button>
                </div>
            </div>
        </nav>
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                     <div class="container">
                     <h1 class="text-center font-weight-bold" style = "color: #565757;">Quality Yeild Report</h1>
                        <br>
                        </div>
                        <table class="table table-hover">
                              <thead class="thead-light">
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
                                    include "koneksi.php";
                                    // $pilihan = "304L";
                                    $total = mysqli_query($koneksi, 'SELECT * FROM book2');
                                    while ($ttampil = mysqli_fetch_array($total)){
                                          $jmp[]=$ttampil["Material_Processed"];
                                          $jpslt[]=$ttampil["PRIME_SLT"];
                                          $jkw2[]=$ttampil["KW2"];
                                          $jbc[]=$ttampil["BabyCoil"];
                                          $js[]=$ttampil["Scrap"];
                                          $jss[]=$ttampil["SS"];
                                          $jwb[]=$ttampil["Weighing_Balance"];
                                    }
                                    $tjmp = array_sum($jmp);
                                    $tjpslt = array_sum($jpslt);
                                    $tjkw2 = array_sum($jkw2);
                                    $tjbc = array_sum($jbc);
                                    $tjs = array_sum($js);
                                    $tjss = array_sum($jss);
                                    $tjwb = array_sum($jwb);                                   
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
                                    <td>'.($tjpslt/$tjmp*100).'%</td>
                                    </tr>';
                                    
                                    $total304 = mysqli_query($koneksi, 'SELECT * FROM book2 where Grade = "304"');
                                    while ($h = mysqli_fetch_array($total304)){
                                          $jmp304[]=$h["Material_Processed"];
                                          $jpslt304[]=$h["PRIME_SLT"];
                                          $jkw304[]=$h["KW2"];
                                          $jbc304[]=$h["BabyCoil"];
                                          $js304[]=$h["Scrap"];
                                          $jss304[]=$h["SS"];
                                          $jwb304[]=$h["Weighing_Balance"];
                                    }
                                    $tjmp304 = array_sum($jmp304);
                                    $tjpslt304 = array_sum($jpslt304);
                                    $tjkw304 = array_sum($jkw304);
                                    $tjbc304 = array_sum($jbc304);
                                    $tjs304 = array_sum($js304);
                                    $tjss304 = array_sum($jss304);
                                    $tjwb304 = array_sum($jwb304);                                   
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
                                    <td>'.($tjpslt304/$tjmp304*100).'%</td>
                                    </tr>';

                                    $total304L = mysqli_query($koneksi, 'SELECT * FROM book2 where Grade = "304L"');
                                    while ($h = mysqli_fetch_array($total304L)){
                                          $jmp304L[]=$h["Material_Processed"];
                                          $jpslt304L[]=$h["PRIME_SLT"];
                                          $jkw304L[]=$h["KW2"];
                                          $jbc304L[]=$h["BabyCoil"];
                                          $js304L[]=$h["Scrap"];
                                          $jss304L[]=$h["SS"];
                                          $jwb304L[]=$h["Weighing_Balance"];
                                    }
                                    $tjmp304L = array_sum($jmp304L);
                                    $tjpslt304L = array_sum($jpslt304L);
                                    $tjkw304L = array_sum($jkw304L);
                                    $tjbc304L = array_sum($jbc304L);
                                    $tjs304L = array_sum($js304L);
                                    $tjss304L = array_sum($jss304L);
                                    $tjwb304L = array_sum($jwb304L); 

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
                                    <td>'.($tjpslt304L/$tjmp304L*100).'%</td>
                                    </tr>';
                                    $total304304L = mysqli_query($koneksi, 'SELECT * FROM book2 where Grade = "304/304L"');
                                    while ($h = mysqli_fetch_array($total304304L)){
                                          $jmp304304L[]=$h["Material_Processed"];
                                          $jpslt304304L[]=$h["PRIME_SLT"];
                                          $jkw304304L[]=$h["KW2"];
                                          $jbc304304L[]=$h["BabyCoil"];
                                          $js304304L[]=$h["Scrap"];
                                          $jss304304L[]=$h["SS"];
                                          $jwb304304L[]=$h["Weighing_Balance"];
                                    }
                                    $tjmp304304L = array_sum($jmp304304L);
                                    $tjpslt304304L = array_sum($jpslt304304L);
                                    $tjkw304304L = array_sum($jkw304304L);
                                    $tjbc304304L = array_sum($jbc304304L);
                                    $tjs304304L = array_sum($js304304L);
                                    $tjss304304L = array_sum($jss304304L);
                                    $tjwb304304L = array_sum($jwb304304L);                                   
                                    echo '
                                    <tr>
                                    <th>304/304L</th>
                                    <td>'.$tjmp304304L.'</td>
                                    <td>'.$tjpslt304304L.'</td>
                                    <td>'.$tjkw304304L.'</td>
                                    <td>'.$tjbc304304L.'</td>
                                    <td>'.$tjs304304L.'</td>
                                    <td>'.$tjss304304L.'</td>
                                    <td>'.$tjwb304304L.'</td>
                                    <td>'.($tjpslt304304L/$tjmp304304L*100).'%</td>
                                    </tr>';

                                    $totalJ1 = mysqli_query($koneksi, 'SELECT * FROM book2 where Grade = "J1"');
                                    while ($h = mysqli_fetch_array($totalJ1)){
                                          $jmpJ1[]=$h["Material_Processed"];
                                          $jpsltJ1[]=$h["PRIME_SLT"];
                                          $jkwJ1[]=$h["KW2"];
                                          $jbcJ1[]=$h["BabyCoil"];
                                          $jsJ1[]=$h["Scrap"];
                                          $jssJ1[]=$h["SS"];
                                          $jwbJ1[]=$h["Weighing_Balance"];
                                    }
                                    $tjmpJ1 = array_sum($jmpJ1);
                                    $tjpsltJ1 = array_sum($jpsltJ1);
                                    $tjkwJ1 = array_sum($jkwJ1);
                                    $tjbcJ1 = array_sum($jbcJ1);
                                    $tjsJ1 = array_sum($jsJ1);
                                    $tjssJ1 = array_sum($jssJ1);
                                    $tjwbJ1 = array_sum($jwbJ1);                                   
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
                                    <td>'.($tjpsltJ1/$tjmpJ1*100).'%</td>
                                    </tr>';

                                    $totalJ3 = mysqli_query($koneksi, 'SELECT * FROM book2 where Grade = "J3"');
                                    while ($h = mysqli_fetch_array($totalJ3)){
                                          $jmpJ3[]=$h["Material_Processed"];
                                          $jpsltJ3[]=$h["PRIME_SLT"];
                                          $jkwJ3[]=$h["KW2"];
                                          $jbcJ3[]=$h["BabyCoil"];
                                          $jsJ3[]=$h["Scrap"];
                                          $jssJ3[]=$h["SS"];
                                          $jwbJ3[]=$h["Weighing_Balance"];
                                    }
                                    $tjmpJ3 = array_sum($jmpJ3);
                                    $tjpsltJ3 = array_sum($jpsltJ3);
                                    $tjkwJ3 = array_sum($jkwJ3);
                                    $tjbcJ3 = array_sum($jbcJ3);
                                    $tjsJ3 = array_sum($jsJ3);
                                    $tjssJ3 = array_sum($jssJ3);
                                    $tjwbJ3 = array_sum($jwbJ3);                                   
                                    echo '
                                    <tr>
                                    <th>J3</th>
                                    <td>'.$tjmpJ3.'</td>
                                    <td>'.$tjpsltJ3.'</td>
                                    <td>'.$tjkwJ3.'</td>
                                    <td>'.$tjbcJ3.'</td>
                                    <td>'.$tjsJ3.'</td>
                                    <td>'.$tjssJ3.'</td>
                                    <td>'.$tjwbJ3.'</td>
                                    <td>'.($tjpsltJ3/$tjmpJ3*100).'%</td>
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
