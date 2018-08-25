<?php
include "koneksi.php";
	$no_biaya 	= $_POST['no_biaya'];
	$nm_biaya 	= $_POST['nm_biaya'];

	//validasi untuk duplikat data
	$cek2 = mysqli_num_rows(mysqli_query($konek, "SELECT * FROM biaya WHERE nm_biaya='$nm_biaya'"));

    //validasi Nama Biaya
    if ($cek2 > 0){
    echo "<script>window.alert('Tidak Dapat Update, NAMA BIAYA SUDAH ADA')
    window.location='tampil-biaya.php'</script>";
    }else { //ini berhasil, simpan data
   
        $sql = "update biaya set 
                    nm_biaya = '$nm_biaya'
                    where no_biaya = '$no_biaya'
                    ";
  

        $hasil = mysqli_query($konek, $sql);
        
        

   	echo "<script>window.alert('DATA SUDAH DI UPDATE')
    window.location='tampil-biaya.php'</script>"; 
    }
?>