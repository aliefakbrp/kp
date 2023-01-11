<?php 
$hostname = "localhost"; 
$username = "root";
$password = "";
$database = "yield-project";

$koneksi = mysqli_connect($hostname , $username , $password);
if ($koneksi){
	$buka = mysqli_select_db($koneksi , $database);
	if (!$buka){
		echo "tidak terhubung";
	};
}else{
	echo "eror";
}

 ?>