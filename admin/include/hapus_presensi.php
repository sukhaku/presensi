<?php
$id_presensi=$_GET['id_presensi'];
$hapus=mysql_query("DELETE from absensi where id_absensi='$id_presensi'");
if($hapus){
	header("location:?page=presensi");
}else{
	echo "<script>alert('Gagal dihapus')";
}

?>