<?php
$id_pengaturan=$_GET['id_pengaturan'];
if($_GET['page']=='hapus_jam'){
	
	$hapus=mysql_query("DELETE from pengaturan where id_pengaturan='$id_pengaturan' limit 1");
	if($hapus){
		header("location:?page=jam_kerja");
	}else{
		echo"<script>alert('gagal dihapus');javascript:history.go(-1)</script>";
	}

}
	
?>