<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>BAL Data Report</title>
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
            <div class="container">
                  <div class="row">
                        <div class="col-lg-12">
                              <div class="container">
                                    <h1 class="text-center font-weight-bold" style="color: #565757;">BAL Data Report</h1>
                                    <br>
                                    <div style="overflow-x : auto;">
                                          <div class="container">
                                                <div class="row g-4">
                                                      <div class="col-auto">
                                                            <a href="data-report-bal-perbulan.php"><button class=" btn btn-warning text-white">BAL Data Report Permonth</button></a>
                                                      </div>
                                                </div>
                                                <br>
                                                <table id="example" class="table table-bordered table-hover">
                                                      <thead class="bg-secondary text-white">
                                                            <tr>
                                                            <th>No</th>
                                                            <th>LOT</th>
                                                            <th>ITEM_CODE</th>
                                                            <th>MACHINE</th>
                                                            <th>NEXT_PROSES</th>
                                                            <th>SUPPLIER_COIL_NO</th>
                                                            <th>IMR_COIL_NO</th>
                                                            <th>GRADE</th>
                                                            <th>FINISH</th>
                                                            <th>FROM_THICK</th>
                                                            <th>TO_THICK</th>
                                                            <th>ACT_THICK_MIN</th>
                                                            <th>ACT_THICK_MAX</th>
                                                            <th>WIDTH</th>
                                                            <th>WEIGHT</th>
                                                            <th>OUTPUT_WEIGHT</th>
                                                            <th>BABY_COIL</th>
                                                            <th>SCRAP_SHEET</th>
                                                            <th>SALES_CONTRAK</th>
                                                            <th>CUSTOMER_NAME</th>
                                                            <th>CPL</th>
                                                            <th>MILL</th>
                                                            <th>BAL</th>
                                                            <th>SLT</th>
                                                            <th>CTL</th>
                                                            <th>REMARK_PPC</th>
                                                            <th>SUPPLIER</th>
                                                            <th>INVOICE</th>
                                                            <th>DATE_INVOICE</th>
                                                            <th>DATE_INCOMING</th>
                                                            <th>DATE_ROLL</th>
                                                            <th>TODAY</th>
                                                            <th>WIP_AGING</th>
                                                            <th>RM_AGING</th>
                                                            <th>CONTAINER_NO</th>
                                                            <th>HEAT_NO</th>
                                                            <th>NET_WEIGHT_INCOMING</th>
                                                            <th>GROSS_INCOMING</th>
                                                            <th>NETT_IMR</th>
                                                            <th>GROSS_IMR</th>
                                                            <th>PERIODE</th>
                                                            </tr>
                                                      </thead>
                                                      <tbody>
                                                            <?php
                                                            include  'database/koneksi.php';
                                                            $query = "SELECT * FROM bal";
                                                            $sql = mysqli_query($koneksi,$query);
                                                            $no	= 1;
                                                            while ($row = mysqli_fetch_array($sql)) {
                                                            ?>
                                                            <tr>
                                                            <td><?php echo $no ?></td>
                                                            <td><?php echo $row['LOT'] ?></td>
                                                            <td><?php echo $row['ITEM_CODE']?></td>
                                                            <td><?php echo $row['MACHINE']?></td>
                                                            <td><?php echo $row['NEXT_PROSES']?></td>
                                                            <td><?php echo $row['SUPPLIER_COIL_NO']?></td>
                                                            <td><?php echo $row['IMR_COIL_NO']?></td>
                                                            <td><?php echo $row['GRADE']?></td>
                                                            <td><?php echo $row['FINISH']?></td>
                                                            <td><?php echo $row['FROM_THICK']?></td>
                                                            <td><?php echo $row['TO_THICK']?></td>
                                                            <td><?php echo $row['ACT_THICK_MIN']?></td>
                                                            <td><?php echo $row['ACT_THICK_MAX']?></td>
                                                            <td><?php echo $row['WIDTH']?></td>
                                                            <td><?php echo $row['WEIGHT']?></td>
                                                            <td><?php echo $row['OUTPUT_WEIGHT']?></td>
                                                            <td><?php echo $row['BABY_COIL']?></td>
                                                            <td><?php echo $row['SCRAP_SHEET']?></td>
                                                            <td><?php echo $row['SALES_CONTRAK']?></td>
                                                            <td><?php echo $row['CUSTOMER_NAME']?></td>
                                                            <td><?php echo $row['PROSES_CPL']?></td>
                                                            <td><?php echo $row['PROSES_MILL']?></td>
                                                            <td><?php echo $row['PROSES_BAL']?></td>
                                                            <td><?php echo $row['PROSES_SLT']?></td>
                                                            <td><?php echo $row['PROSES_CTL']?></td>
                                                            <td><?php echo $row['REMARK_PPC']?></td>
                                                            <td><?php echo $row['SUPPLIER']?></td>
                                                            <td><?php echo $row['INVOICE']?></td>
                                                            <td><?php echo $row['DATE_INVOICE']?></td>
                                                            <td><?php echo $row['DATE_INCOMING']?></td>
                                                            <td><?php echo $row['DATE_ROLL']?></td>
                                                            <td><?php echo $row['TODAY']?></td>
                                                            <td><?php echo $row['WIP_AGING']?></td>
                                                            <td><?php echo $row['RM_AGING']?></td>
                                                            <td><?php echo $row['CONTAINER_NO']?></td>
                                                            <td><?php echo $row['HEAT_NO']?></td>
                                                            <td><?php echo $row['NET_WEIGHT_INCOMING']?></td>
                                                            <td><?php echo $row['GROSS_INCOMING']?></td>
                                                            <td><?php echo $row['NETT_IMR']?></td>
                                                            <td><?php echo $row['GROSS_IMR']?>d</td>
                                                            <td><?php echo $row['periode']?></td>
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