<html>
<head>
	<title>PT. Inovasi Tritek Informasi</title>
<link href="css/style.css" rel="stylesheet"/>
<link rel="shortcut icon" href="images/logo_inovasi.png">
<style type="text/css">
@import "css/foundation.css";
@import "css/demo_table_jui.css";
@import "js/redmond/jquery-ui.css";
@import "css/jqClock.css";
</style>
<script src="js/jquery-1.8.2.js"></script>
<script src="js/jquery-ui-1.9.0.custom.js"></script>
<script src="js/jquery.dataTables.js"></script>
<script src="js/jqClock.min.js"></script>
    
<script type="text/javascript">
    $(document).ready(function(){    
      $("#jam").clock({"format":"24","calendar":"false"});
    });    
</script>
<script type="text/javascript">
$(document).ready(function(){
    $("tr").mouseover(function(){
      $(this).addClass("silver");  
    });

    $("tr").mouseout(function(){
      $(this).removeClass("silver");
    });

});


</script>
</head>
<body>
<nav class="top-bar" data-topbar>
  <ul class="title-area">
    <li class="name">
      <h1><a href="index.php">PT. Inovasi Tritek Informasi</a></h1>
    </li>
    <li class="toggle-topbar menu-icon"><a href="#">Menu</a></li>
  </ul>
  <section class="top-bar-section">
    <!-- Right Nav Section -->
    <ul class="right">
      <li class="has-dropdown">
        <a href="?page=paling_rajin">
            <?php 
            $hari=date("l",time()+60*60*7);
            $tahun=date("Y",time()+60*60*7);
            $bulan=date("m",time()+60*60*7);
            $tanggal=date("d",time()+60*60*7);
            include"admin/include/fungsi_bulan.php";
            echo "$hari, $tanggal $indo $tahun";
          ?>
        </a>
        <ul class="dropdown">
          <li><a href="?page=presensi">
            Presensi
          </a></li>
          <li><a href="?page=lihat_presensi">
            Rekap Presensi
          </a></li>
          
        </ul>

      </li>
      
      <li class="active"><a href="admin/">Admin</a></li>
    </ul>


    </ul>  
  </section>
</nav>

<div id="container">
  
    <div class="row">

        <div class="large-12 columns" id="jam">

        
        </div>
    </div>
    <div id="header">
      <img src="images/pakai.jpg">

    </div>
		<div id='isi'>
			<?php
			if(empty($_GET['page'])){
			include"modul/presensi.php";
			}else{
			include"config/switch.php";
			}
			?>
		</div>

		<div class='clear'></div>

		<div id='footer'>
			<!--<nav class="top-bar" data-topbar>
  				<ul class="title-area">
    				<li class="name">
      				<h1><label>ijsh</label></h1>
    				</li>
    				<li class="toggle-topbar menu-icon"><a href="#">Menu</a></li>
  				</ul>
			</nav> -->
		</div>

</div>

<script src="js/foundation.js"></script>
<script src="js/foundation.topbar.js"></script>
<script type='text/javascript'>
  $(document).foundation();
</script>
</body>
</html>
