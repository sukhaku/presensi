<?php
$ambil_pengaturan=mysql_fetch_array(mysql_query("select*from pengaturan where status='1'"));
$tampil_datang=$ambil_pengaturan['jam_masuk'];
$tampil_pulang=$ambil_pengaturan['jam_pulang'];
$date=gmdate("Y-m-d",time()+60*60*7);
//$ambil_paling_awal=mysql_fetch_array(mysql_query("select*from absensi where "))
$tampil_tepat_waktu=mysql_num_rows(mysql_query("select*from absensi where datang<='$tampil_datang' and datang>='00:00:00' and keterangan='01'and tanggal='$date'"));
$tampil_telat=mysql_num_rows(mysql_query("select*from absensi where datang>'$tampil_datang' and datang<'$tampil_pulang' and keterangan='04' and tanggal='$date'"));
$tampil_masuk=mysql_num_rows(mysql_query("select*from absensi where tanggal='$date' and keterangan!='02' and keterangan!='03'"));
$ambil_pegawai=mysql_num_rows(mysql_query("select id_pegawai from pegawai order by id_pegawai"));
$tampil_tidak_masuk=$ambil_pegawai-$tampil_masuk;
?>
<table class='display' border='1' height='200px'>
<thead>
	<tr>
		<th colspan='6' style='text-align:center;'><h4>Presensi, <?php echo"$tanggal $indo $tahun  ";?></h4></th>
	<tr>
	<tr>	
		<th>Jumlah Pegawai tepat waktu</th>
		<td align='center'><?php echo"$tampil_tepat_waktu orang";?></td>
	</tr>

	<tr>	
		<th>Jumlah Pegawai terlambat</th>
		<td><?php echo"$tampil_telat orang";?></td>
	</tr>

	<tr>	
		<th>Jumlah Pegawai Masuk</th>
		<td><?php echo"$tampil_masuk orang";?></td>
	</tr>

	<tr>	
		<th>Jumlah Pegawai tidak masuk</th>
		<td><?php echo"$tampil_tidak_masuk orang";?></td>
	</tr>
</thead>


</table>



