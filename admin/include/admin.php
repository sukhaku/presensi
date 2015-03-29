<?php
if($_GET['page']=='tambah_admin'){
	if(isset($_POST['input_admin'])){
		$username=$_POST['username'];
		$password=md5($_POST['password']);
		$level=$_POST['level'];
		$input=mysql_query("insert into admin values('','$username','$password','$level')");
		if($input){
			header("location:?page=admin");
		}else{
			echo"<script>alert('gagal input');javascript:history.go(-1)</script>";
		}
	}
?>

<h5>Tambah Admin</h5>

	<form action='?page=tambah_admin' method='post'>
		<div class="row">
	    	<div class="large-4 columns">
	      		<label>Username</label>
	      		<input type="text" placeholder="Isikan username" name="username"/>
	    	</div>
	  	</div>
	  	<div class="row">
	    	<div class="large-3 columns">
	      		<label>Password</label>
	      		<input type="text" placeholder="Isikan password" name="password"/>
	    	</div>
	  	</div>
	  	
	  	<div class="row">
	    	<div class="large-3 columns">
		      <label>Level</label>
		      <select name="level">
	        <option value="0">Admin</option>
	        <option value="1">Super Admin</option>
		      </select>
		    </div>
	  	</div>
	  		<div class='row'>
			<div class="larger-2 columns">
				<input type="submit" value="Input" class="tiny small button radius" name='input_admin'/>
				<a href="?page=tambah_admin" class="tiny button small">Back</a>
			</div>  		
	  	</div>
	</form>


<?php
}else if($_GET['page']=='admin')
{

?>
<h5>Data Admin</h5>
<div id='halaman'>
<table class='display'>
<thead>
	<tr>
<th>No</th>
		<th>Username</th>
		<th>Password</th>
		<th>Level</th>
		<th>Operasi</th>
	</tr>
</thead>
<tbody>
	<?php
	$no=1;
	$ambil_admin=mysql_query("SELECT*FROM admin");
	while($tampil_admin=mysql_fetch_array($ambil_admin)){
		echo"
		<tr>
		<td>$no</td>
		<td>$tampil_admin[username]</td>
		<td>$tampil_admin[password]</td>";

		$level=$tampil_admin['level'];
		if($level=='1'){
			echo"<td>Super Admin</td>";
		}else{
				echo"<td>Admin</td>";	
		}
		echo"<td><a href='?page=edit_admin&id_admin=$tampil_admin[id_admin]'><img src='images/valid.gif'/></a> | <a href='?page=hapus_admin&id_admin=$tampil_admin[id_admin]'><img src='images/unvalid.gif'/></a></td>
		</tr>
		";
		$no++;
	}
	?>
</tbody>	
</table>
<br>	
<a href="?page=tambah_admin" class="tiny button small">Tambah</a>
</div>
<?php
}else if($_GET['page']=='hapus_admin'){
	$id_admin=$_GET['id_admin'];
	$hapus=mysql_query("delete from admin where id_admin='$id_admin'");
	if($hapus){
		header("location:?page=admin");
	}else{
		echo"<script>alert('Gagal hapus');javascript:history.go(-1)</script>";
	}

}else{
	if(isset($_POST['edit_admin'])){
		$id_admin=$_POST['id_admin'];
		$username=$_POST['username'];
		$password=$_POST['password'];
		$level=$_POST['level'];
		$cek=mysql_num_rows(mysql_query("select password from admin where id_admin='$id_admin' and password='$password'"));
		if($cek>=1){
			$ubah=mysql_query("UPDATE admin set username='$username',level='$level' where id_admin='$id_admin'");
				if($ubah){
			header("location:?page=admin");
			}else{
				echo"<script>alert('Gagal diubah!!');javascript:history.go(-1)</script>";
			}
		}else{
			$passwords=md5($_POST['password']);
			$ubah=mysql_query("UPDATE admin set username='$username',password='$passwords',level='$level' where id_admin='$id_admin'");
				if($ubah){
			header("location:?page=admin");
			}else{
				echo"<script>alert('Gagal diubah!!');javascript:history.go(-1)</script>";
			}
		}
	}	
	$id_admin=$_GET['id_admin'];
	$edit_admin=mysql_query("select*from admin where id_admin='$id_admin'");
	$tampil_admin=mysql_fetch_array($edit_admin);
?>
<h5>Edit Admin</h5>
	<div id='halaman'>
	<form action='?page=edit_admin' method='post'>
		<input type='hidden' name='id_admin' value='<?php echo"$id_admin";?>'/>
		<div class="row">
	    	<div class="large-5 columns">
	      		<label>Username</label> 
	      		<input type="text" name="username" value='<?php echo"$tampil_admin[username]";?>'/>
	    	</div>
	  	</div>
	  	<div class="row">
	    	<div class="large-3 columns">
	      		<label>Password</label>
	      		<input type="password" name="password" value='<?php echo"$tampil_admin[password]";?>'/>
	    	</div>
	  	</div>
	  	
	  	<div class="row">
	    	<div class="large-3 columns">
		      <label>Level</label>
		      <select name="level">
	        <option value="0">Admin</option>
	        <option value="1">Super Admin</option>
		      </select>
		    </div>
	  	</div>
	  	<div class='row'>
			<div class="larger-2 columns">
				<input type="submit" value="Input" class="tiny small button radius" name='edit_admin'/>
				<a href="?page=admin" class="tiny button small">Back</a>
			</div>  		
	  	</div>
	</form>

	</div>


<?php
}


?>