<?php
error_reporting(0);
include"config/koneksi.php";
$tanggal_cek=gmdate('Y-m-d',time()+60*60*7);
$data=mysql_query("select*from status_absensi where tanggal='$tanggal_cek' limit 1");
$cek=mysql_num_rows($data);
if($cek<=0){
	include"config/masuk.php";
}else{
include"config/utama.php";
}
?>