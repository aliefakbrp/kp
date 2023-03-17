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
<?php
use Phppot\DataSource;
use PhpOffice\PhpSpreadsheet\Reader\Xlsx;

use function PHPSTORM_META\type;

require 'DataSource.php';
$db = new DataSource();
$conn = $db->getConnection();
require_once ('./vendor/autoload.php');


if (isset($_POST["import"])){
    
    $allowedFileType = [
        'application/vnd.ms-excel',
        'text/xls',
        'text/xlsx',
        'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet'
    ];

    if (in_array($_FILES["file"]["type"], $allowedFileType)) {

        $targetPath = 'uploads/' . $_FILES['file']['name'];
        move_uploaded_file($_FILES['file']['tmp_name'], $targetPath);

        $Reader = new \PhpOffice\PhpSpreadsheet\Reader\Xlsx();
        $spreadSheetbal = $Reader->load($targetPath);
        $spreadSheetbal = $spreadSheetbal->setActiveSheetIndexByName('BAL');
        $spreadSheetArybal = $spreadSheetbal->toArray();
        $sheetCountbal = count($spreadSheetArybal);
        
        $Readerslt = new \PhpOffice\PhpSpreadsheet\Reader\Xlsx();
        $spreadSheet = $Readerslt->load($targetPath);
        $spreadSheet = $spreadSheet->setActiveSheetIndexByName('SLT');
        $spreadSheetAry = $spreadSheet->toArray();
        $sheetCount = count($spreadSheetAry);
        
        
        $Reader = new \PhpOffice\PhpSpreadsheet\Reader\Xlsx();
        $spreadSheetbal2 = $Reader->load($targetPath);
        $spreadSheetbal2 = $spreadSheetbal2->setActiveSheetIndexByName('BAL 2');
        $spreadSheetArybal2 = $spreadSheetbal2->toArray();
        $sheetCountbal2 = count($spreadSheetArybal2);
        
        $Readerslt2 = new \PhpOffice\PhpSpreadsheet\Reader\Xlsx();
        $spreadSheet2 = $Readerslt2->load($targetPath);
        $spreadSheet2 = $spreadSheet2->setActiveSheetIndexByName('SLT 2');
        $spreadSheetAry2 = $spreadSheet2->toArray();
        $sheetCount2 = count($spreadSheetAry2);
        $slt = [];
        $bal = [];
        // UPLOAD BAL
        for ($i = 3; $i < $sheetCountbal; $i++) {
            $LOT = '';
            if (isset($spreadSheetArybal[$i][0])) {
                $LOT = mysqli_real_escape_string($conn, $spreadSheetArybal[$i][0]);
            }
            $ITEM_CODE = '';
            if (isset($spreadSheetArybal[$i][1])) {
                $ITEM_CODE = mysqli_real_escape_string($conn, $spreadSheetArybal[$i][1]);
                $a = explode("-", $ITEM_CODE, 3);
                $b = substr($a[2], 0, 4);
                $c = floatval($b);
                $d = "";
                if ($c < 0.5) {
                    $d = "000";
                } elseif ($c <= 1) {
                    $d = "001";
                } elseif ($c < 1.5) {
                    $d = "001";
                } elseif ($c <= 2) {
                    $d = "002";
                } elseif ($c < 2.5) {
                    $d = "002";
                } else {
                    $d = "003";
                }
                // $e=explode("-",$OriginalString,3);
                $e = substr($a[2], 4);
                $ITEM_CODE = $a[0] . "-" . $a[1] . "-" . $d . $e;
            }
            $MACHINE = '';
            if (isset($spreadSheetArybal[$i][2])) {
                $MACHINE = mysqli_real_escape_string($conn, $spreadSheetArybal[$i][2]);
            }
            $NEXT_PROSES = '';
            if (isset($spreadSheetArybal[$i][3])) {
                $NEXT_PROSES = mysqli_real_escape_string($conn, $spreadSheetArybal[$i][3]);
            }
            $SUPPLIER_COIL_NO = '';
            if (isset($spreadSheetArybal[$i][4])) {
                $SUPPLIER_COIL_NO = mysqli_real_escape_string($conn, $spreadSheetArybal[$i][4]);
            }
            $IMR_COIL_NO = '';
            if (isset($spreadSheetArybal[$i][5])) {
                $IMR_COIL_NO = mysqli_real_escape_string($conn, $spreadSheetArybal[$i][5]);
            }
            $GRADE = '';
            if (isset($spreadSheetArybal[$i][6])) {
                $GRADE = mysqli_real_escape_string($conn, $spreadSheetArybal[$i][6]);
            }
            $FINISH = '';
            if (isset($spreadSheetArybal[$i][7])) {
                $FINISH = mysqli_real_escape_string($conn, $spreadSheetArybal[$i][7]);
            }
            $FROM_THICK = '';
            if (isset($spreadSheetArybal[$i][8])) {
                $FROM_THICK = mysqli_real_escape_string($conn, $spreadSheetArybal[$i][8]);
            }
            $TO_THICK = '';
            if (isset($spreadSheetArybal[$i][9])) {
                $TO_THICK = mysqli_real_escape_string($conn, $spreadSheetArybal[$i][9]);
            }
            $ACT_THICK_MIN = '';
            if (isset($spreadSheetArybal[$i][10])) {
                $ACT_THICK_MIN = mysqli_real_escape_string($conn, $spreadSheetArybal[$i][10]);
            }
            $ACT_THICK_MAX = '';
            if (isset($spreadSheetArybal[$i][11])) {
                $ACT_THICK_MAX = mysqli_real_escape_string($conn, $spreadSheetArybal[$i][11]);
            }
            $WIDTH = '';
            if (isset($spreadSheetArybal[$i][12])) {
                $WIDTH = mysqli_real_escape_string($conn, $spreadSheetArybal[$i][12]);
            }
            $WEIGHT = '';
            if (isset($spreadSheetArybal[$i][13])) {
                $WEIGHT = mysqli_real_escape_string($conn, $spreadSheetArybal[$i][13]);
            }
            $OUTPUT_WEIGHT = '';
            if (isset($spreadSheetArybal[$i][14])) {
                $OUTPUT_WEIGHT = mysqli_real_escape_string($conn, $spreadSheetArybal[$i][14]);
            }
            $BABY_COIL = '';
            if (isset($spreadSheetArybal[$i][15])) {
                $BABY_COIL = mysqli_real_escape_string($conn, $spreadSheetArybal[$i][15]);
            }
            $SCRAP_SHEET = '';
            if (isset($spreadSheetArybal[$i][16])) {
                $SCRAP_SHEET = mysqli_real_escape_string($conn, $spreadSheetArybal[$i][16]);
            }
            $SALES_CONTRAK = '';
            if (isset($spreadSheetArybal[$i][18])) {
                $SALES_CONTRAK = mysqli_real_escape_string($conn, $spreadSheetArybal[$i][18]);
            }
            $CUSTOMER_NAME = '';
            if (isset($spreadSheetArybal[$i][19])) {
                $CUSTOMER_NAME = mysqli_real_escape_string($conn, $spreadSheetArybal[$i][19]);
            }
            $PROSES_CPL = '';
            if (isset($spreadSheetArybal[$i][22])) {
                $PROSES_CPL = mysqli_real_escape_string($conn, $spreadSheetArybal[$i][22]);
            }
            $PROSES_MILL = '';
            if (isset($spreadSheetArybal[$i][23])) {
                $PROSES_MILL = mysqli_real_escape_string($conn, $spreadSheetArybal[$i][23]);
            }
            $PROSES_BAL = '';
            if (isset($spreadSheetArybal[$i][24])) {
                $PROSES_BAL = mysqli_real_escape_string($conn, $spreadSheetArybal[$i][24]);
            }
            $PROSES_SLT = '';
            if (isset($spreadSheetArybal[$i][25])) {
                $PROSES_SLT = mysqli_real_escape_string($conn, $spreadSheetArybal[$i][25]);
            }
            $PROSES_CTL = '';
            if (isset($spreadSheetArybal[$i][26])) {
                $PROSES_CTL = mysqli_real_escape_string($conn, $spreadSheetArybal[$i][26]);
            }
            $REMARK_PPC = '';
            if (isset($spreadSheetArybal[$i][27])) {
                $REMARK_PPC = mysqli_real_escape_string($conn, $spreadSheetArybal[$i][27]);
            }
            $SUPPLIER = '';
            if (isset($spreadSheetArybal[$i][29])) {
                $SUPPLIER = mysqli_real_escape_string($conn, $spreadSheetArybal[$i][29]);
            }
            $INVOICE = '';
            if (isset($spreadSheetArybal[$i][30])) {
                $INVOICE = mysqli_real_escape_string($conn, $spreadSheetArybal[$i][30]);
            }
            $DATE_INVOICE = '';
            if (isset($spreadSheetArybal[$i][31])) {
                $date = mysqli_real_escape_string($conn, $spreadSheetArybal[$i][31]);
                $DATE_INVOICE = date('Y-m-d', strtotime($date));
            }
            $DATE_INCOMING = '';
            if (isset($spreadSheetArybal[$i][32])) {
                $date = mysqli_real_escape_string($conn, $spreadSheetArybal[$i][32]);
                $DATE_INCOMING = date('Y-m-d', strtotime($date));
            }
            $DATE_ROLL = '';
            if (isset($spreadSheetArybal[$i][33])) {
                $DATE_ROLL = mysqli_real_escape_string($conn, $spreadSheetArybal[$i][33]);
            }
            $TODAY = '';
            if (isset($spreadSheetArybal[$i][34])) {
                $TODAY = mysqli_real_escape_string($conn, $spreadSheetArybal[$i][34]);
            }
            $WIP_AGING = '';
            if (isset($spreadSheetArybal[$i][35])) {
                $WIP_AGING = mysqli_real_escape_string($conn, $spreadSheetArybal[$i][35]);
            }
            $RM_AGING = '';
            if (isset($spreadSheetArybal[$i][36])) {
                $RM_AGING = mysqli_real_escape_string($conn, $spreadSheetArybal[$i][36]);
            }
            $CONTAINER_NO = '';
            if (isset($spreadSheetArybal[$i][37])) {
                $CONTAINER_NO = mysqli_real_escape_string($conn, $spreadSheetArybal[$i][37]);
            }
            $HEAT_NO = '';
            if (isset($spreadSheetArybal[$i][38])) {
                $HEAT_NO = mysqli_real_escape_string($conn, $spreadSheetArybal[$i][38]);
            }
            $NET_WEIGHT_INCOMING = '';
            if (isset($spreadSheetArybal[$i][39])) {
                $NET_WEIGHT_INCOMING = mysqli_real_escape_string($conn, $spreadSheetArybal[$i][39]);
            }
            $GROSS_INCOMING = '';
            if (isset($spreadSheetArybal[$i][40])) {
                $GROSS_INCOMING = mysqli_real_escape_string($conn, $spreadSheetArybal[$i][40]);
            }
            $NETT_IMR = '';
            if (isset($spreadSheetArybal[$i][41])) {
                $NETT_IMR = mysqli_real_escape_string($conn, $spreadSheetArybal[$i][41]);
            }
            $GROSS_IMR = '';
            if (isset($spreadSheetArybal[$i][42])) {
                $GROSS_IMR = mysqli_real_escape_string($conn, $spreadSheetArybal[$i][42]);
            }
            $bulan = $_POST['bulan'];                
            $tahun = $_POST['tahun'];                
            $periode = $bulan.".".$tahun;
            if ($NEXT_PROSES == "WH" or $NEXT_PROSES == "WAIT MULTI" or $NEXT_PROSES == "WH KW 2" or $NEXT_PROSES == "STOCK RR" or $NEXT_PROSES == "HOLD SLT" or $NEXT_PROSES == "RR ALLOCATED") {
                array_push($bal, [$LOT, $ITEM_CODE, $MACHINE, $NEXT_PROSES, $SUPPLIER_COIL_NO, $IMR_COIL_NO, $GRADE, $FINISH, $FROM_THICK, $TO_THICK, $ACT_THICK_MIN, $ACT_THICK_MAX, $WIDTH, $WEIGHT, $OUTPUT_WEIGHT, $BABY_COIL, $SCRAP_SHEET, $SALES_CONTRAK, $CUSTOMER_NAME, $PROSES_CPL, $PROSES_MILL, $PROSES_BAL, $PROSES_SLT, $PROSES_CTL, $REMARK_PPC, $SUPPLIER, $INVOICE, $DATE_INVOICE, $DATE_INCOMING, $DATE_ROLL, $TODAY, $WIP_AGING, $RM_AGING, $CONTAINER_NO, $HEAT_NO, $NET_WEIGHT_INCOMING, $GROSS_INCOMING, $NETT_IMR, $GROSS_IMR]);
            }
            
            $querybal = "INSERT INTO bal(LOT,ITEM_CODE,MACHINE,NEXT_PROSES,SUPPLIER_COIL_NO,IMR_COIL_NO,GRADE,FINISH,FROM_THICK,TO_THICK,ACT_THICK_MIN,ACT_THICK_MAX,WIDTH,WEIGHT,OUTPUT_WEIGHT,BABY_COIL,SCRAP_SHEET,SALES_CONTRAK,CUSTOMER_NAME,PROSES_CPL,PROSES_MILL,PROSES_BAL,PROSES_SLT,PROSES_CTL,REMARK_PPC,SUPPLIER,INVOICE,DATE_INVOICE,DATE_INCOMING,DATE_ROLL,TODAY,WIP_AGING,RM_AGING,CONTAINER_NO,HEAT_NO,NET_WEIGHT_INCOMING,GROSS_INCOMING,NETT_IMR,GROSS_IMR,periode) VALUES('" . $LOT . "','" . $ITEM_CODE . "','" . $MACHINE . "','" . $NEXT_PROSES . "','" . $SUPPLIER_COIL_NO . "','" . $IMR_COIL_NO . "','" . $GRADE . "','" . $FINISH . "','" . $FROM_THICK . "','" . $TO_THICK . "','" . $ACT_THICK_MIN . "','" . $ACT_THICK_MAX . "','" . $WIDTH . "','" . $WEIGHT . "','" . $OUTPUT_WEIGHT . "','" . $BABY_COIL . "','" . $SCRAP_SHEET . "','" . $SALES_CONTRAK . "','" . $CUSTOMER_NAME . "','" . $PROSES_CPL . "','" . $PROSES_MILL . "','" . $PROSES_BAL . "','" . $PROSES_SLT . "','" . $PROSES_CTL . "','" . $REMARK_PPC . "','" . $SUPPLIER . "','" . $INVOICE . "','" . $DATE_INVOICE . "','" . $DATE_INCOMING . "','" . $DATE_ROLL . "','" . $TODAY . "','" . $WIP_AGING . "','" . $RM_AGING . "','" . $CONTAINER_NO . "','" . $HEAT_NO . "','" . $NET_WEIGHT_INCOMING . "','" . $GROSS_INCOMING . "','" . $NETT_IMR . "','" . $GROSS_IMR . "','".$periode."')";
            $resultbal = mysqli_query($conn, $querybal);
        }
        // UPLOAD BAL2
        for ($i = 3; $i < $sheetCountbal2; $i++) {
            $LOT = '';
            if (isset($spreadSheetArybal2[$i][0])) {
                $LOT = mysqli_real_escape_string($conn, $spreadSheetArybal2[$i][0]);
            }
            $ITEM_CODE = '';
            if (isset($spreadSheetArybal2[$i][1])) {
                $ITEM_CODE = mysqli_real_escape_string($conn, $spreadSheetArybal2[$i][1]);
                $a = explode("-", $ITEM_CODE, 3);
                $b = substr($a[2], 0, 4);
                $c = floatval($b);
                $d = "";
                if ($c < 0.5) {
                    $d = "000";
                } elseif ($c <= 1) {
                    $d = "001";
                } elseif ($c < 1.5) {
                    $d = "001";
                } elseif ($c <= 2) {
                    $d = "002";
                } elseif ($c < 2.5) {
                    $d = "002";
                } else {
                    $d = "003";
                }
                // $e=explode("-",$OriginalString,3);
                $e = substr($a[2], 4);
                $ITEM_CODE = $a[0] . "-" . $a[1] . "-" . $d . $e;
            }
            $MACHINE = '';
            if (isset($spreadSheetArybal2[$i][2])) {
                $MACHINE = mysqli_real_escape_string($conn, $spreadSheetArybal2[$i][2]);
            }
            $NEXT_PROSES = '';
            if (isset($spreadSheetArybal2[$i][3])) {
                $NEXT_PROSES = mysqli_real_escape_string($conn, $spreadSheetArybal2[$i][3]);
            }
            $SUPPLIER_COIL_NO = '';
            if (isset($spreadSheetArybal2[$i][4])) {
                $SUPPLIER_COIL_NO = mysqli_real_escape_string($conn, $spreadSheetArybal2[$i][4]);
            }
            $IMR_COIL_NO = '';
            if (isset($spreadSheetArybal2[$i][5])) {
                $IMR_COIL_NO = mysqli_real_escape_string($conn, $spreadSheetArybal2[$i][5]);
            }
            $GRADE = '';
            if (isset($spreadSheetArybal2[$i][6])) {
                $GRADE = mysqli_real_escape_string($conn, $spreadSheetArybal2[$i][6]);
            }
            $FINISH = '';
            if (isset($spreadSheetArybal2[$i][7])) {
                $FINISH = mysqli_real_escape_string($conn, $spreadSheetArybal2[$i][7]);
            }
            $FROM_THICK = '';
            if (isset($spreadSheetArybal2[$i][8])) {
                $FROM_THICK = mysqli_real_escape_string($conn, $spreadSheetArybal2[$i][8]);
            }
            $TO_THICK = '';
            if (isset($spreadSheetArybal2[$i][9])) {
                $TO_THICK = mysqli_real_escape_string($conn, $spreadSheetArybal2[$i][9]);
            }
            $ACT_THICK_MIN = '';
            if (isset($spreadSheetArybal2[$i][10])) {
                $ACT_THICK_MIN = mysqli_real_escape_string($conn, $spreadSheetArybal2[$i][10]);
            }
            $ACT_THICK_MAX = '';
            if (isset($spreadSheetArybal2[$i][11])) {
                $ACT_THICK_MAX = mysqli_real_escape_string($conn, $spreadSheetArybal2[$i][11]);
            }
            $WIDTH = '';
            if (isset($spreadSheetArybal2[$i][12])) {
                $WIDTH = mysqli_real_escape_string($conn, $spreadSheetArybal2[$i][12]);
            }
            $WEIGHT = '';
            if (isset($spreadSheetArybal2[$i][13])) {
                $WEIGHT = mysqli_real_escape_string($conn, $spreadSheetArybal2[$i][13]);
            }
            $OUTPUT_WEIGHT = '';
            if (isset($spreadSheetArybal2[$i][14])) {
                $OUTPUT_WEIGHT = mysqli_real_escape_string($conn, $spreadSheetArybal2[$i][14]);
            }
            $BABY_COIL = '';
            if (isset($spreadSheetArybal2[$i][15])) {
                $BABY_COIL = mysqli_real_escape_string($conn, $spreadSheetArybal2[$i][15]);
            }
            $SCRAP_SHEET = '';
            if (isset($spreadSheetArybal2[$i][16])) {
                $SCRAP_SHEET = mysqli_real_escape_string($conn, $spreadSheetArybal2[$i][16]);
            }
            $SALES_CONTRAK = '';
            if (isset($spreadSheetArybal2[$i][18])) {
                $SALES_CONTRAK = mysqli_real_escape_string($conn, $spreadSheetArybal2[$i][18]);
            }
            $CUSTOMER_NAME = '';
            if (isset($spreadSheetArybal2[$i][19])) {
                $CUSTOMER_NAME = mysqli_real_escape_string($conn, $spreadSheetArybal2[$i][19]);
            }
            $PROSES_CPL = '';
            if (isset($spreadSheetArybal2[$i][22])) {
                $PROSES_CPL = mysqli_real_escape_string($conn, $spreadSheetArybal2[$i][22]);
            }
            $PROSES_MILL = '';
            if (isset($spreadSheetArybal2[$i][23])) {
                $PROSES_MILL = mysqli_real_escape_string($conn, $spreadSheetArybal2[$i][23]);
            }
            $PROSES_BAL = '';
            if (isset($spreadSheetArybal2[$i][24])) {
                $PROSES_BAL = mysqli_real_escape_string($conn, $spreadSheetArybal2[$i][24]);
            }
            $PROSES_SLT = '';
            if (isset($spreadSheetArybal2[$i][25])) {
                $PROSES_SLT = mysqli_real_escape_string($conn, $spreadSheetArybal2[$i][25]);
            }
            $PROSES_CTL = '';
            if (isset($spreadSheetArybal2[$i][26])) {
                $PROSES_CTL = mysqli_real_escape_string($conn, $spreadSheetArybal2[$i][26]);
            }
            $REMARK_PPC = '';
            if (isset($spreadSheetArybal2[$i][27])) {
                $REMARK_PPC = mysqli_real_escape_string($conn, $spreadSheetArybal2[$i][27]);
            }
            $SUPPLIER = '';
            if (isset($spreadSheetArybal2[$i][29])) {
                $SUPPLIER = mysqli_real_escape_string($conn, $spreadSheetArybal2[$i][29]);
            }
            $INVOICE = '';
            if (isset($spreadSheetArybal2[$i][30])) {
                $INVOICE = mysqli_real_escape_string($conn, $spreadSheetArybal2[$i][30]);
            }
            $DATE_INVOICE = '';
            if (isset($spreadSheetArybal2[$i][31])) {
                $date = mysqli_real_escape_string($conn, $spreadSheetArybal2[$i][31]);
                $DATE_INVOICE = date('Y-m-d', strtotime($date));
            }
            $DATE_INCOMING = '';
            if (isset($spreadSheetArybal2[$i][32])) {
                $date = mysqli_real_escape_string($conn, $spreadSheetArybal2[$i][32]);
                $DATE_INCOMING = date('Y-m-d', strtotime($date));
            }
            $DATE_ROLL = '';
            if (isset($spreadSheetArybal2[$i][33])) {
                $DATE_ROLL = mysqli_real_escape_string($conn, $spreadSheetArybal2[$i][33]);
            }
            $TODAY = '';
            if (isset($spreadSheetArybal2[$i][34])) {
                $TODAY = mysqli_real_escape_string($conn, $spreadSheetArybal2[$i][34]);
            }
            $WIP_AGING = '';
            if (isset($spreadSheetArybal2[$i][35])) {
                $WIP_AGING = mysqli_real_escape_string($conn, $spreadSheetArybal2[$i][35]);
            }
            $RM_AGING = '';
            if (isset($spreadSheetArybal2[$i][36])) {
                $RM_AGING = mysqli_real_escape_string($conn, $spreadSheetArybal2[$i][36]);
            }
            $CONTAINER_NO = '';
            if (isset($spreadSheetArybal2[$i][37])) {
                $CONTAINER_NO = mysqli_real_escape_string($conn, $spreadSheetArybal2[$i][37]);
            }
            $HEAT_NO = '';
            if (isset($spreadSheetArybal2[$i][38])) {
                $HEAT_NO = mysqli_real_escape_string($conn, $spreadSheetArybal2[$i][38]);
            }
            $NET_WEIGHT_INCOMING = '';
            if (isset($spreadSheetArybal2[$i][39])) {
                $NET_WEIGHT_INCOMING = mysqli_real_escape_string($conn, $spreadSheetArybal2[$i][39]);
            }
            $GROSS_INCOMING = '';
            if (isset($spreadSheetArybal2[$i][40])) {
                $GROSS_INCOMING = mysqli_real_escape_string($conn, $spreadSheetArybal2[$i][40]);
            }
            $NETT_IMR = '';
            if (isset($spreadSheetArybal2[$i][41])) {
                $NETT_IMR = mysqli_real_escape_string($conn, $spreadSheetArybal2[$i][41]);
            }
            $GROSS_IMR = '';
            if (isset($spreadSheetArybal2[$i][42])) {
                $GROSS_IMR = mysqli_real_escape_string($conn, $spreadSheetArybal2[$i][42]);
            }
            $bulan = $_POST['bulan'];                
            $tahun = $_POST['tahun'];                
            $periode = $bulan.".".$tahun;
            if ($NEXT_PROSES == "WH" or $NEXT_PROSES == "WAIT MULTI" or $NEXT_PROSES == "WH KW 2" or $NEXT_PROSES == "STOCK RR" or $NEXT_PROSES == "HOLD SLT" or $NEXT_PROSES == "RR ALLOCATED") {
                array_push($bal, [$LOT, $ITEM_CODE, $MACHINE, $NEXT_PROSES, $SUPPLIER_COIL_NO, $IMR_COIL_NO, $GRADE, $FINISH, $FROM_THICK, $TO_THICK, $ACT_THICK_MIN, $ACT_THICK_MAX, $WIDTH, $WEIGHT, $OUTPUT_WEIGHT, $BABY_COIL, $SCRAP_SHEET, $SALES_CONTRAK, $CUSTOMER_NAME, $PROSES_CPL, $PROSES_MILL, $PROSES_BAL, $PROSES_SLT, $PROSES_CTL, $REMARK_PPC, $SUPPLIER, $INVOICE, $DATE_INVOICE, $DATE_INCOMING, $DATE_ROLL, $TODAY, $WIP_AGING, $RM_AGING, $CONTAINER_NO, $HEAT_NO, $NET_WEIGHT_INCOMING, $GROSS_INCOMING, $NETT_IMR, $GROSS_IMR]);
            }
            
            $querybal = "INSERT INTO bal(LOT,ITEM_CODE,MACHINE,NEXT_PROSES,SUPPLIER_COIL_NO,IMR_COIL_NO,GRADE,FINISH,FROM_THICK,TO_THICK,ACT_THICK_MIN,ACT_THICK_MAX,WIDTH,WEIGHT,OUTPUT_WEIGHT,BABY_COIL,SCRAP_SHEET,SALES_CONTRAK,CUSTOMER_NAME,PROSES_CPL,PROSES_MILL,PROSES_BAL,PROSES_SLT,PROSES_CTL,REMARK_PPC,SUPPLIER,INVOICE,DATE_INVOICE,DATE_INCOMING,DATE_ROLL,TODAY,WIP_AGING,RM_AGING,CONTAINER_NO,HEAT_NO,NET_WEIGHT_INCOMING,GROSS_INCOMING,NETT_IMR,GROSS_IMR,periode) VALUES('" . $LOT . "','" . $ITEM_CODE . "','" . $MACHINE . "','" . $NEXT_PROSES . "','" . $SUPPLIER_COIL_NO . "','" . $IMR_COIL_NO . "','" . $GRADE . "','" . $FINISH . "','" . $FROM_THICK . "','" . $TO_THICK . "','" . $ACT_THICK_MIN . "','" . $ACT_THICK_MAX . "','" . $WIDTH . "','" . $WEIGHT . "','" . $OUTPUT_WEIGHT . "','" . $BABY_COIL . "','" . $SCRAP_SHEET . "','" . $SALES_CONTRAK . "','" . $CUSTOMER_NAME . "','" . $PROSES_CPL . "','" . $PROSES_MILL . "','" . $PROSES_BAL . "','" . $PROSES_SLT . "','" . $PROSES_CTL . "','" . $REMARK_PPC . "','" . $SUPPLIER . "','" . $INVOICE . "','" . $DATE_INVOICE . "','" . $DATE_INCOMING . "','" . $DATE_ROLL . "','" . $TODAY . "','" . $WIP_AGING . "','" . $RM_AGING . "','" . $CONTAINER_NO . "','" . $HEAT_NO . "','" . $NET_WEIGHT_INCOMING . "','" . $GROSS_INCOMING . "','" . $NETT_IMR . "','" . $GROSS_IMR . "','".$periode."')";
            $resultbal = mysqli_query($conn, $querybal);
        }
        // UPLOAD SLT
        for ($i = 3; $i < $sheetCount; $i++) {
            $LOT = '';
            if (isset($spreadSheetAry[$i][0])) {
                $LOT = mysqli_real_escape_string($conn, $spreadSheetAry[$i][0]);
            }
            $ITEM_CODE = '';
            if (isset($spreadSheetAry[$i][1])) {
                $ITEM_CODE = mysqli_real_escape_string($conn, $spreadSheetAry[$i][1]);
                // $OriginalString = "0-304L/2B-0.80X767";
                $a = explode("-", $ITEM_CODE, 3);
                $b = substr($a[2], 0, 4);
                $c = floatval($b);
                $d = "";
                if ($c < 0.5) {
                    $d = "000";
                } elseif ($c <= 1) {
                    $d = "001";
                } elseif ($c < 1.5) {
                    $d = "001";
                } elseif ($c <= 2) {
                    $d = "002";
                } elseif ($c < 2.5) {
                    $d = "002";
                } else {
                    $d = "003";
                }
                // $e=explode("-",$OriginalString,3);
                $e = substr($a[2], 4);
                $ITEM_CODE = $a[0] . "-" . $a[1] . "-" . $d . $e;
            }
            $MACHINE = '';
            if (isset($spreadSheetAry[$i][2])) {
                $MACHINE = mysqli_real_escape_string($conn, $spreadSheetAry[$i][2]);
            }
            $NEXT_PROSES = '';
            if (isset($spreadSheetAry[$i][3])) {
                $NEXT_PROSES = mysqli_real_escape_string($conn, $spreadSheetAry[$i][3]);
            }
            $SUPPLIER_COIL_NO = '';
            if (isset($spreadSheetAry[$i][4])) {
                $SUPPLIER_COIL_NO = mysqli_real_escape_string($conn, $spreadSheetAry[$i][4]);
            }
            $IMR_COIL_NO = '';
            if (isset($spreadSheetAry[$i][5])) {
                $IMR_COIL_NO = mysqli_real_escape_string($conn, $spreadSheetAry[$i][5]);
            }
            $GRADE = '';
            if (isset($spreadSheetAry[$i][6])) {
                $GRADE = mysqli_real_escape_string($conn, $spreadSheetAry[$i][6]);
            }
            $FINISH = '';
            if (isset($spreadSheetAry[$i][7])) {
                $FINISH = mysqli_real_escape_string($conn, $spreadSheetAry[$i][7]);
            }
            $FROM_THICK_MM = '';
            if (isset($spreadSheetAry[$i][8])) {
                $FROM_THICK_MM = (mysqli_real_escape_string($conn, $spreadSheetAry[$i][8]) == '') ? 0 : mysqli_real_escape_string($conn, $spreadSheetAry[$i][8]);
            }
            $TO_THICK = '';
            if (isset($spreadSheetAry[$i][9])) {
                $TO_THICK = (mysqli_real_escape_string($conn, $spreadSheetAry[$i][9]) == '') ? 0 : mysqli_real_escape_string($conn, $spreadSheetAry[$i][9]);
            }
            $ACT_THICK_MIN = '';
            if (isset($spreadSheetAry[$i][10])) {
                $ACT_THICK_MIN = (mysqli_real_escape_string($conn, $spreadSheetAry[$i][10]) == '') ? 0 : mysqli_real_escape_string($conn, $spreadSheetAry[$i][10]);
            }
            $ACT_THICK_MAX = '';
            if (isset($spreadSheetAry[$i][11])) {
                $ACT_THICK_MAX = (mysqli_real_escape_string($conn, $spreadSheetAry[$i][11]) == '') ? 0 : mysqli_real_escape_string($conn, $spreadSheetAry[$i][11]);
            }
            $WIDTH = '';
            if (isset($spreadSheetAry[$i][12])) {
                $WIDTH = (mysqli_real_escape_string($conn, $spreadSheetAry[$i][12]) == '') ? 0 : mysqli_real_escape_string($conn, $spreadSheetAry[$i][12]);
            }
            $WEIGHT = '';
            if (isset($spreadSheetAry[$i][13])) {
                $WEIGHT = (mysqli_real_escape_string($conn, $spreadSheetAry[$i][13]) == '') ? 0 : mysqli_real_escape_string($conn, $spreadSheetAry[$i][13]);
            }
            $OUTPUT_WEIGHT = '';
            if (isset($spreadSheetAry[$i][14])) {
                $OUTPUT_WEIGHT = (mysqli_real_escape_string($conn, $spreadSheetAry[$i][14]) == '') ? 0 : mysqli_real_escape_string($conn, $spreadSheetAry[$i][14]);
            }
            $SCRAP_TEORITIS = '';
            if (isset($spreadSheetAry[$i][15])) {
                $SCRAP_TEORITIS = (mysqli_real_escape_string($conn, $spreadSheetAry[$i][15]) == '') ? 0 : mysqli_real_escape_string($conn, $spreadSheetAry[$i][15]);
            }
            $BABY_COIL = '';
            if (isset($spreadSheetAry[$i][16])) {
                $BABY_COIL = (mysqli_real_escape_string($conn, $spreadSheetAry[$i][16]) == '') ? 0 : mysqli_real_escape_string($conn, $spreadSheetAry[$i][16]);
            }
            $SCRAP_SHEET = '';
            if (isset($spreadSheetAry[$i][17])) {
                $SCRAP_SHEET = (mysqli_real_escape_string($conn, $spreadSheetAry[$i][17]) == '') ? 0 : mysqli_real_escape_string($conn, $spreadSheetAry[$i][17]);
            }
            $SCRAP_SS_TRIM = '';
            if (isset($spreadSheetAry[$i][18])) {
                $SCRAP_SS_TRIM = (mysqli_real_escape_string($conn, $spreadSheetAry[$i][18]) == '') ? 0 : mysqli_real_escape_string($conn, $spreadSheetAry[$i][18]);
            }
            $OUTPUT_WIDTH = '';
            if (isset($spreadSheetAry[$i][22])) {
                $OUTPUT_WIDTH = (mysqli_real_escape_string($conn, $spreadSheetAry[$i][22]) == '') ? 0 : mysqli_real_escape_string($conn, $spreadSheetAry[$i][19]);
            }
            $CUSTOMER_NAME = '';
            if (isset($spreadSheetAry[$i][25])) {
                $CUSTOMER_NAME = mysqli_real_escape_string($conn, $spreadSheetAry[$i][25]);
            }
            $CPL = '';
            if (isset($spreadSheetAry[$i][28])) {
                $CPL = mysqli_real_escape_string($conn, $spreadSheetAry[$i][28]);
            }
            $MILL = '';
            if (isset($spreadSheetAry[$i][29])) {
                $MILL = mysqli_real_escape_string($conn, $spreadSheetAry[$i][29]);
            }
            $BAL = '';
            if (isset($spreadSheetAry[$i][30])) {
                $BAL = mysqli_real_escape_string($conn, $spreadSheetAry[$i][30]);
            }
            $SLT = '';
            if (isset($spreadSheetAry[$i][31])) {
                $SLT = mysqli_real_escape_string($conn, $spreadSheetAry[$i][31]);
            }
            $CTL = '';
            if (isset($spreadSheetAry[$i][32])) {
                $CTL = mysqli_real_escape_string($conn, $spreadSheetAry[$i][32]);
            }
            $REMARK_PPC = '';
            if (isset($spreadSheetAry[$i][33])) {
                $REMARK_PPC = mysqli_real_escape_string($conn, $spreadSheetAry[$i][33]);
            }
            $FH_1D = '';
            if (isset($spreadSheetAry[$i][34])) {
                $FH_1D = mysqli_real_escape_string($conn, $spreadSheetAry[$i][34]);
            }
            $SUPPLIER = '';
            if (isset($spreadSheetAry[$i][35])) {
                $SUPPLIER = mysqli_real_escape_string($conn, $spreadSheetAry[$i][35]);
            }
            $INVOICE = '';
            if (isset($spreadSheetAry[$i][36])) {
                $INVOICE = mysqli_real_escape_string($conn, $spreadSheetAry[$i][36]);
            }
            $DATE_INVOICE = '';
            if (isset($spreadSheetAry[$i][37])) {
                $date = mysqli_real_escape_string($conn, $spreadSheetAry[$i][37]);
                $DATE_INVOICE = date('Y-m-d', strtotime($date));
                // $dta
            }
            $DATE_INCOMING = '';
            if (isset($spreadSheetAry[$i][38])) {
                $date = mysqli_real_escape_string($conn, $spreadSheetAry[$i][38]);
                $DATE_INCOMING = date('Y-m-d', strtotime($date));
            }
            $CONTAINER_NO = '';
            if (isset($spreadSheetAry[$i][43])) {
                $CONTAINER_NO = mysqli_real_escape_string($conn, $spreadSheetAry[$i][43]);
            }
            $HEAT_NO = '';
            if (isset($spreadSheetAry[$i][44])) {
                $HEAT_NO = mysqli_real_escape_string($conn, $spreadSheetAry[$i][44]);
            }
            $NET_WEIGHT_INCOMING = '';
            if (isset($spreadSheetAry[$i][45])) {
                $NET_WEIGHT_INCOMING = mysqli_real_escape_string($conn, $spreadSheetAry[$i][45]);
            }
            $GROSS_INCOMING = '';
            if (isset($spreadSheetAry[$i][46])) {
                $GROSS_INCOMING = mysqli_real_escape_string($conn, $spreadSheetAry[$i][46]);
            }
            $NETT_IMR = '';
            if (isset($spreadSheetAry[$i][47])) {
                $NETT_IMR = mysqli_real_escape_string($conn, $spreadSheetAry[$i][47]);
            }
            $GROSS_IMR = '';
            if (isset($spreadSheetAry[$i][48])) {
                $GROSS_IMR = mysqli_real_escape_string($conn, $spreadSheetAry[$i][48]);
            }
            if ($NEXT_PROSES == "BAL" or $NEXT_PROSES == "nav" or  $NEXT_PROSES == "RM" or $NEXT_PROSES == "WH" or $NEXT_PROSES == "WH KW 2" or $NEXT_PROSES == "HOLD SLT" or $NEXT_PROSES == "WAIT MULTI" or $NEXT_PROSES == "RR ALLOCATED" or $NEXT_PROSES == "STOCK RR") {
            // if ($NEXT_PROSES == "WH" or $NEXT_PROSES == "WH KW 2" or $NEXT_PROSES == "HOLD SLT" ) {
                array_push($slt, [$LOT, $ITEM_CODE, $MACHINE, $NEXT_PROSES, $SUPPLIER_COIL_NO, $IMR_COIL_NO, $GRADE, $FINISH, $FROM_THICK_MM, $TO_THICK, $ACT_THICK_MIN, $ACT_THICK_MAX, $WIDTH, $WEIGHT, $OUTPUT_WEIGHT, $SCRAP_TEORITIS, $BABY_COIL, $SCRAP_SHEET, $SCRAP_SS_TRIM, $OUTPUT_WIDTH, $CUSTOMER_NAME, $CPL, $MILL, $BAL, $SLT, $CTL, $REMARK_PPC, $FH_1D, $SUPPLIER, $INVOICE, $DATE_INVOICE, $DATE_INCOMING, $CONTAINER_NO, $HEAT_NO, $NET_WEIGHT_INCOMING, $GROSS_INCOMING, $NETT_IMR, $GROSS_IMR]);
            }
            $query = "INSERT INTO slt(LOT,ITEM_CODE,MACHINE,NEXT_PROSES,SUPPLIER_COIL_NO,IMR_COIL_NO,GRADE,FINISH,FROM_THICK_MM,TO_THICK,ACT_THICK_MIN,ACT_THICK_MAX,WIDTH,WEIGHT,OUTPUT_WEIGHT,SCRAP_TEORITIS,BABY_COIL,SCRAP_SHEET,SCRAP_SS_TRIM,OUTPUT_WIDTH,CUSTOMER_NAME,CPL,MILL,BAL,SLT,CTL,REMARK_PPC,FH_1D,SUPPLIER,INVOICE,DATE_INVOICE,DATE_INCOMING,CONTAINER_NO,HEAT_NO,NET_WEIGHT_INCOMING,GROSS_INCOMING,NETT_IMR,GROSS_IMR,periode) VALUES('" . $LOT . "','" . $ITEM_CODE . "','" . $MACHINE . "','" . $NEXT_PROSES . "','" . $SUPPLIER_COIL_NO . "','" . $IMR_COIL_NO . "','" . $GRADE . "','" . $FINISH . "','" . $FROM_THICK_MM . "','" . $TO_THICK . "','" . $ACT_THICK_MIN . "','" . $ACT_THICK_MAX . "','" . $WIDTH . "','" . $WEIGHT . "','" . $OUTPUT_WEIGHT . "','" . $SCRAP_TEORITIS . "','" . $BABY_COIL . "','" . $SCRAP_SHEET . "','" . $SCRAP_SS_TRIM . "','" . $OUTPUT_WIDTH . "','" . $CUSTOMER_NAME . "','" . $CPL . "','" . $MILL . "','" . $BAL . "','" . $SLT . "','" . $CTL . "','" . $REMARK_PPC . "','" . $FH_1D . "','" . $SUPPLIER . "','" . $INVOICE . "','" . $DATE_INVOICE . "','" . $DATE_INCOMING . "','" . $CONTAINER_NO . "','" . $HEAT_NO . "','" . $NET_WEIGHT_INCOMING . "','" . $GROSS_INCOMING . "','" . $NETT_IMR . "','" . $GROSS_IMR . "','".$periode."')";
            $result = mysqli_query($conn, $query);
        }
        // UPLOAD SLT2
        for ($i = 3; $i < $sheetCount2; $i++) { 
            $LOT = '';
            if (isset($spreadSheetAry2[$i][0])) {
                $LOT = mysqli_real_escape_string($conn, $spreadSheetAry2[$i][0]);
            }
            $ITEM_CODE = '';
            if (isset($spreadSheetAry2[$i][1])) {
                $ITEM_CODE = mysqli_real_escape_string($conn, $spreadSheetAry2[$i][1]);
                // $OriginalString = "0-304L/2B-0.80X767";
                $a = explode("-", $ITEM_CODE, 3);
                $b = substr($a[2], 0, 4);
                $c = floatval($b);
                $d = "";
                if ($c < 0.5) {
                    $d = "000";
                } elseif ($c <= 1) {
                    $d = "001";
                } elseif ($c < 1.5) {
                    $d = "001";
                } elseif ($c <= 2) {
                    $d = "002";
                } elseif ($c < 2.5) {
                    $d = "002";
                } else {
                    $d = "003";
                }
                // $e=explode("-",$OriginalString,3);
                $e = substr($a[2], 4);
                $ITEM_CODE = $a[0] . "-" . $a[1] . "-" . $d . $e;
            }
            $MACHINE = '';
            if (isset($spreadSheetAry2[$i][2])) {
                $MACHINE = mysqli_real_escape_string($conn, $spreadSheetAry2[$i][2]);
            }
            $NEXT_PROSES = '';
            if (isset($spreadSheetAry2[$i][3])) {
                $NEXT_PROSES = mysqli_real_escape_string($conn, $spreadSheetAry2[$i][3]);
            }
            $SUPPLIER_COIL_NO = '';
            if (isset($spreadSheetAry2[$i][4])) {
                $SUPPLIER_COIL_NO = mysqli_real_escape_string($conn, $spreadSheetAry2[$i][4]);
            }
            $IMR_COIL_NO = '';
            if (isset($spreadSheetAry2[$i][5])) {
                $IMR_COIL_NO = mysqli_real_escape_string($conn, $spreadSheetAry2[$i][5]);
            }
            $GRADE = '';
            if (isset($spreadSheetAry2[$i][6])) {
                $GRADE = mysqli_real_escape_string($conn, $spreadSheetAry2[$i][6]);
            }
            $FINISH = '';
            if (isset($spreadSheetAry2[$i][7])) {
                $FINISH = mysqli_real_escape_string($conn, $spreadSheetAry2[$i][7]);
            }
            $FROM_THICK_MM = '';
            if (isset($spreadSheetAry2[$i][8])) {
                $FROM_THICK_MM = (mysqli_real_escape_string($conn, $spreadSheetAry2[$i][8]) == '') ? 0 : mysqli_real_escape_string($conn, $spreadSheetAry2[$i][8]);
            }
            $TO_THICK = '';
            if (isset($spreadSheetAry2[$i][9])) {
                $TO_THICK = (mysqli_real_escape_string($conn, $spreadSheetAry2[$i][9]) == '') ? 0 : mysqli_real_escape_string($conn, $spreadSheetAry2[$i][9]);
            }
            $ACT_THICK_MIN = '';
            if (isset($spreadSheetAry2[$i][10])) {
                $ACT_THICK_MIN = (mysqli_real_escape_string($conn, $spreadSheetAry2[$i][10]) == '') ? 0 : mysqli_real_escape_string($conn, $spreadSheetAry2[$i][10]);
            }
            $ACT_THICK_MAX = '';
            if (isset($spreadSheetAry2[$i][11])) {
                $ACT_THICK_MAX = (mysqli_real_escape_string($conn, $spreadSheetAry2[$i][11]) == '') ? 0 : mysqli_real_escape_string($conn, $spreadSheetAry2[$i][11]);
            }
            $WIDTH = '';
            if (isset($spreadSheetAry2[$i][12])) {
                $WIDTH = (mysqli_real_escape_string($conn, $spreadSheetAry2[$i][12]) == '') ? 0 : mysqli_real_escape_string($conn, $spreadSheetAry2[$i][12]);
            }
            $WEIGHT = '';
            if (isset($spreadSheetAry2[$i][13])) {
                $WEIGHT = (mysqli_real_escape_string($conn, $spreadSheetAry2[$i][13]) == '') ? 0 : mysqli_real_escape_string($conn, $spreadSheetAry2[$i][13]);
            }
            $OUTPUT_WEIGHT = '';
            if (isset($spreadSheetAry2[$i][14])) {
                $OUTPUT_WEIGHT = (mysqli_real_escape_string($conn, $spreadSheetAry2[$i][14]) == '') ? 0 : mysqli_real_escape_string($conn, $spreadSheetAry2[$i][14]);
            }
            $SCRAP_TEORITIS = '';
            if (isset($spreadSheetAry2[$i][15])) {
                $SCRAP_TEORITIS = (mysqli_real_escape_string($conn, $spreadSheetAry2[$i][15]) == '') ? 0 : mysqli_real_escape_string($conn, $spreadSheetAry2[$i][15]);
            }
            $BABY_COIL = '';
            if (isset($spreadSheetAry2[$i][16])) {
                $BABY_COIL = (mysqli_real_escape_string($conn, $spreadSheetAry2[$i][16]) == '') ? 0 : mysqli_real_escape_string($conn, $spreadSheetAry2[$i][16]);
            }
            $SCRAP_SHEET = '';
            if (isset($spreadSheetAry2[$i][17])) {
                $SCRAP_SHEET = (mysqli_real_escape_string($conn, $spreadSheetAry2[$i][17]) == '') ? 0 : mysqli_real_escape_string($conn, $spreadSheetAry2[$i][17]);
            }
            $SCRAP_SS_TRIM = '';
            if (isset($spreadSheetAry2[$i][18])) {
                $SCRAP_SS_TRIM = (mysqli_real_escape_string($conn, $spreadSheetAry2[$i][18]) == '') ? 0 : mysqli_real_escape_string($conn, $spreadSheetAry2[$i][18]);
            }
            $OUTPUT_WIDTH = '';
            if (isset($spreadSheetAry2[$i][22])) {
                $OUTPUT_WIDTH = (mysqli_real_escape_string($conn, $spreadSheetAry2[$i][22]) == '') ? 0 : mysqli_real_escape_string($conn, $spreadSheetAry2[$i][19]);
            }
            $CUSTOMER_NAME = '';
            if (isset($spreadSheetAry2[$i][25])) {
                $CUSTOMER_NAME = mysqli_real_escape_string($conn, $spreadSheetAry2[$i][25]);
            }
            $CPL = '';
            if (isset($spreadSheetAry2[$i][28])) {
                $CPL = mysqli_real_escape_string($conn, $spreadSheetAry2[$i][28]);
            }
            $MILL = '';
            if (isset($spreadSheetAry2[$i][29])) {
                $MILL = mysqli_real_escape_string($conn, $spreadSheetAry2[$i][29]);
            }
            $BAL = '';
            if (isset($spreadSheetAry2[$i][30])) {
                $BAL = mysqli_real_escape_string($conn, $spreadSheetAry2[$i][30]);
            }
            $SLT = '';
            if (isset($spreadSheetAry2[$i][31])) {
                $SLT = mysqli_real_escape_string($conn, $spreadSheetAry2[$i][31]);
            }
            $CTL = '';
            if (isset($spreadSheetAry2[$i][32])) {
                $CTL = mysqli_real_escape_string($conn, $spreadSheetAry2[$i][32]);
            }
            $REMARK_PPC = '';
            if (isset($spreadSheetAry2[$i][33])) {
                $REMARK_PPC = mysqli_real_escape_string($conn, $spreadSheetAry2[$i][33]);
            }
            $FH_1D = '';
            if (isset($spreadSheetAry2[$i][34])) {
                $FH_1D = mysqli_real_escape_string($conn, $spreadSheetAry2[$i][34]);
            }
            $SUPPLIER = '';
            if (isset($spreadSheetAry2[$i][35])) {
                $SUPPLIER = mysqli_real_escape_string($conn, $spreadSheetAry2[$i][35]);
            }
            $INVOICE = '';
            if (isset($spreadSheetAry2[$i][36])) {
                $INVOICE = mysqli_real_escape_string($conn, $spreadSheetAry2[$i][36]);
            }
            $DATE_INVOICE = '';
            if (isset($spreadSheetAry2[$i][37])) {
                $date = mysqli_real_escape_string($conn, $spreadSheetAry2[$i][37]);
                $DATE_INVOICE = date('Y-m-d', strtotime($date));
                // $dta
            }
            $DATE_INCOMING = '';
            if (isset($spreadSheetAry2[$i][38])) {
                $date = mysqli_real_escape_string($conn, $spreadSheetAry2[$i][38]);
                $DATE_INCOMING = date('Y-m-d', strtotime($date));
            }
            $CONTAINER_NO = '';
            if (isset($spreadSheetAry2[$i][43])) {
                $CONTAINER_NO = mysqli_real_escape_string($conn, $spreadSheetAry2[$i][43]);
            }
            $HEAT_NO = '';
            if (isset($spreadSheetAry2[$i][44])) {
                $HEAT_NO = mysqli_real_escape_string($conn, $spreadSheetAry2[$i][44]);
            }
            $NET_WEIGHT_INCOMING = '';
            if (isset($spreadSheetAry2[$i][45])) {
                $NET_WEIGHT_INCOMING = mysqli_real_escape_string($conn, $spreadSheetAry2[$i][45]);
            }
            $GROSS_INCOMING = '';
            if (isset($spreadSheetAry2[$i][46])) {
                $GROSS_INCOMING = mysqli_real_escape_string($conn, $spreadSheetAry2[$i][46]);
            }
            $NETT_IMR = '';
            if (isset($spreadSheetAry2[$i][47])) {
                $NETT_IMR = mysqli_real_escape_string($conn, $spreadSheetAry2[$i][47]);
            }
            $GROSS_IMR = '';
            if (isset($spreadSheetAry2[$i][48])) {
                $GROSS_IMR = mysqli_real_escape_string($conn, $spreadSheetAry2[$i][48]);
            }
            if ($NEXT_PROSES == "BAL" or $NEXT_PROSES == "nav" or  $NEXT_PROSES == "RM" or $NEXT_PROSES == "WH" or $NEXT_PROSES == "WH KW 2" or $NEXT_PROSES == "HOLD SLT" or $NEXT_PROSES == "WAIT MULTI" or $NEXT_PROSES == "RR ALLOCATED" or $NEXT_PROSES == "STOCK RR") {
                array_push($slt, [$LOT, $ITEM_CODE, $MACHINE, $NEXT_PROSES, $SUPPLIER_COIL_NO, $IMR_COIL_NO, $GRADE, $FINISH, $FROM_THICK_MM, $TO_THICK, $ACT_THICK_MIN, $ACT_THICK_MAX, $WIDTH, $WEIGHT, $OUTPUT_WEIGHT, $SCRAP_TEORITIS, $BABY_COIL, $SCRAP_SHEET, $SCRAP_SS_TRIM, $OUTPUT_WIDTH, $CUSTOMER_NAME, $CPL, $MILL, $BAL, $SLT, $CTL, $REMARK_PPC, $FH_1D, $SUPPLIER, $INVOICE, $DATE_INVOICE, $DATE_INCOMING, $CONTAINER_NO, $HEAT_NO, $NET_WEIGHT_INCOMING, $GROSS_INCOMING, $NETT_IMR, $GROSS_IMR]);
            }
            $query = "INSERT INTO slt(LOT,ITEM_CODE,MACHINE,NEXT_PROSES,SUPPLIER_COIL_NO,IMR_COIL_NO,GRADE,FINISH,FROM_THICK_MM,TO_THICK,ACT_THICK_MIN,ACT_THICK_MAX,WIDTH,WEIGHT,OUTPUT_WEIGHT,SCRAP_TEORITIS,BABY_COIL,SCRAP_SHEET,SCRAP_SS_TRIM,OUTPUT_WIDTH,CUSTOMER_NAME,CPL,MILL,BAL,SLT,CTL,REMARK_PPC,FH_1D,SUPPLIER,INVOICE,DATE_INVOICE,DATE_INCOMING,CONTAINER_NO,HEAT_NO,NET_WEIGHT_INCOMING,GROSS_INCOMING,NETT_IMR,GROSS_IMR,periode) VALUES('" . $LOT . "','" . $ITEM_CODE . "','" . $MACHINE . "','" . $NEXT_PROSES . "','" . $SUPPLIER_COIL_NO . "','" . $IMR_COIL_NO . "','" . $GRADE . "','" . $FINISH . "','" . $FROM_THICK_MM . "','" . $TO_THICK . "','" . $ACT_THICK_MIN . "','" . $ACT_THICK_MAX . "','" . $WIDTH . "','" . $WEIGHT . "','" . $OUTPUT_WEIGHT . "','" . $SCRAP_TEORITIS . "','" . $BABY_COIL . "','" . $SCRAP_SHEET . "','" . $SCRAP_SS_TRIM . "','" . $OUTPUT_WIDTH . "','" . $CUSTOMER_NAME . "','" . $CPL . "','" . $MILL . "','" . $BAL . "','" . $SLT . "','" . $CTL . "','" . $REMARK_PPC . "','" . $FH_1D . "','" . $SUPPLIER . "','" . $INVOICE . "','" . $DATE_INVOICE . "','" . $DATE_INCOMING . "','" . $CONTAINER_NO . "','" . $HEAT_NO . "','" . $NET_WEIGHT_INCOMING . "','" . $GROSS_INCOMING . "','" . $NETT_IMR . "','" . $GROSS_IMR . "','".$periode."')";
            $result = mysqli_query($conn, $query);
        }
        $baltomain = [];
        $slttomain = [];
        $countbal = count($bal);


        // BAL
        for ($i = 0; $i < $countbal;$i++){
            $countslttomain = count($slttomain);
            $temp = [];
            if($i< $countbal){
                $coilnumber = "";
                if (substr($bal[$i][5], 0, 1) == "E") {
                    $coilnumber = substr($bal[$i][5], 0, 8);
                } elseif (substr($bal[$i][5], 0, 1) == "G") {
                    $coilnumber = substr($bal[$i][5], 0, 8);
                } elseif (substr($bal[$i][5], 0, 1) == "H") {
                    $coilnumber = substr($bal[$i][5], 0, 8);
                } elseif (substr($bal[$i][5], 0, 1) == "L") {
                    $coilnumber = substr($bal[$i][5], 0, 12);
                } elseif (substr($bal[$i][5], 0, 1) == "T") {
                    $coilnumber = substr($bal[$i][5], 0, 11);
                } elseif (substr($bal[$i][5], 0, 1) == "V") {
                    $coilnumber = substr($bal[$i][5], 0, 8);
                } elseif (substr($bal[$i][5], 0, 1) == "X") {
                    $coilnumber = substr($bal[$i][5], 0, 8);
                } elseif (substr($bal[$i][5], 0, 1) == "F") {
                    $coilnumber = substr($bal[$i][5], 0, 8);
                }
                $coilnumber1 = "";
                if($slttomain == []){
                    if($bal[$i][3] == "WH"){                        
                        // LOT 0
                        array_push($temp, ($bal[$i][0]=="")?0:$bal[$i][0]);
                        // COIL NUMBER 1
                        array_push($temp, $bal[$i][5]);
                        // MOTHER COIL 2
                        array_push($temp, $coilnumber);
                        // GRADE 3
                        array_push($temp, $bal[$i][6]);
                        // FINISH  4
                        array_push($temp, $bal[$i][7]);
                        // THICKNESS  5
                        array_push($temp, $bal[$i][9]);
                        // WIDTH  6
                        array_push($temp, $bal[$i][12]);
                        // PENGECEKAN NEXT PROSSES
                        // WIEGTH  7
                        if($i!=0){
                            if($bal[$i][13]=="" and ($bal[$i-1][3] == "WAIT MULTI" or $bal[$i-1][3] == "WH KW 2" or $bal[$i-1][3] == "STOCK RR" or $bal[$i-1][3] == "HOLD SLT" or $bal[$i-1][3] == "RR ALLOCATED") and $coilnumber==$coilnumber1 and $bal[$i][13] != ""){
                                $w = (floatval($bal[$i-1][13]) - floatval($bal[$i-1][14]) - floatval($bal[$i-1][15]) - floatval($bal[$i-1][16]))*1000;
                                array_push($temp, $w);
                            }elseif($bal[$i][13]==""){
                                $w = floatval(($bal[$i][14]))*1000;
                                array_push($temp, $w);
                            }else{
                                $w = floatval(($bal[$i][13]))*1000;
                                array_push($temp, $w);
                            }
                        }
                        else{
                            if($bal[$i][13]==""){
                                $w = floatval(($bal[$i][14]))*1000;
                                array_push($temp, $w);
                            }else{
                                $w = floatval(($bal[$i][13]))*1000;
                                array_push($temp, $w);
                                }
                        }
                        // OUTPUT WEIGTH 8
                        array_push($temp, floatval(($bal[$i][14]))*1000);
                        // KW 2 9
                        array_push($temp, 0);
                        // BABY COIL 10
                        array_push($temp,floatval(($bal[$i][15] == "") ? 0 : floatval(($bal[$i][15]))*1000));
                        // SCRAP  11                            
                        array_push($temp,floatval(($bal[$i][16] == "") ? 0 : floatval(($bal[$i][16]))*1000));
                        //  SS 12
                        array_push($temp, 0);
                        // WEIGTH BALANCE 13
                        $wb = $w - (floatval($bal[$i][14]) - 0 - floatval($bal[$i][15]) - floatval($bal[$i][16]) - 0)*1000;
                        $wb = number_format((float) $wb, 3, ".", "");
                        array_push($temp, $wb);
                        array_push($temp, $periode);
                        array_push($temp, "bal");
                    }elseif($bal[$i][3]=="WH KW 2"){
                        array_push($temp, ($bal[$i][0]=="")?0:$bal[$i][0]);
                        // COIL NUMBER 1
                        array_push($temp, $bal[$i][5]);
                        // MOTHER COIL 2
                        array_push($temp, $coilnumber);
                        // GRADE 3
                        array_push($temp, $bal[$i][6]);
                        // FINISH  4
                        array_push($temp, $bal[$i][7]);
                        // THICKNESS  5
                        array_push($temp, $bal[$i][9]);
                        // WIDTH  6
                        array_push($temp, $bal[$i][12]);
                        // PENGECEKAN NEXT PROSSES
                        // WIEGTH  7
                        array_push($temp,(floatval($bal[$i][13])-floatval(($bal[$i][14])))*1000);
                        // OUTPUT WEIGTH 8
                        array_push($temp,0);
                        // KW 2 9
                        array_push($temp, floatval(($bal[$i][14]))*1000);
                        // array_push($temp, 0);
                        // BABY COIL 10
                        array_push($temp,floatval(($bal[$i][15] == "") ? 0 : floatval(($bal[$i][15]))*1000));
                        // SCRAP  11                            
                        array_push($temp,floatval(($bal[$i][16] == "") ? 0 : floatval(($bal[$i][16]))*1000));
                        //  SS 12
                        array_push($temp, 0);
                        // WEIGTH BALANCE 13
                        $wb = (floatval($bal[$i][13]) - floatval($bal[$i][14]) - 0 - floatval($bal[$i][15]) - floatval($bal[$i][16]) - 0)*1000;
                        $wb = number_format((float) $wb, 3, ".", "");
                        array_push($temp, $wb);
                        array_push($temp, $periode);
                        array_push($temp, "bal");
                    }
                    // PENCARIAN MOTHER COIL YANG SAMA di TEMP
                    for ($u = $i + 1; $u < $countbal; $u++) {
                        $coilnumber1 = "";
                        if (substr($bal[$u][5], 0, 1) == "E") {
                            $coilnumber1 = substr($bal[$u][5], 0, 8);
                        } elseif (substr($bal[$u][5], 0, 1) == "G") {
                            $coilnumber1 = substr($bal[$u][5], 0, 8);
                        } elseif (substr($bal[$u][5], 0, 1) == "H") {
                            $coilnumber1 = substr($bal[$u][5], 0, 8);
                        } elseif (substr($bal[$u][5], 0, 1) == "L") {
                            $coilnumber1 = substr($bal[$u][5], 0, 12);
                        } elseif (substr($bal[$u][5], 0, 1) == "T") {
                            $coilnumber1 = substr($bal[$u][5], 0, 11);
                        } elseif (substr($bal[$u][5], 0, 1) == "V") {
                            $coilnumber1 = substr($bal[$u][5], 0, 8);
                        } elseif (substr($bal[$u][5], 0, 1) == "X") {
                            $coilnumber1 = substr($bal[$u][5], 0, 8);
                        }
                        if ($coilnumber == $coilnumber1) {
                            if ($bal[$u][3] == "WH") {
                                // WIGTH 7 
                                if($bal[$i][13]==""){
                                    $temp[7] = $temp[7] + $bal[$u][13]*1000;
                                    $temp[8] = $temp[8] + $bal[$u][14] * 1000;
                                    $temp[9] = $temp[9] + $bal[$u][15] * 10000;
                                    $temp[10] = $temp[10] + $bal[$u][16] * 1000;
                                    $temp[11] = $temp[11] + 0;
                                }else{
                                    $temp[7] = floatval($temp[7]) + (floatval($bal[$u][13]) * 1000);
                                }
                                // OUTPUT WEIGTH 8
                                $temp[8] += floatval($bal[$u][14])*1000;
                                // BABY COIL 10
                                $temp[10] = (floatval($temp[10]) + floatval($bal[$u][15])*1000);
                                // SRAP 11
                                $temp[11] = (floatval($temp[11]) + floatval($bal[$u][16])*1000);
                                // SS 12
                                $temp[12] = (floatval($temp[12]) + 0);
                                // WB
                                $wb = (floatval($temp[7]) - floatval($temp[8]) - floatval($temp[9]) - floatval($temp[10]) - floatval($temp[11]) - floatval($temp[12]));
                                $temp[13] = number_format((float) $wb, 3, ".", "");
                            }
                        }
                    }
                    if($temp!=[]){
                        array_push($slttomain, $temp);
                    }

                } else {
                    $inslttomain = 0;
                    $tempa = 0;
                    for ($a = 0; $a < $countslttomain; $a++) {
                        if ($coilnumber == $slttomain[$a][2]) {
                            $inslttomain++;
                            $tempa = $a;
                        }
                    }
                    if ($inslttomain == 0) {
                        // PENGECEKAN NEXT PROSSES
                        if($bal[$i][3] == "WH"){
                            if($i!=$countbal-1){
                                if (substr($bal[$i+1][5], 0, 1) == "E") {
                                    $coilnumber1 = substr($bal[$i+1][5], 0, 8);
                                } elseif (substr($bal[$i+1][5], 0, 1) == "G") {
                                    $coilnumber1 = substr($bal[$i+1][5], 0, 8);
                                } elseif (substr($bal[$i+1][5], 0, 1) == "H") {
                                    $coilnumber1 = substr($bal[$i+1][5], 0, 8);
                                } elseif (substr($bal[$i+1][5], 0, 1) == "L") {
                                    $coilnumber1 = substr($bal[$i+1][5], 0, 12);
                                } elseif (substr($bal[$i+1][5], 0, 1) == "T") {
                                    $coilnumber1 = substr($bal[$i+1][5], 0, 11);
                                } elseif (substr($bal[$i+1][5], 0, 1) == "V") {
                                    $coilnumber1 = substr($bal[$i+1][5], 0, 8);
                                } elseif (substr($bal[$i+1][5], 0, 1) == "X") {
                                    $coilnumber1 = substr($bal[$i+1][5], 0, 8);
                                }elseif (substr($bal[$i+1][5], 0, 1) == "F") {
                                    $coilnumber1 = substr($bal[$i+1][5], 0, 8);
                                }
                                if (substr($bal[$i-1][5], 0, 1) == "E") {
                                    $coilnumber2 = substr($bal[$i-1][5], 0, 8);
                                } elseif (substr($bal[$i-1][5], 0, 1) == "G") {
                                    $coilnumber2 = substr($bal[$i-1][5], 0, 8);
                                } elseif (substr($bal[$i-1][5], 0, 1) == "H") {
                                    $coilnumber2 = substr($bal[$i-1][5], 0, 8);
                                } elseif (substr($bal[$i-1][5], 0, 1) == "L") {
                                    $coilnumber2 = substr($bal[$i-1][5], 0, 12);
                                } elseif (substr($bal[$i-1][5], 0, 1) == "T") {
                                    $coilnumber2 = substr($bal[$i-1][5], 0, 11);
                                } elseif (substr($bal[$i-1][5], 0, 1) == "V") {
                                    $coilnumber2 = substr($bal[$i-1][5], 0, 8);
                                } elseif (substr($bal[$i-1][5], 0, 1) == "X") {
                                    $coilnumber2 = substr($bal[$i-1][5], 0, 8);
                                } elseif (substr($bal[$i-1][5], 0, 1) == "F") {
                                    $coilnumber2 = substr($bal[$i-1][5], 0, 8);
                                }
                            }
                            // LOT 0
                            array_push($temp, ($bal[$i][0]=="")?0:$bal[$i][0]);
                            // COIL NUMBER 1
                            array_push($temp, $bal[$i][5]);
                            // MOTHER COIL 2
                            array_push($temp, $coilnumber);
                            // GRADE 3
                            array_push($temp, $bal[$i][6]);
                            // FINISH  4
                            array_push($temp, $bal[$i][7]);
                            // THICKNESS  5
                            array_push($temp, $bal[$i][9]);
                            // WIDTH  6
                            array_push($temp, $bal[$i][12]);
                            // WIEGTH  7
                            if($i!=$countbal-1){
                                if($bal[$i][13]=="" and ($bal[$i-1][3]=="WAIT MULTI" or $bal[$i-1][3]== "WH KW 2" or $bal[$i-1][3]== "STOCK RR" or $bal[$i-1][3]== "HOLD SLT" or $bal[$i-1][3]== "RR ALLOCATED") and $coilnumber==$coilnumber2 and $bal[$i-1][13]!=""){
                                    $w=(floatval($bal[$i-1][13])-floatval($bal[$i-1][14])-(($bal[$i-1][15]=="")?0:floatval($bal[$i-1][15]))-(($bal[$i-1][16]=="")?0:floatval($bal[$i-1][16])))*1000;
                                    array_push($temp,$w);
                                }elseif(($bal[$i+1][3]=="WAIT MULTI" or $bal[$i+1][3]== "WH KW 2" or $bal[$i+1][3]== "STOCK RR" or $bal[$i+1][3]== "HOLD SLT" or $bal[$i+1][3]== "RR ALLOCATED") and $bal[$i][13]!="" and $coilnumber==$coilnumber1 and $bal[$i+1][13]==""){
                                    $w=(floatval($bal[$i][13])-floatval($bal[$i+1][14])-(($bal[$i+1][15]=="")?0:floatval($bal[$i+1][15]))-(($bal[$i+1][16]=="")?0:floatval($bal[$i+1][16])))*1000;
                                    array_push($temp,$w);
                                }elseif($bal[$i][13]==""){
                                    $w = floatval($bal[$i][14])*1000;
                                    array_push($temp, $w);
                                }else{
                                    $w = floatval($bal[$i][13])*1000;
                                    array_push($temp, $w);
                                }
                            }else{
                                if($bal[$i][13]=="" and ($bal[$i-1][3]=="WAIT MULTI" or $bal[$i-1][3]== "WH KW 2" or $bal[$i-1][3]== "STOCK RR" or $bal[$i-1][3]== "HOLD SLT" or $bal[$i-1][3]== "RR ALLOCATED") and $coilnumber==$coilnumber2 and $bal[$i-1][13]!=""){
                                    $w=(floatval($bal[$i-1][13])-floatval($bal[$i-1][14])-(($bal[$i-1][15]=="")?0:floatval($bal[$i-1][15]))-(($bal[$i-1][16]=="")?0:floatval($bal[$i-1][16])))*1000;
                                    array_push($temp,$w);
                                }elseif($bal[$i][13]==""){
                                    $w = floatval($bal[$i][14])*1000;
                                    array_push($temp, $w);
                                }else{
                                    $w = floatval($bal[$i][13])*1000;
                                    array_push($temp, $w);
                                }
                            }
                            // OUTPUT WEIGTH 8
                            array_push($temp, floatval(($bal[$i][14]))*1000);
                            // KW 2 9
                            array_push($temp, 0);
                            // BABY COIL 10
                            array_push($temp,floatval(($bal[$i][15] == "") ? 0 : floatval(($bal[$i][15]))*1000));
                            // SCRAP  11                            
                            array_push($temp,floatval(($bal[$i][16] == "") ? 0 : floatval(($bal[$i][16]))*1000));
                            //  SS 12
                            array_push($temp, 0);
                            // WEIGTH BALANCE 13
                            // $wb = (floatval($bal[$i][13]) - floatval(($bal[$i][14])) - 0 - floatval($bal[$i][15]) - floatval($bal[$i][16]) - 0)*1000;
                            // $wb = (($temp[7]/1000) - floatval(($bal[$i][14])) - 0 - floatval($bal[$i][15]) - floatval($bal[$i][16]) - 0)*1000;
                            $wb = $w - (floatval(($bal[$i][14])) - 0 - floatval($bal[$i][15]) - floatval($bal[$i][16]) - 0)*1000;
                            $wb = number_format((float) $wb, 3, ".", "");
                            array_push($temp, $wb);
                            array_push($temp, $periode);                            
                            array_push($temp, "bal");
                        }elseif($bal[$i][3]=="WH KW 2"){
                            if($i!=$countbal-1){
                                if (substr($bal[$i+1][5], 0, 1) == "E") {
                                    $coilnumber1 = substr($bal[$i+1][5], 0, 8);
                                } elseif (substr($bal[$i+1][5], 0, 1) == "G") {
                                    $coilnumber1 = substr($bal[$i+1][5], 0, 8);
                                } elseif (substr($bal[$i+1][5], 0, 1) == "H") {
                                    $coilnumber1 = substr($bal[$i+1][5], 0, 8);
                                } elseif (substr($bal[$i+1][5], 0, 1) == "L") {
                                    $coilnumber1 = substr($bal[$i+1][5], 0, 12);
                                } elseif (substr($bal[$i+1][5], 0, 1) == "T") {
                                    $coilnumber1 = substr($bal[$i+1][5], 0, 11);
                                } elseif (substr($bal[$i+1][5], 0, 1) == "V") {
                                    $coilnumber1 = substr($bal[$i+1][5], 0, 8);
                                } elseif (substr($bal[$i+1][5], 0, 1) == "X") {
                                    $coilnumber1 = substr($bal[$i+1][5], 0, 8);
                                }elseif (substr($bal[$i+1][5], 0, 1) == "F") {
                                    $coilnumber1 = substr($bal[$i+1][5], 0, 8);
                                }
                            }
                            // LOT 0
                            array_push($temp, ($bal[$i][0]=="")?0:$bal[$i][0]);
                            // COIL NUMBER 1
                            array_push($temp, $bal[$i][5]);
                            // MOTHER COIL 2
                            array_push($temp, $coilnumber);
                            // GRADE 3
                            array_push($temp, $bal[$i][6]);
                            // FINISH  4
                            array_push($temp, $bal[$i][7]);
                            // THICKNESS  5
                            array_push($temp, $bal[$i][9]);
                            // WIDTH  6
                            array_push($temp, $bal[$i][12]);
                            // WIEGTH  7
                            array_push($temp,($bal[$i][13]=="")?floatval(($bal[$i][14]))*1000:floatval(($bal[$i][13]))*1000);
                            // OUTPUT WEIGTH 8
                            array_push($temp, 0);
                            // KW 2 9
                            array_push($temp, floatval(($bal[$i][14]))*1000);
                            // BABY COIL 10
                            array_push($temp,floatval(($bal[$i][15] == "") ? 0 : floatval(($bal[$i][15]))*1000));
                            // SCRAP  11                            
                            array_push($temp,floatval(($bal[$i][16] == "") ? 0 : floatval(($bal[$i][16]))*1000));
                            //  SS 12
                            array_push($temp, 0);
                            // WEIGTH BALANCE 13
                            $wb = (floatval($bal[$i][13]) - floatval(($bal[$i][14])) - 0 - floatval($bal[$i][15]) - floatval($bal[$i][16]) - 0)*1000;
                            $wb = number_format((float) $wb, 3, ".", "");
                            array_push($temp, $wb);
                            array_push($temp, $periode);                            
                            array_push($temp, "bal");
                        }
                        if($temp!=[]){
                            array_push($slttomain, $temp);
                        }
                    }else{
                        if ($bal[$i][3] == "WH") {
                            if($i!=$countbal-1){
                                if (substr($bal[$i+1][5], 0, 1) == "E") {
                                    $coilnumber1 = substr($bal[$i+1][5], 0, 8);
                                } elseif (substr($bal[$i+1][5], 0, 1) == "G") {
                                    $coilnumber1 = substr($bal[$i+1][5], 0, 8);
                                } elseif (substr($bal[$i+1][5], 0, 1) == "H") {
                                    $coilnumber1 = substr($bal[$i+1][5], 0, 8);
                                } elseif (substr($bal[$i+1][5], 0, 1) == "L") {
                                    $coilnumber1 = substr($bal[$i+1][5], 0, 12);
                                } elseif (substr($bal[$i+1][5], 0, 1) == "T") {
                                    $coilnumber1 = substr($bal[$i+1][5], 0, 11);
                                } elseif (substr($bal[$i+1][5], 0, 1) == "V") {
                                    $coilnumber1 = substr($bal[$i+1][5], 0, 8);
                                } elseif (substr($bal[$i+1][5], 0, 1) == "X") {
                                    $coilnumber1 = substr($bal[$i+1][5], 0, 8);
                                }elseif (substr($bal[$i+1][5], 0, 1) == "F") {
                                    $coilnumber1 = substr($bal[$i+1][5], 0, 8);
                                }
                                if (substr($bal[$i-1][5], 0, 1) == "E") {
                                    $coilnumber2 = substr($bal[$i-1][5], 0, 8);
                                } elseif (substr($bal[$i-1][5], 0, 1) == "G") {
                                    $coilnumber2 = substr($bal[$i-1][5], 0, 8);
                                } elseif (substr($bal[$i-1][5], 0, 1) == "H") {
                                    $coilnumber2 = substr($bal[$i-1][5], 0, 8);
                                } elseif (substr($bal[$i-1][5], 0, 1) == "L") {
                                    $coilnumber2 = substr($bal[$i-1][5], 0, 12);
                                } elseif (substr($bal[$i-1][5], 0, 1) == "T") {
                                    $coilnumber2 = substr($bal[$i-1][5], 0, 11);
                                } elseif (substr($bal[$i-1][5], 0, 1) == "V") {
                                    $coilnumber2 = substr($bal[$i-1][5], 0, 8);
                                } elseif (substr($bal[$i-1][5], 0, 1) == "X") {
                                    $coilnumber2 = substr($bal[$i-1][5], 0, 8);
                                } elseif (substr($bal[$i-1][5], 0, 1) == "F") {
                                    $coilnumber2 = substr($bal[$i-1][5], 0, 8);
                                }
                            }
                            // WIGTH 7
                            if($i!=$countbal-1){
                                if($bal[$i][13]=="" and $bal[$i-1][3]=="WAIT MULTI" and $coilnumber==$coilnumber2 and $bal[$i-1][13]!=""){
                                    $w=floatval($bal[$i-1][13])-floatval($bal[$i-1][14]);
                                    $slttomain[$tempa][7] = $slttomain[$tempa][7] + $w*1000;
                                
                                }elseif($bal[$i+1][3]=="WAIT MULTI" and $coilnumber==$coilnumber1){
                                    $w=floatval($bal[$i][13])-floatval($bal[$i+1][14]);
                                    $slttomain[$tempa][7] = $slttomain[$tempa][7] + $w*1000;
                                }elseif($bal[$i][13]==""){
                                    array_push($temp, floatval($bal[$i][14])*1000);
                                }else{
                                    $slttomain[$tempa][7] = $slttomain[$tempa][7] +floatval($bal[$i][13]) * 1000;
                                }
                            }else{
                                if($bal[$i][13]=="" and $bal[$i-1][3]=="WAIT MULTI" and $coilnumber==$coilnumber2 and $bal[$i-1][13]!=""){
                                    $w=floatval($bal[$i-1][13])-floatval($bal[$i-1][14]);
                                    $slttomain[$tempa][7] = $slttomain[$tempa][7] + $w*1000;
                                    // array_push($temp,$w);
                                }
                                elseif($bal[$i][13]==""){
                                    $slttomain[$tempa][7] = $slttomain[$tempa][7] + floatval($bal[$i][14])*1000;
                                    // array_push($temp, floatval($bal[$i][14])*1000);
                                }else{
                                    $slttomain[$tempa][7] = $slttomain[$tempa][7] + floatval($bal[$i][13]) * 1000;
                                    // array_push($temp, floatval($bal[$i][13]) * 1000);
                                }
                            }
                            $slttomain[$tempa][8] = $slttomain[$tempa][8]+floatval($bal[$i][14]*1000);
                            // BABY COIL 10
                            $slttomain[$tempa][10] = (floatval($slttomain[$tempa][10]) + floatval($bal[$i][15])*1000);
                            // SRAP 11
                            $slttomain[$tempa][11] = (floatval($slttomain[$tempa][11]) + floatval($bal[$i][16])*1000);
                            // SS 12
                            $slttomain[$tempa][12] = (floatval($slttomain[$tempa][12]) + 0);
                            // WB
                            $wb = (floatval($slttomain[$tempa][7]) - floatval($slttomain[$tempa][8]) - floatval($slttomain[$tempa][9]) - floatval($slttomain[$tempa][10]) - floatval($slttomain[$tempa][11]) - floatval($slttomain[$tempa][12]));
                            $slttomain[$tempa][13] = number_format((float) $wb, 3, ".", "");
                            
                        }elseif ($bal[$i][3] == "WH KW 2") {
                            // WIGTH 7
                            if($bal[$i][13]==""){
                                $slttomain[$tempa][7] = $slttomain[$tempa][7];
                            }else{
                                $slttomain[$tempa][7] = $slttomain[$tempa][7] + (floatval($bal[$i][13]) * 1000);
                            }
                            // OUTPUT WEIGTH 8
                            $slttomain[$tempa][8] = $slttomain[$tempa][8];
                            // KW 2
                            $slttomain[$tempa][9] = $slttomain[$tempa][9]+floatval($bal[$i][14]*1000);
                            // BABY COIL 10
                            $slttomain[$tempa][10] = (floatval($slttomain[$tempa][10]) + floatval($bal[$i][15])*1000);
                            // SRAP 11
                            $slttomain[$tempa][11] = (floatval($slttomain[$tempa][11]) + floatval($bal[$i][16])*1000);
                            // SS 12
                            $slttomain[$tempa][12] = (floatval($slttomain[$tempa][12]) + 0);
                            // WB
                            $wb = (floatval($slttomain[$tempa][7]) - floatval($slttomain[$tempa][8]) - floatval($slttomain[$tempa][9]) - floatval($slttomain[$tempa][10]) - floatval($slttomain[$tempa][11]) - floatval($slttomain[$tempa][12]));
                            $slttomain[$tempa][13] = number_format((float) $wb, 3, ".", "");
                        }
                    }
                }
            }
        }
        

        // SLT
        // echo $countslt;
        $countslt = count($slt);
        for ($i = 0; $i < $countslt; $i++) {
            //   berisi slt ke $i yang akan di inputkan ke main
            $countslttomain = count($slttomain);
            $temp = [];
            if ($i < $countslt ) {
            // if ($i < $countslt and $slt[$i][3]!="WAIT MULTI" ) {
                $coilnumber = "";
                if (substr($slt[$i][5], 0, 1) == "E") {
                    $coilnumber = substr($slt[$i][5], 0, 8);
                } elseif (substr($slt[$i][5], 0, 1) == "G") {
                    $coilnumber = substr($slt[$i][5], 0, 8);
                } elseif (substr($slt[$i][5], 0, 1) == "H") {
                    $coilnumber = substr($slt[$i][5], 0, 8);
                } elseif (substr($slt[$i][5], 0, 1) == "L") {
                    $coilnumber = substr($slt[$i][5], 0, 12);
                } elseif (substr($slt[$i][5], 0, 1) == "T") {
                    $coilnumber = substr($slt[$i][5], 0, 11);
                } elseif (substr($slt[$i][5], 0, 1) == "V") {
                    $coilnumber = substr($slt[$i][5], 0, 8);
                } elseif (substr($slt[$i][5], 0, 1) == "X") {
                    $coilnumber = substr($slt[$i][5], 0, 8);
                } elseif (substr($slt[$i][5], 0, 1) == "F") {
                    $coilnumber = substr($slt[$i][5], 0, 8);
                }
                // pengecekan slt to main 
                if ($slttomain == []) {
                    // PENGECEKAN NEXT PROSSES
                    if ($slt[$i][3] == "WH KW 2") {
                        // LOT 0
                        array_push($temp, $slt[$i][0]);
                        // COIL NUMBER 1
                        array_push($temp, $slt[$i][5]);
                        // MOTHER COIL 2
                        array_push($temp, $coilnumber);
                        // GRADE 3
                        array_push($temp, $slt[$i][6]);
                        // FINISH  4
                        array_push($temp, $slt[$i][7]);
                        // THICKNESS  5
                        array_push($temp, $slt[$i][9]);
                        // WIDTH  6
                        array_push($temp, $slt[$i][12]);
                        // WIEGTH  7
                        array_push($temp, ($slt[$i][13])*1000);
                        // OUTPUT WEIGTH 8
                        array_push($temp, 0);
                        // KW 2 9
                        array_push($temp, floatval(($slt[$i][14]))*1000);
                        // BABY COIL 10
                        array_push($temp,floatval(($slt[$i][16] == "") ? 0 : floatval(($slt[$i][16]))*1000));
                        // SCRAP  11                            
                        array_push($temp,floatval(($slt[$i][17] == "") ? 0 : floatval(($slt[$i][17]))*1000));
                        //  SS 12
                        array_push($temp,floatval(($slt[$i][18] == "") ? 0 : floatval(($slt[$i][18]))*1000));
                        // WEIGTH BALANCE
                        $wb = (floatval($slt[$i][13]) - floatval($slt[$i][14]) - 0 - floatval($slt[$i][16]) - floatval($slt[$i][17]) - floatval($slt[$i][18])) * 1000;
                        $wb = number_format((float) $wb, 3, ".", "");
                        array_push($temp, $wb);
                        array_push($temp, $periode);
                    } elseif ($slt[$i][3] == "HOLD SLT") {
                        // WIEGTH  7
                        array_push($temp, 0);
                        // OUTPUT WEIGTH 8
                        array_push($temp, 0);
                        // KW 2 9
                        array_push($temp, 0);
                        // BABY COIL 10
                        array_push($temp,floatval(($slt[$i][16] == "") ? 0 : floatval(($slt[$i][16]))*1000));
                        // SCRAP  11                            
                        array_push($temp,floatval(($slt[$i][17] == "") ? 0 : floatval(($slt[$i][17]))*1000));
                        //  SS 12
                        array_push($temp,floatval(($slt[$i][18] == "") ? 0 : floatval(($slt[$i][18]))*1000));
                        // WEIGTH BALANCE 13
                        $wb = (floatval($slt[$i][13]) - floatval($slt[$i][14]) - 0 - floatval($slt[$i][16]) - floatval($slt[$i][17]) - floatval($slt[$i][18])) * 1000;
                        $wb = number_format((float) $wb, 3, ".", "");
                        array_push($temp, $wb);
                        array_push($temp, $periode);
                    } elseif ($slt[$i][3] == "WH") {
                        // WIEGTH  7
                        array_push($temp, ($slt[$i][13])*1000);
                        // OUTPUT WEIGTH 8
                        array_push($temp, floatval(($slt[$i][14]))*1000);
                        // KW 2 9
                        array_push($temp, 0);
                        // BABY COIL 10
                        array_push($temp, floatval(($slt[$i][16] == "") ? 0 : floatval(($slt[$i][16]))*1000));
                        // SCRAP  11                            
                        array_push($temp,floatval(($slt[$i][17] == "") ? 0 : floatval(($slt[$i][17]))*1000));
                        //  SS 12
                        array_push($temp,floatval(($slt[$i][18] == "") ? 0 : floatval(($slt[$i][18]))*1000));
                        // WEIGTH BALANCE 13
                        $wb = (floatval($slt[$i][13]) - floatval($slt[$i][14]) - 0 - floatval($slt[$i][16]) - floatval($slt[$i][17]) - floatval($slt[$i][18])) * 1000;
                        $wb = number_format((float) $wb, 3, ".", "");
                        array_push($temp, $wb);
                        array_push($temp, $periode);
                    }
                    // PENCARIAN MOTHER COIL YANG SAMA di TEMP
                    for ($u = $i + 1; $u < $countslt; $u++) {
                        $coilnumber1 = "";
                        if (substr($slt[$u][5], 0, 1) == "E") {
                            $coilnumber1 = substr($slt[$u][5], 0, 8);
                        } elseif (substr($slt[$u][5], 0, 1) == "G") {
                            $coilnumber1 = substr($slt[$u][5], 0, 8);
                        } elseif (substr($slt[$u][5], 0, 1) == "H") {
                            $coilnumber1 = substr($slt[$u][5], 0, 8);
                        } elseif (substr($slt[$u][5], 0, 1) == "L") {
                            $coilnumber1 = substr($slt[$u][5], 0, 12);
                        } elseif (substr($slt[$u][5], 0, 1) == "T") {
                            $coilnumber1 = substr($slt[$u][5], 0, 11);
                        } elseif (substr($slt[$u][5], 0, 1) == "V") {
                            $coilnumber1 = substr($slt[$u][5], 0, 8);
                        } elseif (substr($slt[$u][5], 0, 1) == "X") {
                            $coilnumber1 = substr($slt[$u][5], 0, 8);
                        }
                        if ($coilnumber == $coilnumber1) {
                            if ($slt[$u][3] == "WH") {
                                // WIGTH 7 
                                if ($temp[7]-($slt[$u][13]*1000) < 1000) {
                                    $temp[7] += (floatval($slt[$u][13]) * 1000);
                                }
                                // OUTPUT WEIGTH 8
                                $temp[8] += (floatval($slt[$u][14])*1000);
                                // BABY COIL 10
                                $temp[10] = (floatval($temp[10]) + (floatval($slt[$u][16])*1000));
                                // SRAP 11
                                $temp[11] = (floatval($temp[11]) + (floatval($slt[$u][17])*1000));
                                // SS 12
                                $temp[12] = (floatval($temp[12]) + (floatval($slt[$u][18])*1000));
                                // WB
                                $wb = (floatval($temp[7]) - floatval($temp[8]) - floatval($temp[9]) - floatval($temp[10]) - floatval($temp[11]) - floatval($temp[12]));
                                $temp[13] = number_format((float) $wb, 3, ".", "");
                            } elseif ($slt[$u][3] == "WH KW 2") {
                                // KW 2 9
                                $temp[9] = (floatval($temp[9]) + floatval($slt[$u][14]));
                                // BABY COIL 10
                                $temp[10] = (floatval($temp[10]) + (floatval($slt[$u][16])*1000));
                                // SRAP 11
                                $temp[11] = (floatval($temp[11]) + (floatval($slt[$u][17])*1000));
                                // SS 12
                                $temp[12] = (floatval($temp[12]) + (floatval($slt[$u][18])*1000));
                                // WB
                                $wb = (floatval($temp[7]) - floatval($temp[8]) - floatval($temp[9]) - floatval($temp[10]) - floatval($temp[11]) - floatval($temp[12]));
                                $temp[13] = number_format((float) $wb, 3, ".", "");
                            } elseif ($slt[$u][3] == "HOLD SLT") {
                                // BABY COIL 10
                                $temp[10] = (floatval($temp[10]) + (floatval($slt[$u][16])*1000));
                                // SRAP 11
                                $temp[11] = (floatval($temp[11]) + (floatval($slt[$u][17])*1000));
                                // SS 12
                                $temp[12] = (floatval($temp[12]) + (floatval($slt[$u][18])*1000));
                                // WB 13
                                $wb = (floatval($temp[7]) - floatval($temp[8]) - floatval($temp[9]) - floatval($temp[10]) - floatval($temp[11]) - floatval($temp[12]));
                                $temp[13] = number_format((float) $wb, 3, ".", "");
                            }
                        }
                    }
                    if($temp!=[]){
                        array_push($slttomain, $temp);
                    }
                }else {
                    $inslttomain = 0;
                    $tempa = 0;
                    for ($a = 0; $a < $countslttomain; $a++) {
                        if ($coilnumber==$slttomain[$a][2]) {
                            $inslttomain++;
                            $tempa = $a;
                        }
                    }
                    if ($inslttomain == 0) {
                        // PENGECEKAN NEXT PROSSES
                        if ($slt[$i][3] == "WH KW 2") {
                            if($i!=$countslt-1){
                                if (substr($slt[$i+1][5], 0, 1) == "E") {
                                    $coilnumber1 = substr($slt[$i+1][5], 0, 8);
                                } elseif (substr($slt[$i+1][5], 0, 1) == "G") {
                                    $coilnumber1 = substr($slt[$i+1][5], 0, 8);
                                } elseif (substr($slt[$i+1][5], 0, 1) == "H") {
                                    $coilnumber1 = substr($slt[$i+1][5], 0, 8);
                                } elseif (substr($slt[$i+1][5], 0, 1) == "L") {
                                    $coilnumber1 = substr($slt[$i+1][5], 0, 12);
                                } elseif (substr($slt[$i+1][5], 0, 1) == "T") {
                                    $coilnumber1 = substr($slt[$i+1][5], 0, 11);
                                } elseif (substr($slt[$i+1][5], 0, 1) == "V") {
                                    $coilnumber1 = substr($slt[$i+1][5], 0, 8);
                                } elseif (substr($slt[$i+1][5], 0, 1) == "X") {
                                    $coilnumber1 = substr($slt[$i+1][5], 0, 8);
                                }
                                // buat ngecek satu tingkat diatasnya
                                if($i!=0){
                                    if (substr($slt[$i-1][5], 0, 1) == "E") {
                                        $coilnumber2 = substr($slt[$i-1][5], 0, 8);
                                    } elseif (substr($slt[$i-1][5], 0, 1) == "G") {
                                        $coilnumber2 = substr($slt[$i-1][5], 0, 8);
                                    } elseif (substr($slt[$i-1][5], 0, 1) == "H") {
                                        $coilnumber2 = substr($slt[$i-1][5], 0, 8);
                                    } elseif (substr($slt[$i-1][5], 0, 1) == "L") {
                                        $coilnumber2 = substr($slt[$i-1][5], 0, 12);
                                    } elseif (substr($slt[$i-1][5], 0, 1) == "T") {
                                        $coilnumber2 = substr($slt[$i-1][5], 0, 11);
                                    } elseif (substr($slt[$i-1][5], 0, 1) == "V") {
                                        $coilnumber2 = substr($slt[$i-1][5], 0, 8);
                                    } elseif (substr($slt[$i-1][5], 0, 1) == "X") {
                                        $coilnumber2 = substr($slt[$i-1][5], 0, 8);
                                    }
                                }
                                else{
                                    $coilnumber2="";
                                }
                                // PENGECEKAN 2 BARIS DI SETELAH BARIS KE I
                                if($i < $countslt-2){
                                    if (substr($slt[$i+2][5], 0, 1) == "E") {
                                        $coilnumber3 = substr($slt[$i+2][5], 0, 8);
                                    } elseif (substr($slt[$i+2][5], 0, 1) == "G") {
                                        $coilnumber3 = substr($slt[$i+2][5], 0, 8);
                                    } elseif (substr($slt[$i+2][5], 0, 1) == "H") {
                                        $coilnumber3 = substr($slt[$i+2][5], 0, 8);
                                    } elseif (substr($slt[$i+2][5], 0, 1) == "L") {
                                        $coilnumber3 = substr($slt[$i+2][5], 0, 12);
                                    } elseif (substr($slt[$i+2][5], 0, 1) == "T") {
                                        $coilnumber3 = substr($slt[$i+2][5], 0, 11);
                                    } elseif (substr($slt[$i+2][5], 0, 1) == "V") {
                                        $coilnumber3 = substr($slt[$i+2][5], 0, 8);
                                    } elseif (substr($slt[$i+2][5], 0, 1) == "X") {
                                        $coilnumber3 = substr($slt[$i+2][5], 0, 8);
                                    }
                                }
                                else{
                                    $coilnumber3="";
                                }
                                
                            }
                            // LOT 0
                            array_push($temp, $slt[$i][0]);
                            // COIL NUMBER 1
                            array_push($temp, $slt[$i][5]);
                            // MOTHER COIL 2
                            array_push($temp, $coilnumber);
                            // GRADE 3
                            array_push($temp, $slt[$i][6]);
                            // FINISH  4
                            array_push($temp, $slt[$i][7]);
                            // THICKNESS  5
                            array_push($temp, $slt[$i][9]);
                            // WIDTH  6
                            array_push($temp, $slt[$i][12]);
                            // WIEGTH  7
                            // array_push($temp, (floatval($slt[$i][13]))*1000);
                            if($i!=$countslt-1){
                                if($slt[$i][13]!="" and ($slt[$i+1][3]=="WAIT MULTI") and $coilnumber==$coilnumber1 and $slt[$i+1][13]==""){
                                    $w=(floatval($slt[$i][13])-floatval($slt[$i+1][14])-(($slt[$i+1][16]=="") ? 0 : floatval($slt[$i+1][16]))-(($slt[$i+1][17]=="") ? 0 : floatval($slt[$i+1][17]))-(($slt[$i+1][18]=="") ? 0 : floatval($slt[$i+1][18])))*1000;
                                    array_push($temp,$w);
                                }elseif($slt[$i][13]!="" and ($slt[$i+1][3]=="STOCK RR") and $coilnumber==$coilnumber1 and $slt[$i+1][13]==""){
                                    $w=(floatval($slt[$i][13])-floatval($slt[$i+1][14])-(($slt[$i+1][16]=="") ? 0 : floatval($slt[$i+1][16]))-(($slt[$i+1][17]=="") ? 0 : floatval($slt[$i+1][17]))-(($slt[$i+1][18]=="") ? 0 : floatval($slt[$i+1][18])))*1000;
                                    array_push($temp,$w);
                                }elseif($slt[$i][13]!="" and ($slt[$i+1][3]=="WH") and $coilnumber==$coilnumber1 and $slt[$i+1][13]==""){
                                    $w=(floatval($slt[$i][13])-floatval($slt[$i][14])-(($slt[$i][16]=="") ? 0 : floatval($slt[$i][16]))-(($slt[$i][17]=="") ? 0 : floatval($slt[$i][17]))-(($slt[$i][18]=="") ? 0 : floatval($slt[$i][18])))*1000;
                                    array_push($temp, $w);
                                }elseif($slt[$i][13]=="" and $slt[$i-1][13]!="" and ($slt[$i-1][3]=="WAIT MULTI" or $slt[$i-1][3]=="STOCK RR") and $coilnumber==$coilnumber2 and $slt[$i-1][13]!=""){
                                    $w=(floatval($slt[$i-1][13])-floatval($slt[$i-1][14])-(($slt[$i-1][16]=="") ? 0 : floatval($slt[$i-1][16]))-(($slt[$i-1][17]=="") ? 0 : floatval($slt[$i-1][17]))-(($slt[$i-1][18]=="") ? 0 : floatval($slt[$i-1][18])))*1000;
                                    array_push($temp, $w);
                                }elseif($slt[$i][13]=="" and $slt[$i-1][13]!="" and ($slt[$i-1][3]=="WH") and $coilnumber==$coilnumber2){
                                    $w=(floatval($slt[$i][14])+(($slt[$i][16]=="") ? 0 : floatval($slt[$i][16]))+(($slt[$i][17]=="") ? 0 : floatval($slt[$i][17]))+(($slt[$i][18]=="") ? 0 : floatval($slt[$i][18])))*1000;
                                    array_push($temp, $w);
                                }else{
                                    $w = floatval($slt[$i][13]) * 1000;
                                    array_push($temp, $w);
                                }
                            }else{
                                if($slt[$i][13]=="" and $slt[$i-1][13]!="" and ($slt[$i-1][3]=="WAIT MULTI" or $slt[$i-1][3]=="STOCK RR") and $coilnumber==$coilnumber2){
                                    $w=(floatval($slt[$i-1][13])-floatval($slt[$i-1][14])-(($slt[$i-1][16]=="") ? 0 : floatval($slt[$i-1][16]))-(($slt[$i-1][17]=="") ? 0 : floatval($slt[$i-1][17]))-(($slt[$i-1][18]=="") ? 0 : floatval($slt[$i-1][18])))*1000;
                                    array_push($temp, $w);
                                }elseif($slt[$i][13]=="" and $slt[$i-1][13]!="" and ($slt[$i-1][3]=="WH") and $coilnumber==$coilnumber2){
                                    $w=(floatval($slt[$i][14])+(($slt[$i][16]=="") ? 0 : floatval($slt[$i][16]))+(($slt[$i][17]=="") ? 0 : floatval($slt[$i][17]))+(($slt[$i][18]=="") ? 0 : floatval($slt[$i][18])))*1000;
                                    array_push($temp, $w);
                                }else{
                                    $w = floatval($slt[$i][13]) * 1000;
                                    array_push($temp, $w);                                
                                }
                            }
                            // OUTPUT WEIGTH 8
                            array_push($temp, 0);
                            // KW 2 9
                            array_push($temp, floatval(($slt[$i][14]))*1000);
                            // BABY COIL 10
                            array_push($temp,floatval(($slt[$i][16] == "") ? 0 : floatval(($slt[$i][16]))*1000));
                            // SCRAP  11                            
                            array_push($temp,floatval(($slt[$i][17] == "") ? 0 : floatval(($slt[$i][17]))*1000));
                            //  SS 12
                            array_push($temp,floatval(($slt[$i][18] == "") ? 0 : floatval(($slt[$i][18]))*1000));
                            // WEIGTH BALANCE 13
                            $wb = $w - (floatval($slt[$i][14]) + 0 + floatval($slt[$i][16]) + floatval($slt[$i][17]) + floatval($slt[$i][18])) * 1000;
                            $wb = number_format((float) $wb, 3, ".", "");
                            array_push($temp, $wb);
                            array_push($temp, $periode);
                            array_push($temp,"slt");
                        } elseif ($slt[$i][3] == "HOLD SLT") {
                            if($i!=$countslt-1){
                                if (substr($slt[$i+1][5], 0, 1) == "E") {
                                    $coilnumber1 = substr($slt[$i+1][5], 0, 8);
                                } elseif (substr($slt[$i+1][5], 0, 1) == "G") {
                                    $coilnumber1 = substr($slt[$i+1][5], 0, 8);
                                } elseif (substr($slt[$i+1][5], 0, 1) == "H") {
                                    $coilnumber1 = substr($slt[$i+1][5], 0, 8);
                                } elseif (substr($slt[$i+1][5], 0, 1) == "L") {
                                    $coilnumber1 = substr($slt[$i+1][5], 0, 12);
                                } elseif (substr($slt[$i+1][5], 0, 1) == "T") {
                                    $coilnumber1 = substr($slt[$i+1][5], 0, 11);
                                } elseif (substr($slt[$i+1][5], 0, 1) == "V") {
                                    $coilnumber1 = substr($slt[$i+1][5], 0, 8);
                                } elseif (substr($slt[$i+1][5], 0, 1) == "X") {
                                    $coilnumber1 = substr($slt[$i+1][5], 0, 8);
                                }
                                if (substr($slt[$i-1][5], 0, 1) == "E") {
                                    $coilnumber2 = substr($slt[$i-1][5], 0, 8);
                                } elseif (substr($slt[$i-1][5], 0, 1) == "G") {
                                    $coilnumber2 = substr($slt[$i-1][5], 0, 8);
                                } elseif (substr($slt[$i-1][5], 0, 1) == "H") {
                                    $coilnumber2 = substr($slt[$i-1][5], 0, 8);
                                } elseif (substr($slt[$i-1][5], 0, 1) == "L") {
                                    $coilnumber2 = substr($slt[$i-1][5], 0, 12);
                                } elseif (substr($slt[$i-1][5], 0, 1) == "T") {
                                    $coilnumber2 = substr($slt[$i-1][5], 0, 11);
                                } elseif (substr($slt[$i-1][5], 0, 1) == "V") {
                                    $coilnumber2 = substr($slt[$i-1][5], 0, 8);
                                } elseif (substr($slt[$i-1][5], 0, 1) == "X") {
                                    $coilnumber2 = substr($slt[$i-1][5], 0, 8);
                                }
                            }
                            // LOT 0
                            array_push($temp, $slt[$i][0]);
                            // COIL NUMBER 1
                            array_push($temp, $slt[$i][5]);
                            // MOTHER COIL 2
                            array_push($temp, $coilnumber);
                            // GRADE 3
                            array_push($temp, $slt[$i][6]);
                            // FINISH  4
                            array_push($temp, $slt[$i][7]);
                            // THICKNESS  5
                            array_push($temp, $slt[$i][9]);
                            // WIDTH  6
                            array_push($temp, $slt[$i][12]);
                            // WIEGTH  7
                            array_push($temp, 0);
                            // OUTPUT WEIGTH 8
                            array_push($temp, 0);
                            // KW 2 9
                            array_push($temp, 0);
                            // BABY COIL 10
                            array_push($temp,floatval(($slt[$i][16] == "") ? 0 : floatval(($slt[$i][16]))*1000));
                            // SCRAP  11                            
                            array_push($temp,floatval(($slt[$i][17] == "") ? 0 : floatval(($slt[$i][17]))*1000));
                            //  SS 12
                            array_push($temp,floatval(($slt[$i][18] == "") ? 0 : floatval(($slt[$i][18]))*1000));
                            // WEIGTH BALANCE 13
                            $wb = (0 - 0 - 0 - floatval($slt[$i][16]) - floatval($slt[$i][17]) - floatval($slt[$i][18])) * 1000;
                            $wb = number_format((float) $wb, 3, ".", "");
                            array_push($temp, $wb);
                            array_push($temp, $periode);
                            array_push($temp,"slt");
                        } elseif ($slt[$i][3] == "WH") {
                            if($i!=$countslt-1){
                                if (substr($slt[$i+1][5], 0, 1) == "E") {
                                    $coilnumber1 = substr($slt[$i+1][5], 0, 8);
                                } elseif (substr($slt[$i+1][5], 0, 1) == "G") {
                                    $coilnumber1 = substr($slt[$i+1][5], 0, 8);
                                } elseif (substr($slt[$i+1][5], 0, 1) == "H") {
                                    $coilnumber1 = substr($slt[$i+1][5], 0, 8);
                                } elseif (substr($slt[$i+1][5], 0, 1) == "L") {
                                    $coilnumber1 = substr($slt[$i+1][5], 0, 12);
                                } elseif (substr($slt[$i+1][5], 0, 1) == "T") {
                                    $coilnumber1 = substr($slt[$i+1][5], 0, 11);
                                } elseif (substr($slt[$i+1][5], 0, 1) == "V") {
                                    $coilnumber1 = substr($slt[$i+1][5], 0, 8);
                                } elseif (substr($slt[$i+1][5], 0, 1) == "X") {
                                    $coilnumber1 = substr($slt[$i+1][5], 0, 8);
                                }
                                if($i!=0){
                                    if (substr($slt[$i-1][5], 0, 1) == "E") {
                                        $coilnumber2 = substr($slt[$i-1][5], 0, 8);
                                    } elseif (substr($slt[$i-1][5], 0, 1) == "G") {
                                        $coilnumber2 = substr($slt[$i-1][5], 0, 8);
                                    } elseif (substr($slt[$i-1][5], 0, 1) == "H") {
                                        $coilnumber2 = substr($slt[$i-1][5], 0, 8);
                                    } elseif (substr($slt[$i-1][5], 0, 1) == "L") {
                                        $coilnumber2 = substr($slt[$i-1][5], 0, 12);
                                    } elseif (substr($slt[$i-1][5], 0, 1) == "T") {
                                        $coilnumber2 = substr($slt[$i-1][5], 0, 11);
                                    } elseif (substr($slt[$i-1][5], 0, 1) == "V") {
                                        $coilnumber2 = substr($slt[$i-1][5], 0, 8);
                                    } elseif (substr($slt[$i-1][5], 0, 1) == "X") {
                                        $coilnumber2 = substr($slt[$i-1][5], 0, 8);
                                    }
                                }else{
                                    $coilnumber2="";
                                }
                            }
                            // LOT 0
                            array_push($temp, $slt[$i][0]);
                            // COIL NUMBER 1
                            array_push($temp, $slt[$i][5]);
                            // MOTHER COIL 2
                            array_push($temp, $coilnumber);
                            // GRADE 3
                            array_push($temp, $slt[$i][6]);
                            // FINISH  4
                            array_push($temp, $slt[$i][7]);
                            // THICKNESS  5
                            array_push($temp, $slt[$i][9]);
                            // WIDTH  6
                            array_push($temp, $slt[$i][12]);
                            // WIEGTH  7
                            if($i!=$countslt-1){
                                if($slt[$i][13]!="" and $slt[$i+1][13]=="" and ($slt[$i+1][3] == "BAL" or $slt[$i+1][3] == "nav" or  $slt[$i+1][3] == "RM" or $slt[$i+1][3] == "WH KW 2" or $slt[$i+1][3] == "HOLD SLT" or $slt[$i+1][3] == "WAIT MULTI" or $slt[$i+1][3] == "RR ALLOCATED" or $slt[$i+1][3] == "STOCK RR") and $coilnumber==$coilnumber1){
                                    $w=(floatval($slt[$i][13])-floatval($slt[$i+1][14])-(($slt[$i+1][16]=="") ? 0 : floatval($slt[$i+1][16]))-(($slt[$i+1][17]=="") ? 0 : floatval($slt[$i+1][17]))-(($slt[$i+1][18]=="") ? 0 : floatval($slt[$i+1][18])))*1000;
                                    array_push($temp,$w);
                                }elseif($slt[$i][13]=="" and ($slt[$i-1][3] == "BAL" or $slt[$i-1][3] == "nav" or  $slt[$i-1][3] == "RM" or $slt[$i-1][3] == "WH KW 2" or $slt[$i-1][3] == "HOLD SLT" or $slt[$i-1][3] == "WAIT MULTI" or $slt[$i-1][3] == "RR ALLOCATED" or $slt[$i-1][3] == "STOCK RR") and $coilnumber==$coilnumber2 and $slt[$i-1][13]!=""){
                                    $w=(floatval($slt[$i-1][13])-floatval($slt[$i-1][14])-(($slt[$i-1][16]=="") ? 0 : floatval($slt[$i-1][16]))-(($slt[$i-1][17]=="") ? 0 : floatval($slt[$i-1][17]))-(($slt[$i-1][18]=="") ? 0 : floatval($slt[$i-1][18])))*1000;
                                    array_push($temp,$w);
                                }elseif($slt[$i][13]==""){
                                    $w = floatval($slt[$i][14])*1000;
                                    array_push($temp, $w);
                                }else{
                                    $w = floatval($slt[$i][13]) * 1000;
                                    array_push($temp, $w);
                                }
                            }elseif($i!=0){
                                if($slt[$i][13]=="" and ($slt[$i-1][3] == "BAL" or $slt[$i-1][3] == "nav" or  $slt[$i-1][3] == "RM" or $slt[$i-1][3] == "WH KW 2" or $slt[$i-1][3] == "HOLD SLT" or $slt[$i-1][3] == "WAIT MULTI" or $slt[$i-1][3] == "RR ALLOCATED" or $slt[$i-1][3] == "STOCK RR") and $coilnumber==$coilnumber2 and $slt[$i+1][13]!=""){
                                    $w=(floatval($slt[$i-1][13])-floatval($slt[$i-1][14])-(($slt[$i-1][16]=="") ? 0 : floatval($slt[$i-1][16]))-(($slt[$i-1][17]=="") ? 0 : floatval($slt[$i-1][17]))-(($slt[$i-1][18]=="") ? 0 : floatval($slt[$i-1][18])))*1000;
                                    array_push($temp,$w);
                                }elseif($slt[$i][13]==""){
                                    $w = floatval($slt[$i][14])*1000;
                                    array_push($temp, $w);
                                }else{
                                    $w = floatval($slt[$i][13]) * 1000;
                                    array_push($temp, $w);
                                }
                            }
                            // OUTPUT WEIGTH 8
                            array_push($temp, floatval(($slt[$i][14]))*1000);
                            // KW 2 9
                            array_push($temp, 0);
                            // BABY COIL 10
                            array_push($temp,floatval(($slt[$i][16] == "") ? 0 : floatval(($slt[$i][16]))*1000));
                            // SCRAP  11                            
                            array_push($temp,floatval(($slt[$i][17] == "") ? 0 : floatval(($slt[$i][17]))*1000));
                            //  SS 12
                            array_push($temp,floatval(($slt[$i][18] == "") ? 0 : floatval(($slt[$i][18]))*1000));
                            // WEIGTH BALANCE 13
                            $wb = $w - (floatval($slt[$i][14]) + 0 + floatval($slt[$i][16]) + floatval($slt[$i][17]) + floatval($slt[$i][18])) * 1000;
                            $wb = number_format((float) $wb, 3, ".", "");
                            array_push($temp, $wb);
                            array_push($temp, $periode);
                            array_push($temp,"slt");
                        }
                        if($temp!=[]){
                            array_push($slttomain, $temp);
                        }
                        // array_push($slttomain, $temp);
                    }else {
                        if ($slt[$i][3] == "WH KW 2") {
                            if($i!=$countslt-1){
                                if (substr($slt[$i+1][5], 0, 1) == "E") {
                                    $coilnumber1 = substr($slt[$i+1][5], 0, 8);
                                } elseif (substr($slt[$i+1][5], 0, 1) == "G") {
                                    $coilnumber1 = substr($slt[$i+1][5], 0, 8);
                                } elseif (substr($slt[$i+1][5], 0, 1) == "H") {
                                    $coilnumber1 = substr($slt[$i+1][5], 0, 8);
                                } elseif (substr($slt[$i+1][5], 0, 1) == "L") {
                                    $coilnumber1 = substr($slt[$i+1][5], 0, 12);
                                } elseif (substr($slt[$i+1][5], 0, 1) == "T") {
                                    $coilnumber1 = substr($slt[$i+1][5], 0, 11);
                                } elseif (substr($slt[$i+1][5], 0, 1) == "V") {
                                    $coilnumber1 = substr($slt[$i+1][5], 0, 8);
                                } elseif (substr($slt[$i+1][5], 0, 1) == "X") {
                                    $coilnumber1 = substr($slt[$i+1][5], 0, 8);
                                }
                                if($i!=0){
                                    if (substr($bal[$i-1][5], 0, 1) == "E") {
                                        $coilnumber2 = substr($bal[$i-1][5], 0, 8);
                                    } elseif (substr($bal[$i-1][5], 0, 1) == "G") {
                                        $coilnumber2 = substr($bal[$i-1][5], 0, 8);
                                    } elseif (substr($bal[$i-1][5], 0, 1) == "H") {
                                        $coilnumber2 = substr($bal[$i-1][5], 0, 8);
                                    } elseif (substr($bal[$i-1][5], 0, 1) == "L") {
                                        $coilnumber2 = substr($bal[$i-1][5], 0, 12);
                                    } elseif (substr($bal[$i-1][5], 0, 1) == "T") {
                                        $coilnumber2 = substr($bal[$i-1][5], 0, 11);
                                    } elseif (substr($bal[$i-1][5], 0, 1) == "V") {
                                        $coilnumber2 = substr($bal[$i-1][5], 0, 8);
                                    } elseif (substr($bal[$i-1][5], 0, 1) == "X") {
                                        $coilnumber2 = substr($bal[$i-1][5], 0, 8);
                                    }
                                }else{
                                    $coilnumber2="";
                                }
                            }
                            if($i!=0){
                                if($slt[$i][13]!="" and $slttomain[$tempa][2]==$coilnumber1 and ($slt[$i+1][3] == "BAL" or $slt[$i+1][3] == "nav" or  $slt[$i+1][3] == "RM" or $slt[$i+1][3] == "HOLD SLT" or $slt[$i+1][3] == "WAIT MULTI" or $slt[$i+1][3] == "RR ALLOCATED" or $slt[$i+1][3] == "STOCK RR") and $slt[$i+1][13==""]){
                                    $w=(floatval($slt[$i][13])-floatval($slt[$i+1][14])-(($slt[$i+1][16]=="") ? 0 : floatval($slt[$i+1][16]))-(($slt[$i+1][17]=="") ? 0 : floatval($slt[$i+1][17]))-(($slt[$i+1][18]=="") ? 0 : floatval($slt[$i+1][18])))*1000;
                                    $slttomain[$tempa][7] = floatval($slttomain[$tempa][7]) + $w;
                                }elseif($slt[$i][13]!="" and $slttomain[$tempa][2]==$coilnumber1 and $slt[$i+1][3]=="WH" and $slt[$i+1][13]==""){
                                    $w=(floatval($slt[$i][14])+(($slt[$i][16]=="") ? 0 : floatval($slt[$i][16]))+(($slt[$i][17]=="") ? 0 : floatval($slt[$i][17]))+(($slt[$i][18]=="") ? 0 : floatval($slt[$i+1][18])))*1000;
                                    $slttomain[$tempa][7] = $slttomain[$tempa][7] + $w;
                                }elseif($slt[$i][13] == "" and $slttomain[$tempa][2]==$coilnumber2 and ($slt[$i-1][3] == "BAL" or $slt[$i-1][3] == "nav" or  $slt[$i-1][3] == "RM" or $slt[$i-1][3] == "HOLD SLT" or $slt[$i-1][3] == "WAIT MULTI" or $slt[$i-1][3] == "RR ALLOCATED" or $slt[$i-1][3] == "STOCK RR") and $slt[$i][13]==""){
                                    $w=(floatval($slt[$i-1][13])-floatval($slt[$i-1][14])-(($slt[$i-1][16]=="") ? 0 : floatval($slt[$i-1][16]))-(($slt[$i-1][17]=="") ? 0 : floatval($slt[$i-1][17]))-(($slt[$i-1][18]=="") ? 0 : floatval($slt[$i+1][18])))*1000;
                                    $slttomain[$tempa][7] = floatval($slttomain[$tempa][7]) + $w;
                                }elseif($slt[$i][13] == "" and $slttomain[$tempa][2]==$coilnumber2 and $slt[$i-1][3]=="WH" and $slt[$i][13]==""){
                                    $slttomain[$tempa][7] = floatval($slttomain[$tempa][7])  + (floatval($slt[$i][14]) + (($slt[$i][16]=="") ? 0 : floatval($slt[$i][16])) + (($slt[$i][17]=="") ? 0 : floatval($slt[$i][17])) + (($slt[$i][18]=="") ? 0 : floatval($slt[$i][18])))*1000;
                                }else{
                                    $slttomain[$tempa][7] = (floatval($slttomain[$tempa][7]) + (floatval($slt[$i][13]))*1000);
                                }
                            }else{
                                if($slt[$i][13]!="" and $slttomain[$tempa][2]==$coilnumber1 and ($slt[$i+1][3] == "BAL" or $slt[$i+1][3] == "nav" or  $slt[$i+1][3] == "RM" or $slt[$i+1][3] == "HOLD SLT" or $slt[$i+1][3] == "WAIT MULTI" or $slt[$i+1][3] == "RR ALLOCATED" or $slt[$i+1][3] == "STOCK RR") and $slt[$i+1][13==""]){
                                    $w=(floatval($slt[$i][13])-floatval($slt[$i+1][14])-(($slt[$i+1][16]=="") ? 0 : floatval($slt[$i+1][16]))-(($slt[$i+1][17]=="") ? 0 : floatval($slt[$i+1][17]))-(($slt[$i+1][18]=="") ? 0 : floatval($slt[$i+1][18])))*1000;
                                    $slttomain[$tempa][7] = floatval($slttomain[$tempa][7]) + $w;
                                }elseif($slt[$i][13]!="" and $slttomain[$tempa][2]==$coilnumber1 and $slt[$i+1][3]=="WH" and $slt[$i+1][13]==""){
                                    $w=floatval($slt[$i][14])+(($slt[$i][16]=="") ? 0 : floatval($slt[$i][16]))+(($slt[$i][17]=="") ? 0 : floatval($slt[$i][17]))+(($slt[$i][18]=="") ? 0 : floatval($slt[$i+1][18]))*1000;
                                    $slttomain[$tempa][7] = $slttomain[$tempa][7] + $w;
                                }else{
                                    $slttomain[$tempa][7] = (floatval($slttomain[$tempa][7]) + (floatval($slt[$i][13]))*1000);
                                }
                            }
                            // KW 2 9
                            $slttomain[$tempa][9] += floatval(($slt[$i][14])*1000);
                            // BABY COIL 10
                            $slttomain[$tempa][10] += floatval(($slt[$i][16] == "") ? 0 : floatval(($slt[$i][16]))*1000);
                            // SCRAP  11                            
                            $slttomain[$tempa][11] += floatval(($slt[$i][17] == "") ? 0 : floatval(($slt[$i][17]))*1000);
                            //  SS 12
                            $slttomain[$tempa][12] += floatval(($slt[$i][18] == "") ? 0 : floatval(($slt[$i][18]))*1000);
                            // WEIGTH BALANCE
                            $wb = (floatval($slttomain[$tempa][7]) - floatval($slttomain[$tempa][8]) - floatval($slttomain[$tempa][9]) - floatval($slttomain[$tempa][10]) - floatval($slttomain[$tempa][11]) - floatval($slttomain[$tempa][12]));
                            $slttomain[$tempa][13] = number_format((float) $wb, 3, ".", "");
                        } elseif ($slt[$i][3] == "HOLD SLT") {
                            // BABY COIL 10
                            $slttomain[$tempa][10] += floatval(($slt[$i][16] == "") ? 0 : floatval(($slt[$i][16]))*1000);
                            // SCRAP  11                            
                            $slttomain[$tempa][11] += floatval(($slt[$i][17] == "") ? 0 : floatval(($slt[$i][17]))*1000);
                            //  SS 12
                            $slttomain[$tempa][12] += floatval(($slt[$i][18] == "") ? 0 : floatval(($slt[$i][18]))*1000);
                            // WEIGTH BALANCE
                            $wb = (floatval($slttomain[$tempa][7]) - floatval($slttomain[$tempa][8]) - floatval($slttomain[$tempa][9]) - floatval($slttomain[$tempa][10]) - floatval($slttomain[$tempa][11]) - floatval($slttomain[$tempa][12]));
                            $slttomain[$tempa][13] = number_format((float) $wb, 3, ".", "");
                        } elseif ($slt[$i][3] == "WH") {
                            if($i!=$countslt-1){
                                if (substr($slt[$i+1][5], 0, 1) == "E") {
                                    $coilnumber1 = substr($slt[$i+1][5], 0, 8);
                                } elseif (substr($slt[$i+1][5], 0, 1) == "G") {
                                    $coilnumber1 = substr($slt[$i+1][5], 0, 8);
                                } elseif (substr($slt[$i+1][5], 0, 1) == "H") {
                                    $coilnumber1 = substr($slt[$i+1][5], 0, 8);
                                } elseif (substr($slt[$i+1][5], 0, 1) == "L") {
                                    $coilnumber1 = substr($slt[$i+1][5], 0, 12);
                                } elseif (substr($slt[$i+1][5], 0, 1) == "T") {
                                    $coilnumber1 = substr($slt[$i+1][5], 0, 11);
                                } elseif (substr($slt[$i+1][5], 0, 1) == "V") {
                                    $coilnumber1 = substr($slt[$i+1][5], 0, 8);
                                } elseif (substr($slt[$i+1][5], 0, 1) == "X") {
                                    $coilnumber1 = substr($slt[$i+1][5], 0, 8);
                                }
                                if($i!=0){
                                    if (substr($slt[$i-1][5], 0, 1) == "E") {
                                        $coilnumber2 = substr($slt[$i-1][5], 0, 8);
                                    } elseif (substr($slt[$i-1][5], 0, 1) == "G") {
                                        $coilnumber2 = substr($slt[$i-1][5], 0, 8);
                                    } elseif (substr($slt[$i-1][5], 0, 1) == "H") {
                                        $coilnumber2 = substr($slt[$i-1][5], 0, 8);
                                    } elseif (substr($slt[$i-1][5], 0, 1) == "L") {
                                        $coilnumber2 = substr($slt[$i-1][5], 0, 12);
                                    } elseif (substr($slt[$i-1][5], 0, 1) == "T") {
                                        $coilnumber2 = substr($slt[$i-1][5], 0, 11);
                                    } elseif (substr($slt[$i-1][5], 0, 1) == "V") {
                                        $coilnumber2 = substr($slt[$i-1][5], 0, 8);
                                    } elseif (substr($slt[$i-1][5], 0, 1) == "X") {
                                        $coilnumber2 = substr($slt[$i-1][5], 0, 8);
                                    }
                                }else{
                                    $coilnumber2="";
                                }
                            }
                            // COIL NUMBER
                            $slttomain[$tempa][1] = $slt[$i][5];
                            // WIEGTH  7
                            if($i!=0 and $i<$countslt-1){
                                if($slt[$i][13]!="" and ($slt[$i+1][3] == "BAL" or $slt[$i+1][3] == "nav" or  $slt[$i+1][3] == "RM" or $slt[$i+1][3] == "WH KW 2" or $slt[$i+1][3] == "HOLD SLT" or $slt[$i+1][3] == "WAIT MULTI" or $slt[$i+1][3] == "RR ALLOCATED" or $slt[$i+1][3] == "STOCK RR") and $coilnumber==$coilnumber1 and $slt[$i+1][13]==""){
                                    $w = (floatval($slt[$i][13]) - floatval($slt[$i+1][14]) - ((($slt[$i+1][16]=="") ? 0 : floatval($slt[$i+1][16])) - (($slt[$i+1][17]=="") ? 0 : floatval($slt[$i+1][17])) - (($slt[$i+1][18]=="") ? 0 : floatval($slt[$i+1][18]))))*1000;
                                    $slttomain[$tempa][7] = floatval($slttomain[$tempa][7]) + $w;
                                }elseif($slt[$i][13]=="" and $coilnumber==$coilnumber2 and ($slt[$i-1][3] == "BAL" or $slt[$i-1][3] == "nav" or  $slt[$i-1][3] == "RM" or $slt[$i-1][3] == "WH KW 2" or $slt[$i-1][3] == "HOLD SLT" or $slt[$i-1][3] == "WAIT MULTI" or $slt[$i-1][3] == "RR ALLOCATED" or $slt[$i-1][3] == "STOCK RR") and $slt[$i-1][13]!=""){
                                    $w = (floatval($slt[$i-1][13]) - floatval($slt[$i-1][14]) - (($slt[$i-1][16]=="") ? 0 : floatval($slt[$i-1][16])) - (($slt[$i-1][17]=="") ? 0 : floatval($slt[$i-1][17])) - (($slt[$i-1][18]=="") ? 0 : floatval($slt[$i-1][18])))*1000;
                                    $slttomain[$tempa][7] = floatval($slttomain[$tempa][7]) + $w;
                                }else{
                                    $slttomain[$tempa][7] = (floatval($slttomain[$tempa][7]) + floatval($slt[$i][13])*1000);
                                }
                            }elseif($i==0){
                                if($slt[$i][13]!="" and ($slt[$i+1][3] == "BAL" or $slt[$i+1][3] == "nav" or  $slt[$i+1][3] == "RM" or $slt[$i+1][3] == "WH KW 2" or $slt[$i+1][3] == "HOLD SLT" or $slt[$i+1][3] == "WAIT MULTI" or $slt[$i+1][3] == "RR ALLOCATED" or $slt[$i+1][3] == "STOCK RR") and $coilnumber==$coilnumber1 and $slt[$i+1][13]==""){
                                    $w = (floatval($slt[$i][13]) - floatval($slt[$i+1][14]) - ((($slt[$i+1][16]=="") ? 0 : floatval($slt[$i+1][16])) - (($slt[$i+1][17]=="") ? 0 : floatval($slt[$i+1][17])) - (($slt[$i+1][18]=="") ? 0 : floatval($slt[$i+1][18]))))*1000;
                                    $slttomain[$tempa][7] = floatval($slttomain[$tempa][7]) + $w;
                                }else{
                                    $slttomain[$tempa][7] = (floatval($slttomain[$tempa][7]) + floatval($slt[$i][13])*1000);
                                }
                            }else{
                                if($slt[$i][13]=="" and $coilnumber==$coilnumber2 and ($slt[$i-1][3] == "BAL" or $slt[$i-1][3] == "nav" or  $slt[$i-1][3] == "RM" or $slt[$i-1][3] == "WH KW 2" or $slt[$i-1][3] == "HOLD SLT" or $slt[$i-1][3] == "WAIT MULTI" or $slt[$i-1][3] == "RR ALLOCATED" or $slt[$i-1][3] == "STOCK RR") and $slt[$i-1][13]!=""){
                                    $w = (floatval($slt[$i-1][13]) - floatval($slt[$i-1][14]) - ((($slt[$i-1][16]=="") ? 0 : floatval($slt[$i-1][16])) - (($slt[$i-1][17]=="") ? 0 : floatval($slt[$i-1][17])) - (($slt[$i-1][18]=="") ? 0 : floatval($slt[$i-1][18]))))*1000;
                                    $slttomain[$tempa][7] = floatval($slttomain[$tempa][7]) + $w;
                                }else{
                                    $slttomain[$tempa][7] = (floatval($slttomain[$tempa][7]) + floatval($slt[$i][13])*1000);
                                }
                            }
                            // OUTPUT WEIGTH 8
                            $slttomain[$tempa][8] += floatval(($slt[$i][14])*1000);
                            // BABY COIL 10
                            $slttomain[$tempa][10] += floatval(($slt[$i][16] == "") ? 0 : floatval(($slt[$i][16]))*1000);
                            // SCRAP  11                            
                            $slttomain[$tempa][11] += floatval(($slt[$i][17] == "") ? 0 : floatval(($slt[$i][17]))*1000);
                            //  SS 12
                            $slttomain[$tempa][12] += floatval(($slt[$i][18] == "") ? 0 : floatval(($slt[$i][18]))*1000);
                            // WEIGTH BALANCE
                            $wb = (floatval($slttomain[$tempa][7]) - floatval($slttomain[$tempa][8]) - floatval($slttomain[$tempa][9]) - floatval($slttomain[$tempa][10]) - floatval($slttomain[$tempa][11]) - floatval($slttomain[$tempa][12]));
                            $slttomain[$tempa][13] = number_format((float) $wb, 3, ".", "");
                        }
                    }
                }
            }
        }
        // for ($i = 0; $i < count($slttomain);$i++){
        //     if($slttomain[$i][7]-$slttomain[$i][8]>1000){
        //         $slttomain[$i][7]=$slttomain[$i][8]-$slttomain[$i][9]-$slttomain[$i][10]-$slttomain[$i][11]-$slttomain[$i][12];
        //         $slttomain[$i][13] = $slttomain[$i][7] - $slttomain[$i][8] - $slttomain[$i][9] - $slttomain[$i][10] - $slttomain[$i][11] - $slttomain[$i][12];
        //     }
        // }
        $seqno = 0;
        if ($slttomain != []) {
            for ($i = 0; $i < count($slttomain); $i++) {
                // for($u = 0; $u < count($slttomain[$i]); $u++){
                $querytouploadmain = "INSERT INTO tbl_report(Seq,Lot,Coil_Number,Mother_Coil,Grade,Finish,Thickness,Width,Material_Processed,PRIME_SLT,KW2,BabyCoil,Scrap,SS,Weighing_Balance,tanggal) 
                    VALUES ('" . $seqno . "','" . $slttomain[$i][0] . "','" . $slttomain[$i][1] . "','" . $slttomain[$i][2] . "','" . $slttomain[$i][3] . "','" . $slttomain[$i][4] . "','" . $slttomain[$i][5] . "','" . $slttomain[$i][6] . "','" . $slttomain[$i][7] . "','" . $slttomain[$i][8] . "','" . $slttomain[$i][9] . "','" . $slttomain[$i][10] . "','" . $slttomain[$i][11] . "','" . $slttomain[$i][12] . "','" . $slttomain[$i][13] . "','".$periode."')";
                $reslutuploadmain = mysqli_query($conn, $querytouploadmain);
                $seqno++;
            }
            echo '<script>alert("Berhasil menambahkan data."); document.location="data-report.php";</script>';
        }
        
    }
}

?>
<div id="wrapper" class="wrapper-content">
    <?php        
        include "sidebar.php";
        include "database/koneksi.php";
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
        <div class="container">
            <div class="login-page">
                <div class="container">
                    <div class="row">
                        <div class="col-lg-10 offset-lg-1 mt-5">
                            <h3 class="mb-3" style="color:#466d69">Import Excel</h3>
                            <div class="bg-white shadow rounded">
                                <div class="row">
                                    <div class="col-md-6 pe-0">
                                        <div class="form-left h-100 py-5 px-5">
                                            <form method="POST" action="" class="row g-4" name="frmExcelImport" id="frmExcelImport" enctype="multipart/form-data">
                                                <div class="row">
                                                    <label><span class="text-dark">Choose mounth and year for the periode :</span></label>
                                                    <div class="col-sm-6">
                                                        <select class="form-control " name="bulan">
                                                                <option value="" selected='selected'>Bulan
                                                                </option>
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
                                                    <div class="col-sm-6">
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
                                                    <div class="col-sm-13">
                                                        <label><span class="text-dark">Choose an excel file :</span></label>
                                                        <div class="input-group">
                                                            <input type="file" class="form-control" name="file" id="file" accept=".xls,.xlsx">
                                                        </div> 
                                                    </div>
                                                    <div>
                                                    <br>
                                                    <button type="submit" id="submit" name="import"
                                                      class="btn btn-submit"  style="background :#466d69; color:#E9E8E8;">Import
                                                    </button>
                                                    </div>
                                                </div>
                                                   
                                            </form>
                                        </div>
                                    </div>
                                    <div class="col-md-6 ps-0 d-none d-md-block">
                                        <div class="form-right h-100 text-black text-center pt-5 rounded shadow" style= "background-color: #466d69;">
                                            <div class="row justify-content-center">
                                                <div class="col-11">
                                                    <div class="card mb-5">
                                                        <div align="center" class="mt-3 mb-3">
                                                            <h4 align="center">Total Records Per Grade</h4>
                                                            <br>
                                                            <canvas id="myChart" width="450" height="300"></canvas>
                                                        </div>   
                                                    </div>
                                                </div>
                                             </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<script>
const data = {
  labels: [
    <?php
        include 'database/koneksi.php';
        $sql_pendapatan = "SELECT Grade, COUNT(*) AS Total FROM `tbl_report` GROUP BY Grade";
        $hasil_pendapatan = mysqli_query($koneksi, $sql_pendapatan);
        if ($hasil_pendapatan == false){
            echo("Error description: ". mysqli_error($koneksi));die;
        }
        if (mysqli_num_rows($hasil_pendapatan) > 0){
            while ($row_pendapatan = mysqli_fetch_assoc($hasil_pendapatan)){
                echo "'".str_replace("'", "", $row_pendapatan['Grade'])."',";
            }
        }      
    ?>
  ],
  datasets: [{
    label: 'Total Records',
    data: [
        <?php
            $hasil_pendapatan = mysqli_query($koneksi, $sql_pendapatan);
            if ($hasil_pendapatan == false){
                echo("Error description: ". mysqli_error($koneksi));die;
            }
            if (mysqli_num_rows($hasil_pendapatan) > 0){
                while ($row_pendapatan = mysqli_fetch_assoc($hasil_pendapatan)){
                    echo "'".$row_pendapatan['Total']."',";
                }
            }      
        ?>
    ],
    borderWidth: 1,
    tension: 0.4,
    fill:true
  }]
};

const config = {
  type: 'pie',
  data: data,
  options: {
        responsive: false,
        
    }
};

const myChart = new Chart(document.getElementById('myChart'), config);
</script>
</body>
</html>
