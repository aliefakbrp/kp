<div id="wrapper" class="wrapper-content">
    <?php
        include "sidebar1.php"
    ?>
    <div id="page-content-wrapper">
        <nav class="navbar navbar-default">
            <div class="container-fluid">
                <div class="navbar-header">
                    <button class="btn-menu btn btn-success btn-toggle-menu" type="button">
                        <i class="fa fa-bars"></i>
                    </button>
                </div>
            </div>
        </nav>
        <div class="container">
            <h1 class="text-center font-weight-bold" style = "color: #565757;">Quality Yeild Report</h1>
            <br>
            <form class="form-inline" action='data-report.php' method="get">
                <div class="form-group">
                    <input class= "mx-sm-1" type="text" name="cari">
                    <input class="btn btn-primary" type="submit" value="Cari">
                    <a href="data-report.php"><button class="btn btn-info">Reset</button></a>
                </div>
                
            </form>
            <br>
            <div>
                <a href="tambah-data-report.php"><button class="btn btn-success text-white ">Tambah</button></a> 
            </div>
            <br>
        </div>
    </div>
</div>

            <