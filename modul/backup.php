<html>
<head>
	<title>PT.Inovasi Tritek Informasi</title>
<link href="css/style.css" rel="stylesheet"/>
<link rel="shortcut icon" href="images/katalog.ico">
<style type="text/css">
@import "css/demo_table_jui.css";
@import "js/development-bundle/themes/redmond/jquery-ui.css";
@import "css/jqClock.css";
@import "css/foundation.css";
</style>
<script src="js/jquery-1.8.2.js"></script>
<script src="js/jquery-ui-1.9.0.custom.js"></script>
<script src="js/jquery.dataTables.js"></script>
<script src="js/jqClock.min.js"></script>
    <script type="text/javascript">
      $(document).ready(function(){
          $("#isi_kiri").accordion({
              animated: "easeOutBounce"     
          });
       $('#tabeldata').dataTable({
               "oLanguage": {
                  "sLengthMenu": "Tampilkan _MENU_ data per halaman",
                  "sSearch": "Pencarian: ", 
                  "sZeroRecords": "Maaf, tidak ada data yang ditemukan",
                  "sInfo": "Menampilkan _START_ s/d _END_ dari _TOTAL_ data",
                  "sInfoEmpty": "Menampilkan 0 s/d 0 dari 0 data",
                  "sInfoFiltered": "(di filter dari _MAX_ total data)",
                  "oPaginate": {
                      "sFirst": "<<",
                      "sLast": ">>", 
                      "sPrevious": "<", 
                      "sNext": ">"
                 }
              },
              "sPaginationType":"full_numbers",
              "bJQueryUI":true
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
      <h1><a href="#">Presensi PT.Inovasi Tritek Informasi</a></h1>
    </li>
    <li class="toggle-topbar menu-icon"><a href="#">Menu</a></li>
  </ul>
  <section class="top-bar-section">
    <!-- Right Nav Section -->
    <ul class="right">
      <li class="has-dropdown">
        <a href="#">Presensi</a>
        <ul class="dropdown">
          <li><a href="#">Lihat Presensi</a></li>
        </ul>
      </li>
      <li class="active"><a href="include/logout.php">Admin</a></li>
    </ul>
    <ul class='left'>
    </ul>    
  </section>
</nav>
	<div id="container">
		<div id='isi'>
			<?php
			include"config/koneksi.php";
			$tanggal_cek=gmdate('Y-m-d',time()+60*60*7);
			$data=mysql_query("select*from status_absensi where tanggal='$tanggal_cek' limit 1");
			$cek=mysql_num_rows($data);
			if($cek<=0){
				include"config/masuk.php";
			}else{
			?>

			<div id='isi_kiri'>
					 <h2><a href="#">Home</a></h2>
	            <div>
	            	<li><a href='?page=presensi' style='text-decoration:none;'>Presensi</a></li><br>
	            	<li><a href='?page=lihat_presensi' style='text-decoration:none;'>Lihat Presensi</a></li>
	            </div>
	        		<h2><a href="#">Presensi</a></h2>
	            <div>
	            	<li><a href='' style='text-decoration:none;'>----</a></li><br>
	            	<li><a href='' style='text-decoration:none;'>---</a></li>
	            </div>
	        		<h2><a href="#">Web Administrator</a></h2>
	            <div>
	            	Web administrator bertugas sebagai juru maintenance, yaitu melakukan pemeliharaan dan penjagaan website.
	            </div>

			</div>

			<div id='isi_kanan'>
				<div id="jam"></div> <div class='clear'></div>
				<div class='content'>
					<h3>Presensi Karyawan</h3>
						<?php
						if(empty($_GET['page'])){
							include"modul/presensi.php";
						}else{
							include"config/switch.php";
						}

						?>
			

				</div>
		</div> 

			<?php
			}

			?>


		</div>

		<div class='clear'>

		</div>

		<div id='footer'>
			<p class='teks'>PT.Inovasi Tritek Informasi | Copyright@2014</p>	
		</div>

	</div>
<script src="js/foundation.js"></script>
<script src="js/foundation.topbar.js"></script>
<script type='text/javascript'>
  $(document).foundation();
</script>
</body>
</html>