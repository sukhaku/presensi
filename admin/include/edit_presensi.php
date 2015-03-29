
<script src="js/jquery.maskedinput.js"></script>
<script type="text/javascript">
      $(document).ready(function() {
        $("#waktu_datang").mask("99:99:99")
        $("#waktu_pulang").mask("99:99:99")
      });
</script>  

<h5>Edit Presensi</h5>
<div id='halaman' style="overflow:auto;">

<?php
if($_GET['page']=='edit_presensi'){
	if(isset($_POST['input_edit'])){
		$id_presensi=$_POST['id_presensi'];
		$datang=$_POST['datang'];
		$pulang=$_POST['pulang'];
		$keterangan=$_POST['keterangan'];
		$alasan=$_POST['alasan'];
		$edit=mysql_query("UPDATE absensi set datang='$datang',pulang='$pulang',keterangan='$keterangan',alasan='$alasan' where id_absensi='$id_presensi'");
		if($edit){
			header("location:?page=presensi");
		}else{
			echo "<script>alert('Gagal diubah');javascript:history.go(-1)</script>";
		}
	}
	$id_presensi=$_GET['id_presensi'];
	$tampil_presensi=mysql_fetch_array(mysql_query("SELECT*FROM absensi,keterangan,pegawai where absensi.keterangan=keterangan.id_keterangan and absensi.id_pegawai=pegawai.id_pegawai and id_absensi='$id_presensi' limit 1"));	
?>

<form action='?page=edit_presensi' method='post'>
<input type='hidden' name='id_presensi' value='<?php echo"$id_presensi";?>'>	
<div class="row">
    	<div class="large-4 columns">
      		<label>Nama</label>
      		<input type="text" name="nama" value='<?php echo"$tampil_presensi[nama]";?>' disabled/>
    	</div>
</div>
<div class="row">
    	<div class="large-2 columns">
      		<label>Tanggal</label>
      		<input type="text" value='<?php echo"$tampil_presensi[tanggal]";?>' disabled/>
    	</div>
</div>
<div class="row">
    	<div class="large-2 columns">
      		<label>Waktu Datang</label>
      		<input type="text" name="datang" value='<?php echo"$tampil_presensi[datang]";?>' id='waktu_datang'/>
    	</div>
</div>
<div class="row">
    	<div class="large-2 columns">
      		<label>Waktu Pulang</label>
      		<input type="text" name="pulang" value='<?php echo"$tampil_presensi[pulang]";?>' id='waktu_pulang'/>
    	</div>
</div>
<div class="row">
    	<div class="large-3 columns">
	      <label>Keterangan</label>
	      <select name="keterangan">
	      	<?php
	      	$ambil_keterangan=mysql_query("select*from keterangan");
	      	while($tampil_keterangan=mysql_fetch_array($ambil_keterangan)){
	      	?>
	        <option value='<?php echo"$tampil_keterangan[id_keterangan]"; ?>'><?php echo"$tampil_keterangan[keterangan]"; ?></option>
	        <?php
	    		}
	        ?>
	      </select>
	    </div>
</div>
<div class="row">
    	<div class="large-4 columns">
      		<label>Alasan</label>
      		<input type="text" name="alasan" value='<?php echo"$tampil_presensi[alasan]";?>'/>
    	</div>
</div>
<div class='row'>
		<div class="larger-2 columns">
			<input type="submit" value="Edit" class="tiny small button radius" name='input_edit'/>
			<a href='?page=hapus_presensi&id_presensi=<?php echo"$id_presensi";?>' class="tiny button small radius alert">Hapus</a>
			<a href="?page=presensi" class="tiny button small">Back</a>

		</div>  		
</div>






</form>




<?php
}
?>


</div>