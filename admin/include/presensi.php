<?php
$tanggal_datang=gmdate("Y-m-d",time()+60*60*7);
				$explode=explode('-',$tanggal_datang);
				$bulans=$explode[1];
				$tahuns=$explode[0];
				?>



<h5>Presensi Pegawai</h5>
<div id='halaman' style="overflow:auto;">
<form action="?page=cari_presensi" method="post">
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
			<input type="submit" value="Lihat" class="tiny small button radius" name='cari_presensi'/>
		</div>  		
  	</div>
</form>
<?php
if($_GET['page']=='cari_presensi'){
$bulan=$_POST['bulan'];
$tahun=$_POST['tahun'];
$divisi=$_POST['divisi'];
$hari_kerja=mysql_num_rows(mysql_query("select id_status_absensi from status_absensi where bulan='$bulan' and tahun='$tahun'"));

include"include/fungsi_bulan.php";
?>
<div class='row'>
	<div class='larger-3 columns'>
	<h6><b>Presensi <?php echo"Bulan $indo Tahun $tahun";?></b>||Total hari kerja : <?php echo"$hari_kerja hari";?></h6>
	</div>
</div>
<table class='display'>
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
				$cek=mysql_num_rows($ambil_presensi);
				if($cek<=0){
					echo"<td bgcolor='#802126' width='5' style='text-align:center;'><a href='?page=tambah_presensi&id_pegawai=$id_pegawai&tanggal=$tgl' style='color:white;'>-</a></td>";
				}else{
					$id_presensi=$tampil_presensi['id_absensi'];
					$keterangan=$tampil_presensi['keterangan'];
					$time=$tampil_presensi['datang'];
					
					if(($keterangan=='04')and ($time>'08:05:00')){
				          echo"<td width='5' align='center'><a href='?page=edit_presensi&id_presensi=$id_presensi' style='color:red;'>$time</a></td>";
				        }else if(($keterangan=='04')and ($time<='08:05:00')){
				            echo"<td width='5' align='center'><a href='?page=edit_presensi&id_presensi=$id_presensi' style='color:orange;'>$time</a></td>";  
				        }else if($keterangan=='02'){
				              echo"<td width='5' align='center'><a href='?page=edit_presensi&id_presensi=$id_presensi' style='color:black;'>Izin</a></td>";    
				        
				        }else if($keterangan=='03'){
				        	      echo"<td width='5' align='center'><a href='?page=edit_presensi&id_presensi=$id_presensi' style='color:black;'>Sakit</a></td>";    
				        
				        }else{
				        	      echo"<td width='5' align='center'><a href='?page=edit_presensi&id_presensi=$id_presensi' style='color:black;'>$time</a></td>";    
				        
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
?>
<div class='row'>
	<div class='larger-3 columns'>
	<h6><b>Presensi 
		<?php
		$tanggal_datang=gmdate("Y-m-d",time()+60*60*7);
				$explode=explode('-',$tanggal_datang);
				$bulan=$explode[1];
				$tahun=$explode[0];
				$hari_kerja=mysql_num_rows(mysql_query("select id_status_absensi from status_absensi where bulan='$bulan' and tahun='$tahun'"));

				include"include/fungsi_bulan.php";
	 echo"Bulan $indo Tahun $tahun";
	 ?>
	</b>||Total hari kerja : <?php echo"$hari_kerja hari";?>
	</h6>
	</div>
</div>
<table class="display" border='1'>
	<thead>
		<tr>
			<td width='5'>No</td>
			<td>Nama</td>
				<?php
				$ambil_tanggals=mysql_query("select distinct tanggal from absensi where bulan='$bulan' and tahun='$tahun' order by tanggal asc");
				while($tampil_tanggals=mysql_fetch_array($ambil_tanggals)){
				$dapet_tanggals=$tampil_tanggals['tanggal'];
				$explode=explode('-',$dapet_tanggals);
				$tahun=$explode['0'];
				$bulan=$explode['1'];
				$tanggal=$explode['2'];
				echo"<td width='10' align='center'>$tanggal</td>";
					}
				?>
		</tr>			
	</thead>

	<tbody>
		<?php
		$no=1;
		$ambil_pegawai=mysql_query("SELECT*FROM pegawai");
		while($tampil_pegawai=mysql_fetch_array($ambil_pegawai)){
			$id_pegawai=$tampil_pegawai['id_pegawai'];
		?>
		<tr>
			<td width='5' align='left'><?php echo"$no";?></td>
			<td><?php echo "$tampil_pegawai[nama]";?></td>
				<?php
			$ambil_tanggal=mysql_query("SELECT distinct tanggal from absensi where bulan='$bulan' and tahun='$tahun' order by tanggal asc");
			while($tampil_tanggal=mysql_fetch_array($ambil_tanggal)){
				$tgl=$tampil_tanggal['tanggal'];
				$ambil_presensi=mysql_query("SELECT*FROM absensi where id_pegawai='$id_pegawai' and tanggal='$tgl'");	
				$tampil_presensi=mysql_fetch_array($ambil_presensi);
				$cek=mysql_num_rows($ambil_presensi);
				if($cek<=0){
					echo"<td bgcolor='#802126' width='5' style='text-align:center;'><a href='?page=tambah_presensi&id_pegawai=$id_pegawai&tanggal=$tgl' style='color:white;'>-</a></td>";
				}else{
					$id_presensi=$tampil_presensi['id_absensi'];
					$keterangan=$tampil_presensi['keterangan'];
					$time=$tampil_presensi['datang'];
					if(($keterangan=='04')and ($time>'08:05:00')){
				          echo"<td width='5' align='center'><a href='?page=edit_presensi&id_presensi=$id_presensi' style='color:red;'>$time</a></td>";
				        }else if(($keterangan=='04')and ($time<='08:05:00')){
				            echo"<td width='5' align='center'><a href='?page=edit_presensi&id_presensi=$id_presensi' style='color:orange;'>$time</a></td>";  
				        }else if($keterangan=='02'){
				              echo"<td width='5' align='center'><a href='?page=edit_presensi&id_presensi=$id_presensi' style='color:black;'>Izin</a></td>";    
				        
				        }else if($keterangan=='03'){
				        	      echo"<td width='5' align='center'><a href='?page=edit_presensi&id_presensi=$id_presensi' style='color:black;'>Sakit</a></td>";    
				        
				        }else{
				        	      echo"<td width='5' align='center'><a href='?page=edit_presensi&id_presensi=$id_presensi' style='color:black;'>$time</a></td>";    
				        
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


