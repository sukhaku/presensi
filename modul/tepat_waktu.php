 
<?php
if(isset($_POST['hadir'])){
	$id_pegawai=$_POST['id_pegawai'];
  //$keterangan=$_POST['keterangan'];
  //$alasan=$_POST['alasan'];
	$waktu_datang=$_POST['waktu_datang'];
	$tanggal_datang=$_POST['tanggal_datang'];
  $explode=explode('-',$tanggal_datang);
  $bulan=$explode[1];
  $tahun=$explode[0];
  $password_kirim=md5($_POST['password']);
  $data_password=mysql_query("select password from pegawai where password='$password_kirim' and id_pegawai='$id_pegawai' limit 1");
  $psw_ambil=mysql_num_rows($data_password); 
  if($psw_ambil==1){
    $masuk_absensi=mysql_query("INSERT INTO absensi values('','$id_pegawai','$waktu_datang','00:00:00','$tanggal_datang','$bulan','$tahun','01','-')");  
    echo"<meta http-equiv='refresh' content='0; index.php'/>";

	}else{
	echo"<script>alert('Password salah')</script>";
  echo"<meta http-equiv='refresh' content='0; index.php'/>";
  }
}else{
?>
  <script src="js/development-bundle/external/jquery.bgiframe-2.1.2.js"></script>
  <script src="js/development-bundle/ui/jquery.ui.core.js"></script>
  <script src="js/development-bundle/ui/jquery.ui.widget.js"></script>
  <script src="js/development-bundle/ui/jquery.ui.mouse.js"></script>
  <script src="js/development-bundle/ui/jquery.ui.button.js"></script>
  <script src="js/development-bundle/ui/jquery.ui.draggable.js"></script>
  <script src="js/development-bundle/ui/jquery.ui.position.js"></script>
  <script src="js/development-bundle/ui/jquery.ui.resizable.js"></script>
  <script src="js/development-bundle/ui/jquery.ui.dialog.js"></script>
  <script src="js/development-bundle/ui/jquery.ui.effect.js"></script>

  <style>
    body { font-size: 62.5%; }
    label, input { display:block; }
    input.text { margin-bottom:12px; width:95%; padding: .4em; }
    fieldset { padding:0; border:0; margin-top:25px; }
    h1 { font-size: 1.2em; margin: .6em 0; }
    div#users-contain { width: 350px; margin: 20px 0; }
    div#users-contain table { margin: 1em 0; border-collapse: collapse; width: 100%; }
    div#users-contain table td, div#users-contain table th { border: 1px solid #eee; padding: .6em 10px; text-align: left; }
    .ui-dialog .ui-state-error { padding: .3em; }
    .validateTips { border: 1px solid transparent; padding: 0.3em; }
  </style>
  
  <script>
 $(function() {
		$( "#dialog-form" ).dialog({
			modal: true,
			buttons: {
				Ok: function() {
					$( this ).dialog( "close" );
				}
			}
		});
	});
  </script>
</head>
<body>

<div id="dialog-form" title="Presensi Datang">
  <form action="?page=tepat_waktu" method='post'>
  	<input type='hidden' name='waktu_datang' value='<?php echo"$waktu_datang";?>'>
	<input type='hidden' name='tanggal_datang' value='<?php echo"$tanggal_datang";?>'>
  	<input type='hidden' name='id_pegawai' value='<?php echo"$id_pegawai";?>'>  	
  <fieldset>
    <label for="name">Password</label>
    <input type='password' class="text ui-widget-content ui-corner-all" name='password'/>
  </fieldset>
  
  <!--<fieldset>
    <label for="name">Keterangan</label>
    <?php
    
    $ambil_keterangan=mysql_query("select*from keterangan");
    echo"<select name='keterangan'>";    
    while($tampil_keterangan=mysql_fetch_array($ambil_keterangan)){
      echo"<option value='$tampil_keterangan[id_keterangan]'>$tampil_keterangan[keterangan]</option>";
    }
    echo"</select>";
    
    ?>
    
  </fieldset>
  <fieldset>
    <label for="name">Alasan</label>
    <textarea name='alasan'>-</textarea>
  </fieldset>
-->
  <fieldset>
  	<input type='submit' value='Input' name='hadir' class='tombol'> 
  </fieldset>
  </form>
</div>

<?php
}
?>
