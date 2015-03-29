<?php
include"koneksi.php";

$bulan=gmdate("m",time()+60*60*7);
$tahun=gmdate("Y",time()+60*60*7);
include"fungsi_bulan.php";
//untuk halaman awal
header("Content-type:application/octet-stream");
header("Content-Disposition: attachment; filename=data_pegawai.xls");
header("Pragma:no-cache");
header("Expires:0");
?>
<table class="display" border='1'>

		<thead>
			<tr>
				<td colspan='7' style='text-align:center;'>Presensi Pegawai PT. INOVASI TRITEK INFORMASI Bulan <?php echo"$indo";?> Tahun <?php echo"$tahun";?> 
			<tr>
				<td>No</td>
				<td>Nama</td>
				<td align='center'>Masuk</td>
				<td align='center'>Tidak masuk</td>
				<td align='center'>Terlambat</td>
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
				$tampil_masuk=mysql_fetch_array(mysql_query("SELECT COUNT(id_absensi) as jumlah_masuk FROM absensi where id_pegawai='$id_pegawai' and bulan='$bulan' and tahun='$tahun' and keterangan!='02' and keterangan!='03' limit 1"));
				$tampil_kerja=mysql_fetch_array(mysql_query("SELECT COUNT(id_status_absensi) as jumlah_kerja from status_absensi where bulan='$bulan' and tahun='$tahun'"));
				$tampil_terlambat=mysql_fetch_array(mysql_query("SELECT COUNT(keterangan) as jumlah_terlambat from absensi where id_pegawai='$id_pegawai' and bulan='$bulan' and tahun='$tahun' and keterangan='04'"));
				
				$ambil_izin=mysql_fetch_array(mysql_query("SELECT COUNT(id_absensi) as jumlah_izin FROM absensi where id_pegawai='$id_pegawai' and bulan='$bulan' and tahun='$tahun' and keterangan='02' limit 1"));
				$ambil_sakit=mysql_fetch_array(mysql_query("SELECT COUNT(id_absensi) as jumlah_sakit FROM absensi where id_pegawai='$id_pegawai' and bulan='$bulan' and tahun='$tahun' and keterangan='03' limit 1"));
				
				$tampil_izin=$ambil_izin['jumlah_izin'];
				$tampil_sakit=$ambil_sakit['jumlah_sakit'];
		

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