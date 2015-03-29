<?php
$id_pegawai=$_GET['id_pegawai'];
if($_GET['page']=='hapus_pegawai')
{
	$hapus=mysql_query("DELETE from pegawai where id_pegawai='$id_pegawai' limit 1");
		if($hapus){
			header("location:?page=pegawai");
		}else{
			echo"<script>alert('Berhasil dihapus');javascript:history.go(-1)</script>";	
		}
}else if($_GET['page']=='hapus_divisi'){
		$id_divisi=$_GET['id_divisi'];
		$hapus=mysql_query("DELETE from divisi where id_divisi='$id_divisi' limit 1");
		if($hapus){
			header("location:?page=divisi");
		}else{
			echo"<script>alert('Berhasil dihapus');javascript:history.go(-1)</script>";	
		}
}else{
		$id_kepegawaian=$_GET['id_kepegawaian'];
		$hapus=mysql_query("DELETE from status_pegawai where id_status_pegawai='$id_kepegawaian' limit 1");
		if($hapus){
			header("location:?page=kepegawaian");
		}else{
			echo"<script>alert('Berhasil dihapus');javascript:history.go(-1)</script>";	
		}
}


?>