<html>
<head>
	<title>PT.Inovasi Tritek Informasi</title>
<link href="css/style.css" rel="stylesheet"/>
<link rel="shortcut icon" href="../images/logo_inovasi.png">
<style type="text/css">
@import "../css/demo_table_jui.css";
@import "../js/flick/jquery-ui.css";
@import "../css/jqClock.css";
@import "../css/foundation.css";
</style>


<script src="../js/jquery-1.8.2.js"></script>
<script src="../js/jquery-ui-1.9.0.custom.js"></script>
<script src="../js/jquery.dataTables.js"></script>
<script src="../js/jqClock.min.js"></script>
    <script type="text/javascript">
      $(document).ready(function(){
          $("#isi_kiri").accordion({
              animated: "easeOutBounce"     
          });
          
      });
    </script>
<script type="text/javascript">
    $(document).ready(function(){    
      $("#jam").clock({"format":"24","calendar":"false"});
    });    
</script>

</head>
<body>
<nav class="top-bar" data-topbar>
  <ul class="title-area">
    <li class="name">
      <h1><a href="index.php">PT.Inovasi Tritek Informasi</a></h1>
    </li>
    <li class="toggle-topbar menu-icon"><a href="#">Menu</a></li>
  </ul>
  <section class="top-bar-section">
    <!-- Right Nav Section -->
    <ul class="right">
      <li class="has-dropdown">
        <a href=''>
          <?php 
            $hari=date("l",time()+60*60*7);
            $tahun=date("Y",time()+60*60*7);
            $bulan=date("m",time()+60*60*7);
            $tanggal=date("d",time()+60*60*7);
            include"include/fungsi_bulan.php";
            echo "$hari, $tanggal $indo $tahun";
          ?>

        </a>
        <ul class="dropdown">
          <li>
            <a href='<?php if($_SESSION['level']=='1'){echo"?page=admin";}else{echo"#";}?>'><?php echo"$_SESSION[username]";?></a>
          </li>
          <li><a href="../" target="_blank">Lihat Presensi</a></li>
        </ul>
      </li>
      <li class="active"><a href="include/logout.php">Logout</a></li>
    </ul>
    <ul class='left'>
    </ul>    
  </section>
</nav>
	<div id="container">
		<div id='isi'>
			<div id='isi_kiri'>
					 <h2><a href="#">Home</a></h2>
	            <div>
	            
	            	<li><a href='?page=presensi' style='text-decoration:none;'>Presensi</a></li><br>

	            	
	            </div>
              <h2><a href="#">Data Pegawai</a></h2>
              <div>
                <li><a href='?page=pegawai' style='text-decoration:none;'>Pegawai</a></li><br>
                <li><a href='?page=divisi' style='text-decoration:none;'>Divisi</a></li><br>
                <li><a href='?page=kepegawaian' style='text-decoration:none;'>Kepegawaian</a></li><br>
                
              </div>

                <h2><a href="#">Data Absensi</a></h2>
              <div>
                <li><a href='?page=data_terlambat' style='text-decoration:none;'>Detail</a></li><br>
              </div>
              
	        		<h2><a href="#">Rekap Data</a></h2>
	            <div>
	            	<li><a href='?page=rekap_pegawai' style='text-decoration:none;'>Pegawai</a></li><br>
	            	<li><a href='?page=rekap_presensi' style='text-decoration:none;'>Presensi</a></li>
	            </div>

              <?php
              if($_SESSION['level']=='1'){
              ?>
	        		<h2><a href="#">Pengaturan</a></h2>
	            <div>
	            	<li><a href='?page=jam_kerja' style='text-decoration:none;'>Jam Kerja</a></li>
	            </div>
              <?php
            }?>

           
              



			</div>

			<div id='isi_kanan'>
				<?php
          if(empty($_GET['page'])){
            ?>
           
          <h5>Welcome</h5>
             <div id='halaman'>
                <h3>Selamat datang</h3> dihalaman Administrator PT. Inovasi Tritek Informasi <img src='../images/logo_inovasi.png' width='20' height='20'/>
<br><br><br>
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
<table class='display' border='1'>
<thead>
  <tr>
    <th colspan='6' style='text-align:center;'><h4>Presensi, <?php echo"$tanggal $indo $tahun ";?></h4></th>
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

             </div>

           <?php
          }else{
            include"include/switch.php";
          }     
          ?>
			</div>	

			
		</div>

		<div class='clear'>

		</div>

		<div id='footer'>
			<p class='teks'>Copyright@2014 | Aplikasi Presensi PT. Inovasi Tritek Informasi | <img src="../images/logo_inovasi.png" width='10' height='10'><a href='http://www.inovasi.net/' target='_blank' style='color:white;'> inovasi</a> </p>	
		</div>

	</div>
<script src="../js/foundation.js"></script>
<script src="../js/foundation.topbar.js"></script>
<script type='text/javascript'>
  $(document).foundation();
</script>
</body>
</html>