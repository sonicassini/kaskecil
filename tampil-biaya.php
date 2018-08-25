<head>
<link href="wow.css" type="text/css" rel="stylesheet" />
<link href="dp.css" type="text/css" rel="stylesheet" />
<link href="gg.css" type="text/css" rel="stylesheet" />
<link rel="stylesheet" type="text/css" href="gaya.css">
</head>
<body background="body_back.gif"/>
<?php
  include "atas.php";
?>
<div id="wrap">	
<div id="atas">
  <ul>
    <li><a href="home.php">HOME</a></li>
    <li class="dropdown">
      <a href="javascript:void(0)" class="dropbtn">INPUT DATA</a>
      <div class="dropdown-content">
        <a href="input-biaya.php">Input Biaya</a>
        <a href="input-penerimaan.php">Input Penerimaan Kas Kecil</a>
        <a href="input-pengeluaran.php">Input Pengeluaran Kas Kecil</a>
      </div>
    </li>  
    <li><a href="menu-laporan.php">LAPORAN</a></li>
  </ul>
</div>
<center>
<div id="tampil">   
  <h3 align='center'>DAFTAR BIAYA</h3>
  <?php
    include "koneksi.php";
    $sql = "select * from biaya";

    $hasil = mysqli_query($konek, $sql);
  
    $jumData = mysqli_num_rows($hasil);
      echo "<h4 align=right>Biaya Yang Dianggarkan : <b>$jumData</b> Biaya</h4>";
      echo "<input type='image' style='margin-left:90%; height: 60px' src='print.png' onclick='cetak()'>";

    //validasi jika data kosong
    $dataOke = "YA";
    $pesan = "";

    if ($jumData == 0){
      $pesan .= "SILAHKAN INPUT DATA BIAYA \\n";
      $dataOke = "TIDAK";
    }

    //tampilkan pesan
    if($dataOke == "TIDAK"){
      $pesan = "Tidak Ada Biaya Yang Ditampilkan \\n\\n".$pesan;
      echo "
        <script>
        alert('$pesan');
        self.history.back();
        </script>
      ";
    exit; 
  }
  ?>
  
  <?php
    echo "<table border='1' class='grid' align='center' width='800px' height='150px'>";
    echo "<tr>";
    echo "<th>NO</th><th>NO BIAYA</th><th>NAMA BIAYA</th><th>EDIT</th>";
    echo "</tr>"; 
    
    //kalo sampe sini berarti berhasil query
    $no = 0;
    while($data = mysqli_fetch_assoc($hasil)){
      $no++;
      if($no % 2 == 0)
        echo "<tr class='genap'>";
      else
        echo "<tr class='ganjil'>";

      echo "<td style='width:50px' align='center'> $no </td>";

      echo "<td width='20%' align='center'>".$data['no_biaya']."</td>"
        ."<td>".$data['nm_biaya']."</td>";

      echo "
        <td align='center'>

        <a href='biaya-edit.php?no_biaya={$data['no_biaya']}'><img src='edit.png' style='height: 40px'/></a>

        </td>
        ";

      echo "</tr>";
    }
  ?>
  </table>
  <br />
  
  <script>
    function cetak(){
      window.open("biaya-cetak.php","_blank");
    }
  </script> 
</div>
</center>   
<div id="footer">
	<p style="font:14px verdana">
		Sistem Pencatatan Dana Kas Kecil - Metode Fluktuasi
    <br/>
    - Daftar Biaya - 
	</p>
</div>
</body>
</div>
