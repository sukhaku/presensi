<?php
session_start();
include"include/koneksi.php";
if(isset($_SESSION['username']))
{
include"include/utama.php";
//echo"<a href='include/logout.php'>logout</a>";
}else{  
      include"../config/koneksi.php";
      if(isset($_POST['login'])){
            $username=$_POST['username'];
            $password=md5($_POST['password']);
            $ambil=mysql_query("select*from admin where username='$username' and password='$password'");
            $cek=mysql_num_rows($ambil);
            $tampil=mysql_fetch_array($ambil);
            if($cek>=1){
              $_SESSION['username']=$tampil['username'];
              $_SESSION['password']=$tampil['password'];
              $_SESSION['level']=$tampil['level'];
              header("location:index.php");
            }else{
              echo"<script>alert('Username dan password salah !!');javascript:history.go(-1)</script>";
              }

      }else{
      ?>
      <style type="text/css">
      @import "../css/foundation.css";
      #masuk{
        text-decoration: none;
        border:none;
        margin-top:150px;
        padding:5px;

      }
      </style>
      <html>
        <head>
          <link rel="shortcut icon" href="../images/lock.png">
          <title>PT.Inovasi Tritek Informasi</title>
        </head>
        
        <body>
          <form method="post" action="index.php">
                      
                          <table cellpadding="0" cellspacing="0" align="center" id="masuk">
    
                              <tr>
                                  <td rowspan="4"><img src="../images/lock.png"/></td>
                                  <td colspan="2"><small><h2>Login Administrator</h2></small></td>
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
        </body>

      </html>
      <?php
      }
    }
      ?>