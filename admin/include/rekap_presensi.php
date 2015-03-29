<h5>Rekap Presensi</h5>
<div id='halaman'>
<form action="?page=cari_rekap" method="post">
	<div class="row">
	    <div class="large-3 columns">
	      <label>Bulan</label>
	      	 <?php
		      $bulan=array("","Januari","Februari","Maret","April","Mei","Juni","Juli","Agustus","Sepetember","Oktober","November","Desember");
		      ?>
		      <select name="bulan">
		      	<?php
		      		for($k=1;$k<=12;$k++){
		      			echo "<option value='$k'>$bulan[$k]</option>";
		      		}
		      	?>  
		      </select>
	    </div>
	    <div class="large-3 columns">
	      <label>Tahun</label>
	         <select name='tahun'>
		      	<option  value='2011'>2011</option>

		      	<option  value='2012'>2012</option>

		      	<option  value='2013'>2013</option>
		      	<option  value='2014'>2014</option>
		      	<option value='2014'>2015</option>
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
			<input type="submit" value="Lihat" class="tiny small button radius" name='cari_rekap'/>
		</div>  		
  	</div>

</form>

<?php
if($_GET['page']=='cari_rekap'){
	if(isset($_POST['cari_rekap'])){
		$bulan=$_POST['bulan'];
		$tahun=$_POST['tahun'];
		$divisi=$_POST['divisi'];
	$hari_kerja=mysql_num_rows(mysql_query("select id_status_absensi from status_absensi where bulan='$bulan' and tahun='$tahun'"));

?><h6>Total hari kerja : <?php echo"$hari_kerja hari";?></h6>
		<table class="display" >
		<thead>
			<tr>
				<td>No</td>
				<td>Nama</td>
				<td style='text-align:center'>Masuk</td>
				<td style='text-align:center'>Tidak masuk</td>
				<td style='text-align:center'>Terlambat</td>
				<td style='text-align:center'>Izin</td>
				<td style='text-align:center'>Sakit</td>
				
				
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
				$tampil_masuk=mysql_fetch_array(mysql_query("SELECT COUNT(id_absensi) as jumlah_masuk FROM absensi where id_pegawai='$id_pegawai' and bulan='$bulan' and tahun='$tahun' and keterangan!='03' and keterangan!='02' limit 1"));
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
		
				echo"<td align='center'>$masuk Hari</td>";
				echo"<td align='center'>$tidak_masuk Hari</td>";
				echo"<td align='center'>$terlambat Hari</td>";
				echo"<td align='center'>$tampil_izin Hari</td>";
				echo"<td align='center'>$tampil_sakit Hari</td>";
					

				//echo"<td align='center'>Total</td>";			
				?>
		</tr>	
		</tbody>
		<?php
		$no++;
		}
		?>
		</table>
		<br>
		<a href='include/ekspor_cari_presensi.php' class='tiny small button radius'>Cetak</a>































<?php
	}
}else{
$bulan=gmdate("m",time()+60*60*7);
$tahun=gmdate("Y",time()+60*60*7);
include"include/fungsi_bulan.php";
$hari_kerja=mysql_num_rows(mysql_query("select id_status_absensi from status_absensi where bulan='$bulan' and tahun='$tahun'"));

?><h6>Total hari kerja : <?php echo"$hari_kerja hari";?></h6>
	<table class="display" >

		<thead>
			<tr>
				<td colspan='7' style='text-align:center;'>Presensi Pegawai PT. INOVASI TRITEK INFORMASI Bulan <?php echo"$indo";?> Tahun <?php echo"$tahun";?> 
			<tr>
				<td>No</td>
				<td>Nama</td>
				<td style='text-align:center'>Masuk</td>
				<td style='text-align:center'>Tidak masuk</td>
				<td style='text-align:center'>Terlambat</td>
				<td style='text-align:center'>Izin</td>
				<td style='text-align:center'>Sakit</td>
				
			
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
			<td><?php echo"$no";?></td>	
			<td><?php echo"$tampil_pegawai[nama]";?></td>	
				<?php
				$bulan=gmdate("m",time()+60*60*7);
				$tahun=gmdate("Y",time()+60*60*7);
				$tampil_masuk=mysql_fetch_array(mysql_query("SELECT COUNT(id_absensi) as jumlah_masuk FROM absensi where id_pegawai='$id_pegawai' and bulan='$bulan' and tahun='$tahun' and keterangan!='03' and keterangan!='02' limit 1"));
				$ambil_izin=mysql_fetch_array(mysql_query("SELECT COUNT(id_absensi) as jumlah_izin FROM absensi where id_pegawai='$id_pegawai' and bulan='$bulan' and tahun='$tahun' and keterangan='02' limit 1"));
				$ambil_sakit=mysql_fetch_array(mysql_query("SELECT COUNT(id_absensi) as jumlah_sakit FROM absensi where id_pegawai='$id_pegawai' and bulan='$bulan' and tahun='$tahun' and keterangan='03' limit 1"));
				
				$tampil_izin=$ambil_izin['jumlah_izin'];
				$tampil_sakit=$ambil_sakit['jumlah_sakit'];
		
				
				$tampil_kerja=mysql_fetch_array(mysql_query("SELECT COUNT(id_status_absensi) as jumlah_kerja from status_absensi where bulan='$bulan' and tahun='$tahun'"));
				$tampil_terlambat=mysql_fetch_array(mysql_query("SELECT COUNT(keterangan) as jumlah_terlambat from absensi where id_pegawai='$id_pegawai' and bulan='$bulan' and tahun='$tahun' and keterangan='04'"));
				
				$tampil_pengaturan=mysql_fetch_array(mysql_query("SELECT jam_masuk from pengaturan where status='1' limit 1"));
				$jam_masuk=$tampil_pengaturan['jam_masuk'];
				$ambil_telat=mysql_fetch_array(mysql_query("SELECT timediff(datang,'$jam_masuk') as tot from absensi where id_pegawai='$id_pegawai' and datang>'$jam_masuk' and bulan='$bulan' and tahun='$tahun'"));
				$tampil_telat=$ambil_telat['tot'];
				//$menit=FLOOR(MOD($tampil_telat,3600)/60);
				//$sisa=$tampil_telat % 86400;
				//$tuelt=floor($sisa/3600);	

				$masuk=$tampil_masuk['jumlah_masuk'];
				$kerja=$tampil_kerja['jumlah_kerja'];
				$tidak_masuk=$kerja-$masuk;
				$terlambat=$tampil_terlambat['jumlah_terlambat'];
				echo"<td align='center'>$masuk Hari</td>";
				echo"<td align='center'>$tidak_masuk Hari</td>";
				echo"<td align='center'>$terlambat Hari</td>";
				echo"<td align='center'>$tampil_izin Hari</td>";
				echo"<td align='center'>$tampil_sakit Hari</td>";
					
			
					
				?>
		</tr>	
		</tbody>
		<?php
		$no++;
		}
		?>
		</table>

<br>
<a href='include/ekspor_presensi.php' class='tiny small button radius'>Cetak</a>

<?php
}
?>
</div>