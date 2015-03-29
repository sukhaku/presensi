<?php
$id_pengaturan=$_GET['id_pengaturan'];

if($_GET['page']=='edit_non')
{
	$cek=mysql_num_rows(mysql_query("SELECT*FROM pengaturan where status='1'"));
	if($cek>1)
	{
		$ubah=mysql_query("UPDATE pengaturan set status='0' where id_pengaturan='$id_pengaturan'");
		if($ubah){
				header("location:?page=jam_kerja");
					
		}else{
			echo"<script>alert('gagal update');javascript:history.go(-1)</script>";
		}

	}else{
		header("location:?page=jam_kerja");
				
	}	

}else{
	
		$ubah=mysql_query("UPDATE pengaturan set status='1' where id_pengaturan='$id_pengaturan'");
		if($ubah){
				header("location:?page=jam_kerja");
		
		}else{
			echo"<script>alert('gagal dihapus');javascript:history.go(-1)</script>";
		}
	

}		
?>