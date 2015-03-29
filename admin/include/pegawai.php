<?php
include"include/class_paging.php";
?>
<style type="text/css">
@import"css/paging3.css";
</style>
<?php
if($_GET['page']=='pegawai'){
	//Untuk pegawai
?>
<h5>Data Pegawai</h5>
<div id='halaman'>
<table class='display' >
<thead>
	<tr>
		<th>No</th>
		<th>Nama</th>
		<th>Username</th>
		<th>Divisi</th>
		<th>Kepegawaian</th>
		<th>Status</th>
		<th>Operasi</th>
	</tr>
</thead>
<tbody>
	<?php
	$a = new Paging;
	$limit =16;
	$posisi = $a->cariPosisi($limit);
	$ambil_pegawai=mysql_query("select*from pegawai,divisi,status_pegawai where pegawai.id_divisi=divisi.id_divisi and pegawai.id_status_pegawai=status_pegawai.id_status_pegawai limit $posisi,$limit");
	$no = $posisi + 1;
	while($tampil_pegawai=mysql_fetch_array($ambil_pegawai)){
		echo"
		<tr>
		<td>$no</td>
		<td>$tampil_pegawai[nama]</td>
		<td>$tampil_pegawai[username]</td>
		<td>$tampil_pegawai[nama_divisi]</td>
		<td>$tampil_pegawai[status_pegawai]</td>";

		$status=$tampil_pegawai['status'];
		if($status=='1'){
			echo"<td><a href='?page=ubah_status&id_pegawai=$tampil_pegawai[id_pegawai]'>Aktif</a></td>";
		}else{
				echo"<td><a href='?page=ubah_status&id_pegawai=$tampil_pegawai[id_pegawai]'>Tidak aktif</a></td>";	
		}
		echo"<td><a href='?page=edit_pegawai&id_pegawai=$tampil_pegawai[id_pegawai]'><img src='images/valid.gif'/></a> | <a href='?page=hapus_pegawai&id_pegawai=$tampil_pegawai[id_pegawai]'><img src='images/unvalid.gif'/></a></td>
		</tr>
		";
		$no++;
	}
	?>
</tbody>	
</table>
<br>	
<?php
$jmldata = mysql_num_rows(mysql_query("select*from pegawai,status_pegawai,divisi where pegawai.id_status_pegawai=status_pegawai.id_status_pegawai and pegawai.id_divisi=divisi.id_divisi"));
$jmlhalaman  = $a->jumlahHalaman($jmldata, $limit);
$linkHalaman = $a->navHalaman($_GET[halaman], $jmlhalaman);

echo "<div class=paging>Hal: $linkHalaman</div><br>";
?>
<a href="?page=tambah_pegawai" class="tiny button small">Tambah</a>
</div>

<?php
}else if($_GET['page']=='divisi'){
	//Untuk Divisi Pegawai
?>	
<h5>Data Divisi</h5>
<div id='halaman'>
<table class='display' >
<thead>
	<tr>
		<th>No</th>
		<th>Divisi</th>
		<th>Operasi</th>
	</tr>
</thead>
<tbody>
	<?php
	include"include/koneksi.php";
	$no=1;
	$ambil_divisi=mysql_query("select*from divisi");
	while($tampil_divisi=mysql_fetch_array($ambil_divisi)){
		echo"
		<tr>
		<td>$no</td>
		<td>$tampil_divisi[nama_divisi]</td>
		<td>
		<a href='?page=edit_divisi&id_divisi=$tampil_divisi[id_divisi]'><img src='images/valid.gif'/></a> | <a href='?page=hapus_divisi&id_divisi=$tampil_divisi[id_divisi]'><img src='images/unvalid.gif'/></a>
		</td>
		</tr>";
		$no++;
	}
	?>
</tbody>	
</table>
<br>	
<a href="?page=tambah_divisi" class="tiny button small">Tambah</a>
</div>


<?php
}else{
	//Untuk kepegawaian
?>
	<h5>Data Kepegawaian</h5>
<div id='halaman'>
<table class='display' >
<thead>
	<tr>
		<th>No</th>
		<th>Jenis Pegawai</th>
		<th>Operasi</th>
	</tr>
</thead>
<tbody>
	<?php
	include"include/koneksi.php";
	$no=1;
	$ambil_kepegawaian=mysql_query("select*from status_pegawai");
	while($tampil_kepegawaian=mysql_fetch_array($ambil_kepegawaian)){
		echo"
		<tr>
		<td>$no</td>
		<td>$tampil_kepegawaian[status_pegawai]</td>
		<td>
		<a href='?page=edit_kepegawaian&id_kepegawaian=$tampil_kepegawaian[id_status_pegawai]'><img src='images/valid.gif'/></a> | <a href='?page=hapus_kepegawaian&id_kepegawaian=$tampil_kepegawaian[id_status_pegawai]'><img src='images/unvalid.gif'/></a>
		</td>
		</tr>";

		$no++;
	}
	?>
</tbody>	
</table>
<br>	
<a href="?page=tambah_kepegawaian" class="tiny button small">Tambah</a>
</div>

<?php
}
?>