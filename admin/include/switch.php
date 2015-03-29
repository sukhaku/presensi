<?php
$page=$_GET['page'];

switch ($page) {
	case'admin':
	include"include/admin.php";
	break;

	case'ubah_status':
	include"include/ubah_status.php";
	break;


	case'tambah_admin';
	include"include/admin.php";
	break;

	case'hapus_admin';
	include"include/admin.php";
	break;

	case'edit_admin';
	include"include/admin.php";
	break;


	case 'pegawai':
	include"include/pegawai.php";
	break;
	
	case 'divisi':
	include"include/pegawai.php";
	break;
	case 'kepegawaian':
	include"include/pegawai.php";
	break;
	
	case 'hapus_pegawai':
	include"include/hapus_pegawai.php";
	break;
	
	case 'hapus_divisi':
	include"include/hapus_pegawai.php";
	break;
	
	case 'hapus_kepegawaian':
	include"include/hapus_pegawai.php";
	break;


	case 'tambah_pegawai':
	include"include/tambah_pegawai.php";
	break;

	case 'tambah_divisi':
	include"include/tambah_pegawai.php";
	break;
	
	case 'tambah_kepegawaian':
	include"include/tambah_pegawai.php";
	break;

	case'edit_pegawai':
	include"include/edit_pegawai.php";
	break;

	case'edit_divisi':
	include"include/edit_pegawai.php";
	break;

	case'edit_kepegawaian':
	include"include/edit_pegawai.php";
	break;

	case'jam_kerja':
	include"include/jam_kerja.php";
	break;

	case'tambah_pengaturan':
	include"include/jam_kerja.php";
	break;

	case'hapus_jam':
	include"include/hapus_jam.php";
	break;
	
	case'edit_aktif':
	include"include/edit_jam.php";
	break;

	case'edit_non':
	include"include/edit_jam.php";
	break;
	


	case'presensi':
	include"presensi.php";
	break;

	case'cari_presensi':
	include"presensi.php";
	break;


	case'tambah_presensi':
	include"tambah_presensi.php";
	break;

	case'hapus_presensi':
	include"hapus_presensi.php";
	break;
	


	case'rekap_presensi':
	include"rekap_presensi.php";
	break;

	case'cari_rekap':
	include"rekap_presensi.php";
	break;



	case'edit_presensi':
	include"include/edit_presensi.php";
	break;
	

	
	case'rekap_pegawai':
	include"rekap_pegawai.php";
	break;

	case'data_terlambat':
	include"data_terlambat.php";
	break;

	case'cari_absen':
	include"data_terlambat.php";
	break;

	default:
		# code...
		break;
}


?>