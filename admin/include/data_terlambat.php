



<h5>Data Absensi</h5>
<div id='halaman' style="overflow:auto;">

<?php
if($_GET['page']=='cari_absen'){
$tahuns=date("Y");	
$bulan=$_POST['bulan'];
$tahun=$_POST['tahun'];
$divisi=$_POST['divisi'];	
?>
<form action="?page=cari_absen" method="post">
	<div class="row">
	    <div class="large-3 columns">
	      <label>Bulan</label>
	      	 <?php
		      $bulon=array("","Januari","Februari","Maret","April","Mei","Juni","Juli","Agustus","Sepetember","Oktober","November","Desember");
		      ?>
		      <select name="bulan">
		      	<?php
		      		for($k=1;$k<=12;$k++){
		      			if($bulan==$k){
		      			echo "<option value='$k' selected>$bulon[$k]</option>";
		      			}else{
		      				echo "<option value='$k'>$bulon[$k]</option>";	
		      			}
		      		}
		      	?>  
		      </select>
	    </div>
	    <div class="large-3 columns">
	      <label>Tahun</label>
	         <select name='tahun'>
		      	<?php
		    	for($tahon=2007;$tahon<=$tahuns;$tahon++){
		    		if($tahon==$tahun){
		    		echo"<option value='$tahon' selected>$tahon</option>";
		    		}else{
		    		echo"<option value='$tahon'>$tahon</option>";		
		    		}
		    	}
		    	?>
		      </select>
	    </div>
	    <div class="large-3 columns">
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
	     <div class="large-3 columns">
	    
	    </div>
    </div>
 
	<div class='row'>
		<div class="larger-2 columns">
			<input type="submit" value="Lihat" class="tiny small button radius" name='cari_absen'/>
		</div>  		
  	</div>
</form>
<?php
include"include/fungsi_bulan.php";
?>
<div class='row'>
	<div class='larger-3 columns'>
	<h6><b>Absensi <?php echo"Bulan $indo Tahun $tahun";?></b></h6>
	</div>
</div>
<table class='display' border='1'>
<thead>
	<tr>
		<td width='5'>No</td>
		<td>Nama</td>
		<?php
		$ambil_tanggals=mysql_query("SELECT distinct tanggal from absensi where bulan='$bulan' and tahun='$tahun' order by tanggal asc");
		while($tampil_tanggals=mysql_fetch_array($ambil_tanggals)){
				$dapet_tanggals=$tampil_tanggals['tanggal'];
				$explode=explode('-',$dapet_tanggals);
				$tahun=$explode['0'];
				$bulan=$explode['1'];
				$tanggal=$explode['2'];
				echo"<td width='10' style='text-align:center;'>$tanggal</td>";
		}
		?>
	</tr>
</thead>
<tbody>
	<?php
	$no=1;
	$ambil_pegawai=mysql_query("SELECT*from pegawai where id_divisi='$divisi'");
	while($tampil_pegawai=mysql_fetch_array($ambil_pegawai)){
		$id_pegawai=$tampil_pegawai['id_pegawai'];
	?>	
	<tr>
		<td width='5'><?php echo"$no";?></td>
		<td><?php echo"$tampil_pegawai[nama]";?></td>
		<?php
	
			$ambil_tanggal=mysql_query("SELECT distinct tanggal from absensi where bulan='$bulan' and tahun='$tahun' order by tanggal asc");
			while($tampil_tanggal=mysql_fetch_array($ambil_tanggal)){
				$tgl=$tampil_tanggal['tanggal'];
				$ambil_presensi=mysql_query("SELECT*FROM absensi where id_pegawai='$id_pegawai' and tanggal='$tgl'");	
				$tampil_presensi=mysql_fetch_array($ambil_presensi);
				$id_ket=$tampil_presensi['keterangan'];

				$ambil_keterangan=mysql_fetch_array(mysql_query("select*from keterangan where id_keterangan='$id_ket'"));
				$view=$ambil_keterangan['keterangan'];
				$cek=mysql_num_rows($ambil_presensi);
				if($cek<=0){
					echo"<td bgcolor='#802126'></td>";
				}else{
					if($id_ket=='03'){
					echo"<td bgcolor='#FFFF66' color='orange'>$view, $tampil_presensi[alasan]</td>";
					}else if($id_ket=='02'){
					echo"<td bgcolor='#FFFF66' color='orange'>$view, $tampil_presensi[alasan]</td>";
					}else if($id_ket=='04'){
					echo"<td bgcolor='#FF9933' color='orange'>$view, $tampil_presensi[alasan]</td>";				
					}else{
					echo"<td bgcolor='#66FF33' color='white'>On time</td>";					
					}
				}
			}
		
				?>
				


	</tr>	
	<?php
	$no++;
	}


	?>




</tbody>




</table>























<?php
}else{
//Untuk default tampilan presensi awal
$tanggal_datang=gmdate("Y-m-d",time()+60*60*7);
				$explode=explode('-',$tanggal_datang);
				$bulans=$explode[1];
				$tahuns=$explode[0];
?>
<form action="?page=cari_absen" method="post">
	<div class="row">
	    <div class="large-3 columns">
	      <label>Bulan</label>
	      	 <?php
		      $bulan=array("","Januari","Februari","Maret","April","Mei","Juni","Juli","Agustus","Sepetember","Oktober","November","Desember");
		      ?>
		      <select name="bulan">
		      	<?php
		      		for($k=1;$k<=12;$k++){
		      			if($bulans==$k){
		      			echo "<option value='$k' selected>$bulan[$k]</option>";
		      			}else{
		      				echo "<option value='$k'>$bulan[$k]</option>";	
		      			}
		      		}
		      	?>  
		      </select>
	    </div>
	    <div class="large-3 columns">
	      <label>Tahun</label>
	         <select name='tahun'>
		      	<?php
		    	for($tahun=2007;$tahun<=$tahuns;$tahun++){
		    		if($tahun==$tahuns){
		    		echo"<option value='$tahun' selected>$tahun</option>";
		    		}else{
		    		echo"<option value='$tahun'>$tahun</option>";		
		    		}
		    	}
		    	?>
		      </select>
	    </div>
	    <div class="large-3 columns">
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
	     <div class="large-3 columns">
	    
	    </div>
    </div>
 
	<div class='row'>
		<div class="larger-2 columns">
			<input type="submit" value="Lihat" class="tiny small button radius" name='cari_absen'/>
		</div>  		
  	</div>
</form>
<div class='row'>
	<div class='larger-3 columns'>
	<h6><b>Absensi 
		<?php
		$tanggal_datang=gmdate("Y-m-d",time()+60*60*7);
				$explode=explode('-',$tanggal_datang);
				$bulan=$explode[1];
				$tahun=$explode[0];
				include"include/fungsi_bulan.php";
	 echo"Bulan $indo Tahun $tahun";
	 ?>
	</b>
	</h6>
	</div>
</div>
<table class='display' border='1'>
<thead>
	<tr>
		<td width='5'>No</td>
		<td>Nama</td>
		<?php
		$ambil_tanggals=mysql_query("SELECT distinct tanggal from absensi where bulan='$bulan' and tahun='$tahun' order by tanggal asc");
		while($tampil_tanggals=mysql_fetch_array($ambil_tanggals)){
				$dapet_tanggals=$tampil_tanggals['tanggal'];
				$explode=explode('-',$dapet_tanggals);
				$tahun=$explode['0'];
				$bulan=$explode['1'];
				$tanggal=$explode['2'];
				echo"<td width='10' style='text-align:center;'>$tanggal</td>";
		}
		?>
	</tr>
</thead>
<tbody>
	<?php
	$no=1;
	$ambil_pegawai=mysql_query("SELECT*from pegawai");
	while($tampil_pegawai=mysql_fetch_array($ambil_pegawai)){
		$id_pegawai=$tampil_pegawai['id_pegawai'];
	?>	
	<tr>
		<td width='5'><?php echo"$no";?></td>
		<td><?php echo"$tampil_pegawai[nama]";?></td>
		<?php
	
			$ambil_tanggal=mysql_query("SELECT distinct tanggal from absensi where bulan='$bulan' and tahun='$tahun' order by tanggal asc");
			while($tampil_tanggal=mysql_fetch_array($ambil_tanggal)){
				$tgl=$tampil_tanggal['tanggal'];
				$ambil_presensi=mysql_query("SELECT*FROM absensi where id_pegawai='$id_pegawai' and tanggal='$tgl'");	
				$tampil_presensi=mysql_fetch_array($ambil_presensi);
				$id_ket=$tampil_presensi['keterangan'];

				$ambil_keterangan=mysql_fetch_array(mysql_query("select*from keterangan where id_keterangan='$id_ket'"));
				$view=$ambil_keterangan['keterangan'];
				$cek=mysql_num_rows($ambil_presensi);
				if($cek<=0){
					echo"<td bgcolor='#802126'></td>";
				}else{
					if($id_ket!='01'){
					echo"<td bgcolor='orange' color='orange'>$view, $tampil_presensi[alasan]</td>";
					}else{
					echo"<td bgcolor='#66FF66' color='orange'>On time</td>";		
					}
				}
			}
		
				?>
				


	</tr>	
	<?php
	$no++;
	}


	?>




</tbody>




</table>


<?php
}

?>
</div>


