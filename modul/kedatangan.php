<?php
$waktu_datang=gmdate("H:i:s",time()+60*60*7);
$tanggal_datang=gmdate("Y-m-d",time()+60*60*7);
$id_pegawai=$_GET['id_pegawai'];

$ambil_waktu=mysql_query("select*from pengaturan where status='1' order by id_pengaturan asc limit 1");
$datang_kerjo=mysql_fetch_array($ambil_waktu);
$waktu_harus_datang=$datang_kerjo['jam_masuk'];
$waktu_harus_pulang=$datang_kerjo['jam_pulang'];
$patokan="00:00:00";
if($waktu_datang<=$waktu_harus_datang and $waktu_datang>=$patokan){	
	//$masuk_absensi=mysql_query("INSERT INTO absensi values('','$id_pegawai','$waktu_datang','00:00:00','$tanggal_datang','Hadir','-')");
include"modul/tepat_waktu.php";	
}else if($waktu_datang>$waktu_harus_datang and $waktu_datang<=$waktu_harus_pulang){
include"modul/telat.php";	
}else{
	echo"<script>alert('Dianggap tidak hadir!')</script>";
	echo"<script>alert('Sudah lewat batas jam kerja')</script>";
	echo"<meta http-equiv='refresh' content='0; index.php'/>";	
}
?>
