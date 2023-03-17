<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
    <title>Main Data Report</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="icon" href="img/IMR_ARC_STEEL3.png" type="image/png">
    <script src="https://code.jquery.com/jquery-1.10.2.min.js"></script>
    <script src='https://kit.fontawesome.com/a076d05399.js' crossorigin='anonymous'></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>
    <link rel="stylesheet" type="text/css" href="DataTables/DataTables-1.13.2/css/dataTables.bootstrap5.min.css">
    <link rel="stylesheet" type="text/css" href="DataTables/Buttons-2.3.4/css/buttons.bootstrap5.min.css">
    
    
</head>
<body sty>
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
            <br>
            <div class="container">
                  <div class="row">
                        <div class="col-lg-12">
                              <div class="container">
                                    <h1 class="text-center font-weight-bold" style="color: #565757;">Main Data Report</h1>
                                    <br>
                                    <div style="overflow-x : auto;">
                                          <div class="container">
                                                <div class="row g-4">
                                                      <div class="col-auto">
                                                            <a href="data-report-perbulan.php"><button class=" btn btn-warning text-white">Data Report Permonth</button></a>
                                                      </div>
                                                </div>
                                                <br>
                                                <table id="example" class="table table-bordered table-hover">
                                                      <thead class="bg-secondary text-white">
                                                            <tr>
                                                            <th>No</th>
                                                            <th>Seq No</th>
                                                            <th>Lot</th>
                                                            <th>Coil Number</th>
                                                            <th>Mother Coil</th>
                                                            <th>Grade</th>
                                                            <th>Finish</th>
                                                            <th>Thickness</th>
                                                            <th>Width</th>
                                                            <th>Material Processed</th>
                                                            <th>PRIME SLT</th>
                                                            <th>KW2</th>
                                                            <th>BabyCoil</th>
                                                            <th>Scrap</th>
                                                            <th>SS</th>
                                                            <th>Weighing Balance</th>
                                                            <th>Tanggal</th>
                                                            </tr>
                                                      </thead>
                                                      <tbody>
                                                            <?php
                                                            include  'database/koneksi.php';
                                                            $query = "SELECT * FROM tbl_report";
                                                            $sql = mysqli_query($koneksi,$query);
                                                            $no	= 1;
                                                            while ($row = mysqli_fetch_array($sql)) {
                                                            ?>
                                                            <tr>
                                                            <td><?php echo $no ?></td>
                                                            <td><?php echo $row['Seq'] ?></td>
                                                            <td><?php echo $row['Lot'] ?></td>
                                                            <td><?php echo $row['Coil_Number'] ?></td>
                                                            <td><?php echo $row['Mother_Coil'] ?></td>
                                                            <td><?php echo $row['Grade'] ?></td>
                                                            <td><?php echo $row['Finish'] ?></td>
                                                            <td><?php echo $row['Thickness'] ?></td>
                                                            <td><?php echo $row['Width'] ?></td>
                                                            <td><?php echo $row['Material_Processed'] ?></td>
                                                            <td><?php echo $row['PRIME_SLT'] ?></td>
                                                            <td><?php echo $row['KW2'] ?></td>
                                                            <td><?php echo $row['BabyCoil'] ?></td>
                                                            <td><?php echo $row['Scrap'] ?></td>
                                                            <td><?php echo $row['SS'] ?></td>
                                                            <td><?php echo $row['Weighing_Balance'] ?></td>
                                                            <td><?php echo $row['tanggal'] ?></td>
                                                            </tr>  
                                                            <?php 
                                                            $no++; 
                                                            }?>        
                                                      </tbody>
                                                </table>
                                          </div>
                                    </div>
                              </div>
                        </div>
                  </div>
            </div>
      </div>
</div>     
<script src="DataTables/datatables.min.js"></script>
<script src="DataTables/DataTables-1.13.2/js/dataTables.bootstrap5.min.js"></script>
<script src="DataTables/Buttons-2.3.4/js/buttons.bootstrap5.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
<script src="https://cdn.datatables.net/buttons/2.3.4/js/buttons.html5.min.js"></script>
<script src="https://cdn.datatables.net/buttons/2.3.4/js/buttons.print.min.js"></script>


<script type="text/javascript">
    $(document).ready(function () {
        var table = $('#example').DataTable({
            select: true,
            dom: 'Blfrtip',
            lengthMenu: [
                [10, 25, 50, -1],
                ['10 Records', '25 Records', '50 Records', 'All Records']
            ],
            dom: 'Bfrtip',
            buttons: [
                { extend: 'copy'},
                { extend: 'excel'},
                { extend: 'print'},
                'pageLength'
            ],
        });
        table.buttons().container()
            .appendTo('#example_wrapper .col-md-6:eq(0)');
    });
</script>
</body>
</html>