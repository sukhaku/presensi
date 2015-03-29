<script src="js/jquery.maskedinput.js"></script>
<script type="text/javascript">
      $(document).ready(function() {
        $("#no_hp").mask("999999999999")
      });
</script> 
<?php
if($_GET['page']=='edit_pegawai'){
	if(isset($_POST['edit_pegawai'])){
		$id_pegawai=$_POST['id_pegawai'];
		$nama=$_POST['nama'];
		$username=$_POST['username'];
		$password=$_POST['password'];
		$jk=$_POST['jk'];
		$alamat=$_POST['alamat'];
		$no_hp=$_POST['no_hp'];
		$divisi=$_POST['divisi'];
		$kepegawaian=$_POST['kepegawaian'];
		$status=$_POST['status'];
		
		$ceks=mysql_num_rows(mysql_query("select password from pegawai where id_pegawai='$id_pegawai' and password='$password'"));
		if($ceks>=1){	
			$edit_pegawai=mysql_query("UPDATE pegawai set username='$username',id_divisi='$divisi',id_status_pegawai='$kepegawaian',nama='$nama',jk='$jk',alamat='$alamat',no_hp='$no_hp',status='$status' where id_pegawai='$id_pegawai' limit 1");
			if($edit_pegawai){
				header("location:?page=pegawai");
			}else{
			echo"<script>alert('gagal diubah')</script>";			
			}		
		}else{
			$passwords=md5($_POST['password']);
			$edit_pegawai=mysql_query("UPDATE pegawai set username='$username',id_divisi='$divisi',id_status_pegawai='$kepegawaian',nama='$nama',password='$passwords',jk='$jk',alamat='$alamat',no_hp='$no_hp',status='$status' where id_pegawai='$id_pegawai' limit 1");
			if($edit_pegawai){
				header("location:?page=pegawai");
			}else{
			echo"<script>alert('gagal diubah')</script>";			
			}
		}

	}else{
	$id_pegawai=$_GET['id_pegawai'];	
	$ambil_pegawai=mysql_query("select*from pegawai,divisi,status_pegawai where pegawai.id_divisi=divisi.id_divisi and pegawai.id_status_pegawai=status_pegawai.id_status_pegawai and id_pegawai='$id_pegawai'");
	$tampil_pegawai=mysql_fetch_array($ambil_pegawai);	
?>
<h5>Edit Pegawai</h5>
<div id='halaman'>
<form action='?page=edit_pegawai' method='post'>
<input type='hidden' name='id_pegawai' value='<?php echo"$_GET[id_pegawai]";?>'/>	
	<div class="row">
    	<div class="large-5 columns">
      		<label>Nama</label>
      		<input type="text" placeholder="Isikan nama lengkap" name="nama" value='<?php echo"$tampil_pegawai[nama]";?>'/>
    	</div>
  	</div>
  	<div class="row">
  		<div class="large-3 columns">
  			<label>Username</label>
  			<input type='text' placeholder='Isikan username' name="username" value='<?php echo"$tampil_pegawai[username]";?>'>
  		</div>
  	</div>	
  	<div class="row">
  		<div class="large-4 columns">
  			<label>Password</label>
  			<input type='password' placeholder='Isikan password' name="password" value='<?php echo"$tampil_pegawai[password]";?>'>
  		</div>
  	</div>	
  	<div class="row">
    	<div class="large-6 columns">
	      <label>Jenis Kelamin</label>
	      <?php 
	      $jenis=$tampil_pegawai['jk'];
	      ?>
	      <input type="radio" name="jk" value="L" <?php if($jenis=='L'){echo"checked";}?> ><label >L</label>
	      <input type="radio" name="jk" value="P" <?php if($jenis=='P'){echo"checked";}?> ><label >P</label>
	    </div>
  	</div>

  	<div class="row">
  		<div class="large-5 columns">
  			<label>Alamat</label>
	  		<textarea name='alamat'>
	  		<?php echo"$tampil_pegawai[alamat]";?>
	  		</textarea>
  		</div>
 	</div>
 	<div class="row">
  		<div class="large-3 columns">
  			<label>No.Hp</label>
  			<input type='text' placeholder='Isikan no hp' name='no_hp' value='<?php echo"$tampil_pegawai[no_hp]";?>'>
  		</div>
  	</div>	
  	<div class="row">
    	<div class="large-4 columns">
	      <label>Divisi</label>
	      <select name="divisi">
	      	<?php
	      	$ambil_divisi=mysql_query("select*from divisi");
	      	while($tampil_divisi=mysql_fetch_array($ambil_divisi)){
	      	?>
	        <option value='<?php echo"$tampil_divisi[id_divisi]"; ?>'><?php echo"$tampil_divisi[nama_divisi]"; ?></option>
	        <?php
	    		}
	        ?>
	      </select>
	    </div>
  	</div>
  	<div class="row">
    	<div class="large-4 columns">
	      <label>Kepegawaian</label>
	      <select name='kepegawaian'>
	       <?php
	      	$ambil_kepegawaian=mysql_query("select*from status_pegawai");
	      	while($tampil_kepegawaian=mysql_fetch_array($ambil_kepegawaian)){
	      	?>
	        <option value='<?php echo"$tampil_kepegawaian[id_status_pegawai]"; ?>'><?php echo"$tampil_kepegawaian[status_pegawai]"; ?></option>
	        <?php
	    		}
	        ?>
	      </select>
	    </div>
  	</div>
  	<div class="row">
    	<div class="large-4 columns">
	      <label>Status</label>
	      <select name="status">
	        <option value="1">Aktif</option>
	        <option value="0">Non Aktif</option>
	      </select>
	    </div>
  	</div>
  	<div class='row'>
		<div class="larger-2 columns">
			<input type="submit" value="Input" class="tiny small button radius" name='edit_pegawai'/>
			<a href="?page=pegawai" class="tiny button small">Back</a>
		</div>  		
  	</div>
</form>

</div>


<?php
	}

	///untuk halaman divisi
}else if($_GET['page']=='edit_divisi'){
?>
	<?php
	if(isset($_POST['edit_divisi'])){
		$id_divisi=$_POST['id_divisi'];
		$nama_divisi=$_POST['divisi'];
		$edit_divisi=mysql_query("UPDATE divisi set nama_divisi='$nama_divisi' where id_divisi='$id_divisi' limit 1");
		if($edit_divisi){
			header("location:?page=divisi");
		}else{
			echo"<script>alert('Gagal ubah');javascript:history.go(-1)</script>";
		}
	}
	$ambil_divisi=mysql_query("select*from divisi");
	$tampil_divisi=mysql_fetch_array($ambil_divisi);
	?>
	<h5>Edit Divisi</h5>
	<div id='halaman'>
	<form action='?page=edit_divisi' method='post'>
		<input type='hidden' name='id_divisi' value='<?php echo"$_GET[id_divisi]";?>'/>
		<div class="row">
	    	<div class="large-5 columns">
	      		<label>Nama Divisi</label> 
	      		<input type="text" placeholder="Isikan nama divisi" name="divisi" value='<?php echo"$tampil_divisi[nama_divisi]";?>'/>
	    	</div>
	  	</div>
	  	<div class='row'>
			<div class="larger-2 columns">
				<input type="submit" value="Input" class="tiny small button radius" name='edit_divisi'/>
				<a href="?page=divisi" class="tiny button small">Back</a>
			</div>  		
	  	</div>
	</form>

	</div>


<?php
}else{	
	?>
	<?php
	if(isset($_POST['edit_kepegawaian'])){
		$id_kepegawaian=$_POST['id_kepegawaian'];
		$nama_kepegawaian=$_POST['nama_kepegawaian'];
		$edit_kepegawaian=mysql_query("UPDATE status_pegawai set status_pegawai='$nama_kepegawaian' where id_status_pegawai='$id_kepegawaian' limit 1");
		if($edit_kepegawaian){
			header("location:?page=kepegawaian");
		}else{
			echo"<script>alert('Gagal input');javascript:history.go(-1)</script>";
		}
	}
	$id_kepegawaian=$_GET['id_kepegawaian'];
	$ambil_kepegawaian=mysql_query("select*from status_pegawai where id_status_pegawai='$id_kepegawaian'");
	$tampil_kepegawaian=mysql_fetch_array($ambil_kepegawaian);
	?>
	<h5>Edit Jenis Pegawai</h5>
	<div id='halaman'>
	<form action='?page=edit_kepegawaian' method='post'>
		<input type='hidden' name='id_kepegawaian' value='<?php echo"$_GET[id_kepegawaian]";?>'/>
		<div class="row">
	    	<div class="large-5 columns">
	      		<label>Jenis Pegawai</label>
	      		<input type="text" placeholder="Isikan jenis pegawai" name="nama_kepegawaian" value='<?php echo"$tampil_kepegawaian[status_pegawai]";?>'/>
	    	</div>
	  	</div>
	  	<div class='row'>
			<div class="larger-2 columns">
				<input type="submit" value="Input" class="tiny small button radius" name='edit_kepegawaian'/>
				<a href="?page=kepegawaian" class="tiny button small">Back</a>
			</div>  		
	  	</div>
	</form>

	</div>


<?php
}
?>