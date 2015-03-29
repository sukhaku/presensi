
<style type="text/css">
#lihat_presensi{
	margin: 0 auto;
	height: 500px;
	padding: 15px;
	border: 1px solid silver;
	overflow: auto;
}
</style>
<div id='lihat_presensi'>
	<?php
			$bulans=$_POST['bulan'];
			$tahun_input=$_POST['tahun'];
			$divisi=$_POST['divisi'];
			?>
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
		    	for($tahun=2007; $tahun<=2020; $tahun++){
		    		if($tahun_input==$tahun){
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
		      		if($divisi==$tampil_divisi['id_divisi']){
		      		echo"<option value='$tampil_divisi[id_divisi]' selected>$tampil_divisi[nama_divisi]</option>";
		    		}else{
		    		echo"<option value='$tampil_divisi[id_divisi]'>$tampil_divisi[nama_divisi]</option>";	
		    		}
		    	}
		        ?>
		      </select>
	    </div>
	     <div class="large-3 columns">
	  			
	    </div>
    </div>
		<div class='row'>
			<div class="larger-2 columns">
				<input type="submit" value="Lihat" class="tiny small button radius" name='lihat_presensi'/>
				<input type="submit" value="Detail" class="tiny small button radius" name='detail_presensi'/>
			
			</div>  		
	  	</div>

	</form>

	<?php

	if($_POST['lihat_presensi']){

			$bulan=$_POST['bulan'];
			$tahun=$_POST['tahun'];
			$divisi=$_POST['divisi'];
			include"admin/include/fungsi_bulan.php";
			$hari_kerja=mysql_num_rows(mysql_query("select id_status_absensi from status_absensi where bulan='$bulan' and tahun='$tahun'"));
			?>
			<div class='row'>
	<div class='larger-3 columns'>
	<h6><b>Presensi <?php echo"Bulan $indo Tahun $tahun";?></b>||Total hari kerja : <?php echo"$hari_kerja hari";?></h6>
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
							echo"<td width='10'>$tanggal</td>";
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
								echo"<td bgcolor='#802126' width='5'></td>";
							}else{
								$keterangan=$tampil_presensi['keterangan'];
								$time=$tampil_presensi['datang'];
								if(($keterangan=='04')and ($time>'08:05:00')){
				          echo"<td width='5' align='center' style='color:red;'>$time</td>";
				        }else if(($keterangan=='04')and ($time<='08:05:00')){
				            echo"<td width='5' align='center' style='color:orange;'>$time</td>";  
				        }else if($keterangan=='02'){
				              echo"<td width='5' align='center'>Izin</td>";    
				        
				        }else if($keterangan=='03'){
				        	      echo"<td width='5' align='center'>Sakit</td>";    
				        
				        }else{
				        	      echo"<td width='5' align='center'>$time</td>";    
				        
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
		$bulan=$_POST['bulan'];
		$tahun=$_POST['tahun'];
		$divisi=$_POST['divisi'];
		include"admin/include/fungsi_bulan.php";
		$hari_kerja=mysql_num_rows(mysql_query("select id_status_absensi from status_absensi where bulan='$bulan' and tahun='$tahun'"));

?>
	<div class='row'>
		<div class='larger-3 columns'>
			<h6><b>Rekap Presensi <?php echo"Bulan $indo Tahun $tahun";?></b>||Total hari kerja : <?php echo"$hari_kerja hari";?></h6>
		</div>
	</div>
	<table class="display" >
		<thead>
			<tr>
				<td>No</td>
				<td>Nama</td>
				<td style='text-align:center;'>Masuk</td>
				<td style='text-align:center;'>Tidak masuk</td>
				<td style='text-align:center;'>Terlambat</td>
				<td style='text-align:center;'>Izin</td>
				<td style='text-align:center;'>Sakit</td>
				
				
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
			<td><?php echo"$no";?></td>	
			<td><?php echo"$tampil_pegawai[nama]";?></td>	
				<?php
				$tampil_masuk=mysql_fetch_array(mysql_query("SELECT COUNT(id_absensi) as jumlah_masuk FROM absensi where id_pegawai='$id_pegawai' and bulan='$bulan' and tahun='$tahun' and keterangan!='02' and keterangan!='03' limit 1"));
				$tampil_kerja=mysql_fetch_array(mysql_query("SELECT COUNT(id_status_absensi) as jumlah_kerja from status_absensi where bulan='$bulan' and tahun='$tahun'"));
				$tampil_terlambat=mysql_fetch_array(mysql_query("SELECT COUNT(keterangan) as jumlah_terlambat from absensi where id_pegawai='$id_pegawai' and bulan='$bulan' and tahun='$tahun' and keterangan='04'"));
				$masuk=$tampil_masuk['jumlah_masuk'];
				$kerja=$tampil_kerja['jumlah_kerja'];
				$tidak_masuk=$kerja-$masuk;
				$terlambat=$tampil_terlambat['jumlah_terlambat'];

				$ambil_izin=mysql_fetch_array(mysql_query("SELECT COUNT(id_absensi) as jumlah_izin FROM absensi where id_pegawai='$id_pegawai' and bulan='$bulan' and tahun='$tahun' and keterangan='02' limit 1"));
				$ambil_sakit=mysql_fetch_array(mysql_query("SELECT COUNT(id_absensi) as jumlah_sakit FROM absensi where id_pegawai='$id_pegawai' and bulan='$bulan' and tahun='$tahun' and keterangan='03' limit 1"));
				
				$tampil_izin=$ambil_izin['jumlah_izin'];
				$tampil_sakit=$ambil_sakit['jumlah_sakit'];
		

///UNTUK JUMLAH MENIT TERLAMBART
				//$pengaturan=mysql_fetch_array(mysql_query("SELECT jam_masuk from pengaturan where status='1' limit 1"));
				//$datang=$pengaturan['jam_masuk'];
				//$tampil_menit=mysql_fetch_array(mysql_query("SELECT timediff('datang','$datang') as total_menit from absensi where id_pegawai='$id_pegawai' and bulan='$bulan' and tahun='$tahun' and datang>='$datang'"));
				
				echo"<td align='center'>$masuk Hari</td>";
				echo"<td align='center'>$tidak_masuk Hari</td>";
				echo"<td align='center'>$terlambat Hari</td>";
				echo"<td align='center'>$tampil_izin Hari</td>";
				echo"<td align='center'>$tampil_sakit Hari</td>";
				//echo"<td align='center'>$tampil_menit[total_menit]</td>";			
				?>
		</tr>	
		</tbody>
		<?php
		$no++;
		}
		?>
		</table>


















<?php

}
?>


</div>