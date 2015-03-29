
<script src="js/jquery.maskedinput.js"></script>
<script type="text/javascript">
      $(document).ready(function() {
        $("#waktu_datang").mask("99:99:99")
        $("#waktu_pulang").mask("99:99:99")
      });
</script>  

<?php
if(isset($_POST['tambahkan'])){
	$id_pegawai=$_POST['id_pegawai'];
	$tanggal=$_POST['tanggal'];
	$explode=explode('-', $tanggal);
	$bulan=$explode[1];
	$tahun=$explode[0];
	$datang=$_POST['datang'];
	$pulang=$_POST['pulang'];
	$keterangan=$_POST['keterangan'];
	$alasan=$_POST['alasan'];
	$input=mysql_query("INSERT INTO absensi values('NULL','$id_pegawai','$datang','$pulang','$tanggal','$bulan','$tahun','$keterangan','$alasan')");
	if($input){
		header("location:?page=presensi");
	}else{
		echo "<script>alert('Gagal input');javascript:history.go(-1)</script>";
	}
	
}else{
?>
<h5>Input Presensi</h5>
<div id='halaman' style="overflow:auto;">
<?php
$id_pegawai=$_GET['id_pegawai'];
$tanggal=$_GET['tanggal'];
$tampil_nama=mysql_fetch_array(mysql_query("SELECT nama from pegawai where id_pegawai='$id_pegawai' limit 1"));
$tampil_pengaturan=mysql_fetch_array(mysql_query("SELECT*FROM pengaturan where status='1'"));
?>	
<form action='?page=tambah_presensi' method='post'>
	<input type='hidden' name='id_pegawai' value='<?php echo"$id_pegawai";?>'>
<div class='row'>
	<div class='large-4 columns'>
		<label>Nama</label>
		<input type='text' value='<?php echo"$tampil_nama[nama]";?>' disabled>
	</div>
</div>
<div class='row'>
	<div class='large-3 columns'>
		<label>Tanggal</label>
		<input type='text' name='tanggal' value='<?php echo"$tanggal";?>'>
	</div>
	
	<div class='large-3 columns'>
		<label>Waktu Datang</label>
		<input type='text' name='datang' id="waktu_datang" value='<?php echo"$tampil_pengaturan[jam_masuk]";?>'>
	</div>
	<div class='large-3 columns'>
		<label>Waktu Pulang</label>
		<input type='text' name='pulang' id="waktu_pulang" value='<?php echo"$tampil_pengaturan[jam_pulang]";?>'>
	</div>
	<div class='large-3 columns'>
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
      		<textarea name='alasan'>

      		</textarea>
    	</div>
</div>
<div class='row'>
		<div class="larger-2 columns">
			<input type="submit" value="Input" class="tiny small button radius" name='tambahkan'/>
			<a href="?page=presensi" class="tiny button small">Back</a>
		</div>  		
</div>
</form>
</div>

<?php

}
?>