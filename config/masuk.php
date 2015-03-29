<?php
include"koneksi.php";
if(isset($_POST['login'])){
      $username=$_POST['username'];
      $password=md5($_POST['password']);
      $ambil=mysql_query("select*from admin where username='$username' and password='$password'");
      $cek=mysql_num_rows($ambil);
      $tampil=mysql_fetch_array($ambil);
      if($cek>=1){
        $tanggal=gmdate('Y-m-d',time()+60*60*7);
        $bulan=gmdate("m",time()+60*60*7);
        $tahun=gmdate("Y",time()+60*60*7);
        $input_absensi=mysql_query("insert into status_absensi values('','aktif','$tanggal','$bulan','$tahun')");
        echo"<script>alert('Selamat datang')</script>";
        header("location:../");  
      }else{
        $ambil2=mysql_query("select*from pegawai where username='$username' and password='$password'");
        $cek2=mysql_num_rows($ambil2);
        $tampil2=mysql_fetch_array($ambil2);
        if($cek2>=1){
          $tanggal=gmdate('Y-m-d',time()+60*60*7);
          $bulan=gmdate("m",time()+60*60*7);
          $tahun=gmdate("Y",time()+60*60*7);
          $input_absensi=mysql_query("insert into status_absensi values('','aktif','$tanggal','$bulan','$tahun')");
          echo"<script>alert('Selamat datang')</script>";
          header("location:../");
          }else{
  			  header("location:../");
          }
        }

}else{
?>
<style type="text/css">
@import "css/foundation.css";
#masuk{
  text-decoration: none;
  border:none;
  padding:5px;
}
#container{
  margin: 0 auto;
  margin-top:210px;
  width: 1000px;
  height: auto;
}

</style>
<html>
  <head>
    <link rel="shortcut icon" href="images/lock.png">
    <title>PT.Inovasi Tritek Informasi</title>
  </head>
  
  <body>
    <div id='container'>
        <form method="post" action="config/masuk.php" class='form'>
                    
                        <table cellpadding="0" cellspacing="0" align="center" id="masuk">
                            <tr>
                                <td rowspan="4"><img src="images/lock.png"/></td>
                                <td colspan="2"><small><h3>Login Required</h3></small></td>
                            </tr>

                            <tr>
                                <td><small><h5>Username</h5></small></td>
                                <td><input type="text" name="username" placeholder="Username" class="form_text" /></td>
                            </tr>

                            <tr>
                                <td><small><h5>Password</h5></small></td>
                                <td><input type="password" name="password" placeholder="Password" /></td>
                            </tr>

                            <tr>
                                <td></td>
                                <td><input type="submit" class='tiny button small radius' value='Login' name='login'/></td>
                            </tr>
                        </table>
        </form>
   
    

    </div>  
  </body>

</html>
<?php
}
?>