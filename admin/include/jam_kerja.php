<script src="js/jquery.maskedinput.js"></script>
<script type="text/javascript">
      $(document).ready(function() {
        $("#jam1").mask("99:99:99")
        $("#jam2").mask("99:99:99")
      });
</script> 

<?php
if($_GET['page']=='tambah_pengaturan'){
	if(isset($_POST['input_kerja'])){
		$jam1=$_POST['jam_1'];
		$jam2=$_POST['jam_2'];
		if(empty($jam1)){
				header("location:?page=jam_kerja");
			}else if(empty($jam2)){
				header("location:?page=jam_kerja");
			}else{
				$input_kerja=mysql_query("INSERT INTO pengaturan values('','$jam1','$jam2','0')");
				if($input_kerja){
					header("location:?page=jam_kerja");
				}else{
					echo"<script>alert('gagal ditambahkan');javascript:history.go(-1)</script>";
				}
			}	
	}else{
?>
<h5>Tambah Jam Kerja</h5>
<div id='halaman'>
<form action="?page=tambah_pengaturan" method="post">
	<div class="row">
    	<div class="large-5 columns">
      		<label>Jam masuk</label>
      		<input type="text" placeholder="Isikan jam masuk kerja" name="jam_1" id="jam1"/>
    	</div>
  	</div>
  	<div class="row">
    	<div class="large-5 columns">
      		<label>Jam pulang</label>
      		<input type="text" placeholder="Isikan jam pulang kerja" name="jam_2" id="jam2"/>
    	</div>
  	</div>
  	<div class='row'>
		<div class="larger-2 columns">
			<input type="submit" value="Input" class="tiny small button radius" name='input_kerja'/>
			<a href="?page=jam_kerja" class="tiny button small">Back</a>
		</div>  		
  	</div>
</form>
</div>


<?php
	}
}else{

?>
<h5>Pengaturan Jam Kerja</h5>
<div id='halaman'>
	<table class="display" >
	<thead>
		<tr>
			<td>No</td>	
			<td>Jam Masuk</td>
			<td>Jam Pulang</td>
			<td>Status</td>
			<td>Operasi</td>
		</tr>			
	</thead>
	<tbody>	
	<?php
	$no=1;
	$ambil_pengaturan=mysql_query("select*from pengaturan order by id_pengaturan asc");
	while($tampil_pengaturan=mysql_fetch_array($ambil_pengaturan)){
	?>
	<tr>

		<td><?php echo"$no";?></td>	
		<td><?php echo"$tampil_pengaturan[jam_masuk]";?></td>	
		<td><?php echo"$tampil_pengaturan[jam_pulang]";?></td>	
		<td>
			<?php
				$status=$tampil_pengaturan['status'];
				if($status=='1'){
					echo"<a href='?page=edit_non&id_pengaturan=$tampil_pengaturan[id_pengaturan]'>Aktif</a>";
				}else{
					echo"<a href='?page=edit_aktif&id_pengaturan=$tampil_pengaturan[id_pengaturan]'>Non Aktif</a>";
				}
			?>

		</td>
		<td>
		<a href='#>'><img src='images/valid.gif'/></a> | <a href='?page=hapus_jam&id_pengaturan=<?php echo"$tampil_pengaturan[id_pengaturan]";?>'><img src='images/unvalid.gif'/></a>
		</td>
	</tr>	
	</tbody>
	<?php
	$no++;
	}
	?>
	</table>

<br>	
<a href="?page=tambah_pengaturan" class="tiny button small">Tambah</a>



</div>
<?php
}
?>