<h5>Data Pegawai</h5>
<div id='halaman' style='overflow:auto;'>
<table class='display'>
<thead>
	<tr>
		<th colspan='9' style='text-align:center;'>Data Pegawai PT. Inovasi Tritek Informasi</th>
	</tr>
	<tr>
		<th>No</th>
		<th>Nama</th>
		<th>Username</th>
		<th>Jenis Kelamin</th>
		<th>Alamat</th>
		<th>No Hp</th>
		<th>Divisi</th>
		<th>Kepegawaian</th>
		<th>Status</th>
	</tr>
</thead>
<tbody>
	<?php
	$no=1;
	$ambil_pegawai=mysql_query("select*from pegawai,divisi,status_pegawai where pegawai.id_divisi=divisi.id_divisi and pegawai.id_status_pegawai=status_pegawai.id_status_pegawai");
	while($tampil_pegawai=mysql_fetch_array($ambil_pegawai)){
		echo"
		<tr>
		<td>$no</td>
		<td>$tampil_pegawai[nama]</td>
		<td>$tampil_pegawai[username]</td>
		<td>$tampil_pegawai[jk]</td>
		<td>$tampil_pegawai[alamat]</td>
		<td>$tampil_pegawai[no_hp]</td>	
		<td>$tampil_pegawai[nama_divisi]</td>
		<td>$tampil_pegawai[status_pegawai]</td>";

		$status=$tampil_pegawai['status'];
		if($status=='1'){
			echo"<td>Aktif</td>";
		}else{
				echo"<td>Tidak aktif</td>";	
		}
		
		$no++;
	}
	?>
</tbody>	
</table><br>
<a href='include/ekspor_pegawai.php' class='tiny small button radius'>Cetak</a>
