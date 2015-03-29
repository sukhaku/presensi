<script src="js/jquery.maskedinput.js"></script>
<script type="text/javascript">
      $(document).ready(function() {
        $("#no_hp").mask("999999999999")
      });
</script>  
<?php
if($_GET['page']=='tambah_pegawai'){
	if(isset($_POST['input_pegawai'])){
		$nama=$_POST['nama'];
		$username=$_POST['username'];
		$password=md5($_POST['password']);
		$jk=$_POST['jk'];
		$alamat=$_POST['alamat'];
		$no_hp=$_POST['no_hp'];
		$divisi=$_POST['divisi'];
		$kepegawaian=$_POST['kepegawaian'];
		$status=$_POST['status'];
		
		$masukan_pegawai=mysql_query("INSERT INTO pegawai values('','$username','$divisi','$kepegawaian','$nama','$password','$jk','$alamat','$no_hp','$status')");
		if($masukan_pegawai){
			header("location:?page=pegawai");
		}else{
		echo"<script>alert('gagal ditambahkan');javascript:history.go(-1)</script>";			
		}		
		
	}else{
?>
<h5>Tambah Pegawai</h5>
<div id='halaman'>
<form action='?page=tambah_pegawai' method='post'>
	<div class="row">
    	<div class="large-5 columns">
      		<label>Nama</label>
      		<input type="text" placeholder="Isikan nama lengkap" name="nama"/>
    	</div>
  	</div>
  	<div class="row">
  		<div class="large-3 columns">
  			<label>Username</label>
  			<input type='text' placeholder='Isikan username' name="username">
  		</div>
  	</div>	
  	<div class="row">
  		<div class="large-4 columns">
  			<label>Password</label>
  			<input type='password' placeholder='Isikan password' name="password">
  		</div>
  	</div>	
  	<div class="row">
    	<div class="large-6 columns">
	      <label>Jenis Kelamin</label>
	      <input type="radio" name="jk" value="L" ><label >L</label>
	      <input type="radio" name="jk" value="P" ><label >P</label>
	    </div>
  	</div>

  	<div class="row">
  		<div class="large-5 columns">
  			<label>Alamat</label>
	  		<textarea name='alamat'>

	  		</textarea>
  		</div>
 	</div>
 	<div class="row">
  		<div class="large-3 columns">
  			<label>No.Hp</label>
  			<input type='text' placeholder='Isikan no hp' name='no_hp' id='no_hp'>
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
			<input type="submit" value="Input" class="tiny small button radius" name='input_pegawai'/>
			<a href="?page=pegawai" class="tiny button small">Back</a>
		</div>  		
  	</div>
</form>

</div>


<?php
	}

	///untuk halaman divisi
}else if($_GET['page']=='tambah_divisi'){
?>
	<?php
	if(isset($_POST['input_divisi'])){
		$nama_divisi=$_POST['divisi'];
		$input_divisi=mysql_query("INSERT INTO divisi values('','$nama_divisi')");
		if($input_divisi){
			header("location:?page=divisi");
		}else{
			echo"<script>alert('Gagal input');javascript:history.go(-1)</script>";
		}
	}
	?>
	<h5>Tambah Divisi</h5>
	<div id='halaman'>
	<form action='?page=tambah_divisi' method='post'>
		<div class="row">
	    	<div class="large-5 columns">
	      		<label>Nama Divisi</label>
	      		<input type="text" placeholder="Isikan nama divisi" name="divisi"/>
	    	</div>
	  	</div>
	  	<div class='row'>
			<div class="larger-2 columns">
				<input type="submit" value="Input" class="tiny small button radius" name='input_divisi'/>
				<a href="?page=divisi" class="tiny button small">Back</a>
			</div>  		
	  	</div>
	</form>

	</div>


<?php
}else{	
	?>
	<?php
	if(isset($_POST['input_kepegawaian'])){
		$nama_kepegawaian=$_POST['nama_kepegawaian'];
		$input_kepegawaian=mysql_query("INSERT INTO status_pegawai values('','$nama_kepegawaian')");
		if($input_kepegawaian){
			header("location:?page=kepegawaian");
		}else{
			echo"<script>alert('Gagal input');javascript:history.go(-1)</script>";
		}
	}
	?>
	<h5>Tambah Jenis Pegawai</h5>
	<div id='halaman'>
	<form action='?page=tambah_kepegawaian' method='post'>
		<div class="row">
	    	<div class="large-5 columns">
	      		<label>Jenis Pegawai</label>
	      		<input type="text" placeholder="Isikan jenis pegawai" name="nama_kepegawaian"/>
	    	</div>
	  	</div>
	  	<div class='row'>
			<div class="larger-2 columns">
				<input type="submit" value="Input" class="tiny small button radius" name='input_kepegawaian'/>
				<a href="?page=kepegawaian" class="tiny button small">Back</a>
			</div>  		
	  	</div>
	</form>

	</div>


<?php
}
?>