
<?php
include"config/class_paging.php";
?>
<style type="text/css">
@import"config/paging3.css";
</style>
<table class='display' id='tabeldata' border='1'>
  <thead> 
  <tr>
    <th width='5px'>No</th>  
    <th>Nama</th>
    <th align='center'>Divisi</th>
    <th align='center'>Status Pegawai</th>
    <th align='center'>Waktu datang</th>
    <th align='center'>Waktu pulang</th>
  </tr>
  </thead>
<tbody>
<?php
$a = new Paging;
$limit =15;
$posisi = $a->cariPosisi($limit);
$ambil=mysql_query("select*from pegawai,status_pegawai,divisi where pegawai.id_status_pegawai=status_pegawai.id_status_pegawai and pegawai.id_divisi=divisi.id_divisi and status='1' limit $posisi,$limit");
$no = $posisi + 1;
while($tampil=mysql_fetch_array($ambil)){
?>
<tr>
   <td><?php echo"$no";?></td> 
   <td><?php echo"$tampil[nama]";?></td>
   <td><?php echo"$tampil[nama_divisi]";?></td>
   <td><?php echo"$tampil[status_pegawai]";?></td>
   <td>
    <?php
      $id_pegawai=$tampil['id_pegawai'];
      $date=gmdate('Y-m-d',time()+60*60*7);
      $data=mysql_query("select*from absensi where id_pegawai='$id_pegawai' and tanggal='$date' limit 1");
      $cek=mysql_num_rows($data);
      if($cek>=1){
        $tampil_waktu_datang=mysql_fetch_array($data);
        $tampil_keterangan=$tampil_waktu_datang['keterangan'];
        $time=$tampil_waktu_datang['datang'];
        if(($tampil_keterangan=='04')and ($time>'08:05:00')){
          echo"<b style='color:red;'>$time</b>";
        }else if(($tampil_keterangan=='04')and ($time<='08:05:00')){
            echo"<b style='color:orange;'>$time</b>";  
        }else if($tampil_keterangan=='02'){
              echo"<b>Izin</b>";    
        }else if($tampil_keterangan=='03'){
                    echo"<b>Sakit</b>";      
        }else{
              echo"<b>$time</b>";    
        
        }
      }else{
     ?>    
        <a href='?page=kedatangan&id_pegawai=<?php echo"$id_pegawai";?>' style='text-decoration:none;'>Belum datang</a>
    <?php    

      }
    ?>
    
  </td>
  <td>
    <?php
    //$muleh=mysql_query("select pulang from absensi where id_pegawai='$id_pegawai' and tanggal='$date' limit 1");
    //$tiliki=mysql_num_rows($muleh);
    //$waktu_muleh=$tiliki['pulang'];

    //untuk ambil waktu jika sudah pulang brohh
      $ambil_genah_muleh=mysql_query("select*from absensi where id_pegawai='$id_pegawai' and tanggal='$date' limit 1");
      $cek_genah_muleh=mysql_num_rows($ambil_genah_muleh);

      if($cek_genah_muleh>=1){
          $tampil_genah_muleh=mysql_fetch_array($ambil_genah_muleh);
          $keterangan=$tampil_genah_muleh['keterangan'];
          $genah_muleh=$tampil_genah_muleh['pulang'];
          if($genah_muleh!='00:00:00' and $keterangan!='02' and $keterangan!='03'){
            echo"$genah_muleh";
          }else if($keterangan=='02'){
            echo"<b>Izin</b>";
          }else if($keterangan=='03'){
              echo"<b>Sakit</b>";  
          }else{
                echo"<a href='?page=kepulangan&id_pegawai=$id_pegawai'>Belum pulang</a>";          
          }

      }else{
        echo"<a href='#'>Belum pulang</a>";
      }
      ?>
  </td>
</tr>
<?php
    $no++;
}
?>
</tbody>
</table><br>
<?php
$jmldata = mysql_num_rows(mysql_query("select*from pegawai,status_pegawai,divisi where pegawai.id_status_pegawai=status_pegawai.id_status_pegawai and pegawai.id_divisi=divisi.id_divisi"));
$jmlhalaman  = $a->jumlahHalaman($jmldata, $limit);
$linkHalaman = $a->navHalaman($_GET[halaman], $jmlhalaman);

echo "<div class=paging>Hal: $linkHalaman</div><br>";


?>



 

 

