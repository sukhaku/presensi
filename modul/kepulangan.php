<?php
$waktu_pulang=gmdate("H:i:s",time()+60*60*7);
$tanggal_datang=gmdate("Y-m-d",time()+60*60*7);
$id_pegawai=$_GET['id_pegawai'];
$ambil_waktu=mysql_query("select*from pengaturan where status='1' order by id_pengaturan asc limit 1");
$pulang_kerjo=mysql_fetch_array($ambil_waktu);
$waktu_harus_pulang=$pulang_kerjo['jam_pulang'];

if($waktu_harus_pulang<=$waktu_pulang){
	include"modul/pulang.php";
}else{
echo"<script>alert('Belum waktunya pulang !!');javascript:history.go(-1)</script>";	
}
?>