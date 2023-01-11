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
                        <br>
                        <div class="container" style="margin-top: 2rem; margin-bottom: 1rem;"> 
                            <div class="row justify-content-center">
                                <div class="col-7">
                                    <div class="card mt-4">
                                        <div class="card-body">
                                            <form class="form" method="POST" action="">
                                                <h1 class="card-title">Tambah Data</h1>
                                                <div class="form-group">
                                                    <label>Seq No :</label>
                                                    <input type="number" class="form-control" name="Seq" required/>
                                                </div>
                                                <div class="form-group">
                                                    <label>Lot :</label>
                                                    <input type="number" class="form-control" name="Lot" required/>
                                                </div>
                                                <div class="form-group">
                                                    <label>Coil Number :</label>
                                                    <input type="text" class="form-control" name="Coil_Number" required/>
                                                </div>
                                                <div class="form-group">
                                                    <label>Mother Coil :</label>
                                                    <input type="text" class="form-control" name="Mother_Coil" required/>
                                                </div>
                                                <div class="form-group">
                                                    <label>Grade :</label>
                                                    <input type="text" class="form-control" name="Grade" required/>
                                                </div>
                                                <div class="form-group">
                                                    <label>Finish :</label>
                                                    <input type="text" class="form-control" name="Finish" required/>
                                                </div>
                                                <div class="form-group">
                                                    <label>Thickness :</label>
                                                    <input type="text" class="form-control" name="Thickness" required/>
                                                </div>
                                                <div class="form-group">
                                                    <label>Width :</label>
                                                    <input type="text" class="form-control" name="Width" required/>
                                                </div>
                                                <div class="form-group">
                                                    <label>Material Processed :</label>
                                                    <input type="text" class="form-control" name="Material_Processed" required/>
                                                </div>
                                                <div class="form-group">
                                                    <label>PRIME (SLT) :</label>
                                                    <input type="text" class="form-control" name="PRIME_SLT" required/>
                                                </div>
                                                <div class="form-group">
                                                    <label>KW2 :</label>
                                                    <input type="text" class="form-control" name="KW2" required/>
                                                </div>
                                                <div class="form-group">
                                                    <label>Baby Coil :</label>
                                                    <input type="text" class="form-control" name="BabyCoil" required/>
                                                </div>
                                                <div class="form-group">
                                                    <label>Scrap :</label>
                                                    <input type="text" class="form-control" name="Scrap" required/>
                                                </div>
                                                <div class="form-group">
                                                    <label>SS :</label>
                                                    <input type="text" class="form-control" name="SS" required/>
                                                </div>
                                                <div class="form-group">
                                                    <label>Weighing Balance :</label>
                                                    <input type="text" class="form-control" name="Weighing_sBalance" required/>
                                                </div>
                                                <div class="form-group">
                                                    <label>Tanggal :</label>
                                                    <input type="datetime-local" class="form-control" name="tanggal" required/>
                                                </div>
                                                <br>
                                                <div>
                                                    <input type="submit" class="btn btn-success" name="submit" value="Submit"/>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <?php
                                include 'koneksi.php'
                                if(isset($_POST['submit'])){
                                    $Seq		                = $_POST['Seq'];
                                    $Lot		                = $_POST['Lot'];
                                    $Coil_Number                = $_POST['Coil_Number'];
                                    $Mother_Coil                = $_POST['Mother_Coil'];
                                    $Grade		                = $_POST['Grade'];
                                    $Finish		                = $_POST['Finish'];
                                    $Thickness		            = $_POST['Thickness'];
                                    $Width		                = $_POST['Width'];
                                    $Matrial_Processed		    = $_POST['Matrial_Processed'];
                                    $PRIME_SLT                  = $_POST['PRIME_SLT'];
                                    $KW2		                = $_POST['KW2'];
                                    $BabyCoil		            = $_POST['BabyCoil'];
                                    $Scrap		                = $_POST['Scrap'];
                                    $SS		                    = $_POST['SS'];
                                    $Weighing_Balance		    = $_POST['Weighing_Balance'];
                                    $tanggal		            = $_POST['tanggal'];


                                    $cek = mysqli_query($koneksi, "SELECT * FROM book2 WHERE Seq='$Seq'") or die(mysqli_error($koneksi));

                                    if(mysqli_num_rows($cek) == 0){
                                        $sql = mysqli_query($koneksi, "INSERT INTO book2 (Seq,Lot,Coil_Number,Mother_Coil,Grade,Finish,Thickness,Width,Material_Processed,PRIME_SLT,KW2,BabyCoil,Scrap,SS,Weighing_Balance,tanggal) VALUES('$Seq', '$Lot', '$Coil_Number', '$Mother_Coil','$Grade', '$Finish','$Thickness','$Width','$Material_Processed','$PRIME_SLT','$KW2','$BabyCoil','$Scrap','$SS','$Weighing_Balance','tanggal')") or die(mysqli_error($koneksi));
                                        if($sql){
                                            echo '<script>alert("Berhasil menambahkan data."); document.location="data-report.php";</script>';
                                        }else{
                                            echo '<div class="alert alert-warning">Gagal melakukan proses tambah data.</div>';
                                        }
                                    }else{
                                        echo '<div class="alert alert-warning">Gagal, ID menu sudah terdaftar.</div>';
                                    }
                                }
                            ?>
                        </div>
                     </div>
                </div>
            </div>
        </div>
    </div>
</div>