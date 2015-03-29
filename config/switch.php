<?php
$page=$_GET['page'];
switch ($page) {
		case 'presensi':
		include"modul/presensi.php";
		break;

		case 'lihat_presensi':
		include"modul/lihat_presensi.php";
		break;

		case'kedatangan';
		include"modul/kedatangan.php";
		break;

		case'telat';
		include"modul/telat.php";
		break;

		case'tepat_waktu';
		include"modul/tepat_waktu.php";
		break;

		case'kepulangan':
		include"modul/kepulangan.php";
		break;

		case'pulang':
		include"modul/pulang.php";
		break;

		case'cari_presensi':
		include"modul/cari_presensi.php";
		break;

		case'paling_rajin':
		include"modul/paling_rajin.php";
		break;
		
		
		

			
	}
?>