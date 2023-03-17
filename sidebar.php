<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>Yield Data Report</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="icon" href="img/IMR_ARC_STEEL3.png" type="image/png">
	<script src="https://code.jquery.com/jquery-1.10.2.min.js"></script>
    <script src='https://kit.fontawesome.com/a076d05399.js' crossorigin='anonymous'></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>
</head>
<body>
<div id="sidebar-wrapper">
    <ul class="sidebar-nav">
        <li class="sidebar-brand">
            <a href="index.php" class="text-left">
                <img src="img/IMR_ARC_STEEL.png" alt="logo" width="150px" height="90px">
            </a>
            <hr>
        </li>
        <li> 
            <a href="index.php" class="nav-link"> <span class="ms-2">Dashboard</span> </a> 
        </li>
        <li class="mb-1" style="background :#466d69;">
            <button class="collapsed border-0 text-white" style="background :#466d69;" data-bs-toggle="collapse" data-bs-target="#dashboard-collapse" aria-expanded="false">
            Raw Data Report
            </button>
            <div class="collapse bg-white" id="dashboard-collapse">
                <ul class="list-unstyled fw-normal pb-1 small">
                    <li><a href="import-excel.php" class="link-secondary rounded">Import Data Excel</a></li>
                    <li><a href="data-report-slt.php" class="link-secondary rounded">SLT Data Report</a></li>
                    <li><a href="data-report-bal.php" class="link-secondary rounded">BAL Data Report</a></li>
                </ul>
            </div>
        </li>
        <li> 
            <a href="data-report.php" class="nav-link"> <span class="ms-2">Main Data Report</span> </a> 
        </li>
        <li> 
            <a href="summaryperbulan.php" class="nav-link"> <span class="ms-2">Monthly Summary</span> </a> 
        <li> 
            <a href="summarypertahun.php" class="nav-link"> <span class="ms-2">Annualy Summary</span> </a> 
        </li>
        <li> 
            <a href="summaryytd.php" class="nav-link"> <span class="ms-2">Yield Performance</span> </a> 
        </li>
    </ul>
</div>




<style type="text/css">



#wrapper {
    padding-left: 0;
    -webkit-transition: all 0.5s ease;
    -moz-transition: all 0.5s ease;
    -o-transition: all 0.5s ease;
    transition: all 0.5s ease;
}

#wrapper.toggled {
    padding-left: 250px;
}

#sidebar-wrapper {
    z-index: 1000;
    position: fixed;
    left: 250px;
    width: 0;
    height: 100%;
    margin-left: -250px;
    overflow-y: auto;
    background: #515A5A;
    -webkit-transition: all 0.5s ease;
    -moz-transition: all 0.5s ease;
    -o-transition: all 0.5s ease;
    transition: all 0.5s ease;
    color: white;
}


#wrapper.toggled #sidebar-wrapper {
    width: 250px;
}

#page-content-wrapper {
    width: 100%;
    position: absolute;
    padding: 15px;
    
}

#wrapper.toggled #page-content-wrapper {
    position: absolute;
    margin-right: -250px;
}

/* Sidebar Styles */

.sidebar-nav {
    position: absolute;
    top: 0;
    width: 250px;
    margin: 0;
    padding: 0;
    list-style: none;
}

.sidebar-nav li {
    text-indent: 20px;
    line-height: 40px;
}

.sidebar-nav li a {
    display: block;
    text-decoration: none;
    color: #E9E8E8;
}

.sidebar-nav li a:hover {
    text-decoration: none;
}

.sidebar-nav li a:active,
.sidebar-nav li a:focus {
    text-decoration: none;
}

.sidebar-nav > .sidebar-brand {
    height: 100px;
    font-size: 18px;
    line-height: 60px;
}

.sidebar-nav > .sidebar-brand a {
    color: #999999;
}

.sidebar-nav > .sidebar-brand a:hover {
    color: #fff;
    background: none;
}

@media(min-width:768px) {
    #wrapper {
        padding-left: 250px;
    }

    #wrapper.toggled {
        padding-left: 0;
    }

    #sidebar-wrapper {
        width: 250px;
    }

    #wrapper.toggled #sidebar-wrapper {
        width: 0;
    }

    #page-content-wrapper {
        padding: 20px;
        position: relative;
    }

    #wrapper.toggled #page-content-wrapper {
        position: relative;
        margin-right: 0;
    }
}

#sidebar-wrapper li.active > a:after {
    border-right: 17px solid #f4f3ef;
    border-top: 17px solid transparent;
    border-bottom: 17px solid transparent;
    content: "";
    display: inline-block;
    position: absolute;
    right: -1px;
}

.sidebar-brand {
    border-bottom: 1px solid rgba(102, 97, 91, 0.3);
}

.sidebar-brand {
    margin: 20px;
}

.navbar .navbar-nav > li > a p {
    display: inline-block;
    margin: 0;
}
p {
    font-size: 16px;
    line-height: 1.4em;
}

.navbar-default {
    border:0px;
    border-bottom: 1px solid #DDDDDD;
}

btn-menu {
    border-radius: 3px;
    padding: 4px 12px;
    margin: 14px 5px 5px 20px;
    font-size: 14px;
    float: left;
}
</style>



<script type="text/javascript">




$(function(){
    $(".btn-toggle-menu").click(function() {
        $("#wrapper").toggleClass("toggled");
    });
})
</script>
</body>
</html>