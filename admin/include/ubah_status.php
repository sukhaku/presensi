<?php
$id_pegawai=$_GET['id_pegawai'];
$ambil_pegawai=mysql_query("SELECT*FROM pegawai where id_pegawai='$id_pegawai'");
$tampil=mysql_fetch_array($ambil_pegawai);
$tampil_status=$tampil['status'];
	if($tampil_status=='1'){
		$ubah=mysql_query("UPDATE pegawai set status='0' where id_pegawai='$id_pegawai' limit 1");
		header("location:?page=pegawai");
	}else{
			$ubah=mysql_query("UPDATE pegawai set status='1' where id_pegawai='$id_pegawai' limit 1");	
			header("location:?page=pegawai");
	}

?>