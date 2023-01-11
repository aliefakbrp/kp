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
                        <form class="row g-4">
                            <div class="col-auto">
                                <input type="text" class="form-control" name="cari"  placeholder="Search">
                            </div>
                            <div class="col-auto">
                                <select class="form-control " name="bulan">
                                    <option value="">Bulan</option>
                                    <option value="01">Januari</option>
                                    <option value="02">Februari</option>
                                    <option value="03">Maret</option>
                                    <option value="04">April</option>
                                    <option value="05">Mei</option>
                                    <option value="06">Juni</option>
                                    <option value="07">Juli</option>
                                    <option value="08">Agustus</option>
                                    <option value="09">September</option>
                                    <option value="10">Oktober</option>
                                    <option value="12">November</option>
                                    <option value="12">Desember</option>
                                </select>
                            </div>
                            <div class="col-auto">
                                <select class="form-control" name="tahun">
                                    <?php
                                    $mulai= date('Y') - 50;
                                    for($i = $mulai;$i<$mulai + 100;$i++){
                                        $sel = $i == date('Y') ? ' selected="selected"' : '';
                                        echo '<option value="'.$i.'"'.$sel.'>'.$i.'</option>';
                                    }
                                    ?>
                                </select>
                            </div>
                            <div class="col-auto">
                                <input class="form-control btn btn-primary" type="submit" value="Cari">
                            </div>
                            <div class="col-auto">
                                <a href="data-report.php"><button class="form-control btn btn-secondary">Reset</button></a>
                            </div>
                        </form>
                        <br>
                        <div>
                            <a href="tambah-data-report.php"><button class="btn btn-success text-white ">Tambah</button></a> 
                        </div>
                        <br>
                        <table class="table table-hover">
                              <thead class="thead-light">
                                    <tr class="bg-secondary text-white">
                                        <th>No</th>
                                        <th>Seq</th>
                                        <th>Lot</th>
                                        <th>Coil_Number	</th>
                                        <th>Mother_Coil</th>
                                        <th>Grade</th>
                                        <th>Finish</th>
                                        <th>Thickness</th>
                                        <th>Width</th>	
                                        <th>Material_Processed</th>
                                        <th>PRIME_SLT</th>
                                        <th>KW2</th>
                                        <th>BabyCoil</th>
                                        <th>Scrap</th>
                                        <th>SS</th>
                                        <th>Weighing Balance</th>
                                    </tr>
                              </thead>
                              <tbody>
                                    <?php
                                    include "koneksi.php";

                                    $halaman = 10;
                                    $page	 = (isset($_GET['page']))? (int) $_GET['page'] : 1;
                                    $cari    = (isset($_GET['cari']))? $_GET['cari'] : "";
                                    $bulan    = (isset($_GET['bulan']))? $_GET['bulan'] : "";
                                    $tahun    = (isset($_GET['tahun']))? $_GET['tahun'] : "";
                                    $mulai   = ($page - 1) * $halaman;
                        
                                    // Pengkondisian untuk fungsi pencarian menu makanan
                                    if($cari=="" && $halaman==10){
                                        $data= mysqli_query($koneksi, "SELECT * FROM book2 LIMIT ".$mulai.",".$halaman);
                                    }else{
                                    //pengkondisian jika parameter kolom pencarian diisi
                                        $data = mysqli_query($koneksi, "SELECT * FROM book2 WHERE Coil_Number like '%".$cari."%' LIMIT ".$mulai.", ".$halaman);
                                        echo "<b>Hasil pencarian : ".$cari."</b>";
                                    }
                                    
                                    $no	=$mulai+1;
                                    while($tampil = mysqli_fetch_array($data)){
                                        echo '
                                        <tr>
                                            <td>'.$no.'</td>
                                            <td>'.$tampil['Seq'].'</td>
                                            <td>'.$tampil['Lot'].'</td>
                                            <td>'.$tampil['Coil_Number'].'</td>
                                            <td>'.$tampil['Mother_Coil'].'</td>
                                            <td>'.$tampil['Grade'].'</td>
                                            <td>'.$tampil['Finish'].'</td>
                                            <td>'.$tampil['Thickness'].'</td>
                                            <td>'.$tampil['Width'].'</td>
                                            <td>'.$tampil['Material_Processed'].'</td>
                                            <td>'.$tampil['PRIME_SLT'].'</td>
                                            <td>'.$tampil['KW2'].'</td>
                                            <td>'.$tampil['BabyCoil'].'</td>
                                            <td>'.$tampil['Scrap'].'</td>
                                            <td>'.$tampil['SS'].'</td>
                                            <td>'.$tampil['Weighing_Balance'].'</td>

                                        <tr>';
                                        $no++;
                                    }
                                    ?>
                              </tbody>
                        </table>

                        <div>
                            <ul class="pagination">
                                <!-- link Previous Page -->
                                <?php
                                    if($page == 1){ 
                                    ?>        
                                        <li class="page-item disabled"><a class="page-link" href="#">Previous</a></li>
                                    <?php
                                    }
                                    else{ 
                                    $LinkPrev = ($page > 1)? $page - 1 : 1;  

                                    if($cari=="" && $halaman==10){
                                    ?>
                                        <li class="page-item"><a class="page-link" href="data-report.php?page=<?php echo $LinkPrev; ?>">Previous</a></li>
                                    <?php     
                                    }
                                    else{
                                    ?> 
                                        <li class="page-item"><a class="page-link" href="data-report.php?cari=<?php echo $cari;?>&page=<?php echo $LinkPrev;?>&show=<?php echo $halaman;?>">Previous</a></li>
                                    <?php
                                    } 
                                    }
                                ?>

                                <!-- link Pencarian -->
                                <?php
                                    
                                    if($cari=="" && $halaman==10){
                                        $data= mysqli_query($koneksi, "SELECT * FROM book2");
                                    }else{
                                        $data = mysqli_query($koneksi, "SELECT * FROM book2 WHERE Coil_Number like '%".$cari."%'");
                                    }   
                                
                                    $JumlahData = mysqli_num_rows($data);
                                    $jumlahPage = ceil($JumlahData / $halaman); 
                                    $jumlahNumber = 1; 
                                    $startNumber = ($page > $jumlahNumber)? $page - $jumlahNumber : 1; 
                                    $endNumber = ($page < ($jumlahPage - $jumlahNumber))? $page + $jumlahNumber : $jumlahPage; 
                                    
                                    for($i = $startNumber; $i <= $endNumber; $i++){
                                    $linkActive = ($page == $i)? ' class="active"' : '';

                                    if($cari=="" && $halaman==10 ){
                                    ?>
                                        <li class="page-item" <?php echo $linkActive; ?>><a class="page-link" href="data-report.php?page=<?php echo $i; ?>&show=<?php echo $halaman;?>"><?php echo $i; ?></a></li>

                                    <?php
                                    }
                                    else{
                                    ?>
                                        <li class="page-item" <?php echo $linkActive; ?>><a class="page-link" href="data-report.php?cari=<?php echo $cari;?>&page=<?php echo $i; ?>&show=<?php echo $halaman;?>"><?php echo $i; ?></a></li>
                                    <?php
                                    }
                                }
                                ?>
                                
                                <!-- link Next Page -->
                                <?php       
                                if($page == $jumlahPage){ 
                                ?>
                                    <li class="page-item disabled"><a class="page-link" href="#">Next</a></li>
                                <?php
                                }
                                else{
                                    $linkNext = ($page < $jumlahPage)? $page + 1 : $jumlahPage;
                                if($cari=="" && $halaman==10){
                                    ?>
                                        <li class="page-item"><a class="page-link" href="data-report.php?page=<?php echo $linkNext; ?>&show=<?php echo $halaman;?>">Next</a></li>
                                <?php     
                                    }else{
                                    ?> 
                                    <li class="page-item"><a class="page-link" href="data-report.php?cari=<?php echo $cari;?>&page=<?php echo $linkNext; ?>&show=<?php echo $halaman;?>">Next</a></li>
                                <?php
                                    }
                                }
                                ?>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>




