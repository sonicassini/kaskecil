<?php
include "koneksi.php";
	$no_biaya 	= $_POST['no_biaya'];
	$nm_biaya 	= $_POST['nm_biaya'];

	//validasi untuk duplikat data
    //ambil jumlah data no biaya
	$cek1 = mysqli_num_rows(mysqli_query($konek, "SELECT * FROM biaya 
        WHERE no_biaya='$no_biaya'"));
    //ambil jumlah data nama biaya
	$cek2 = mysqli_num_rows(mysqli_query($konek, "SELECT * FROM biaya 
        WHERE nm_biaya='$nm_biaya'"));

	//jika No Biaya sudah ada tampil alert
	if ($cek1 > 0){
    echo "<script>window.alert('Tidak Dapat Simpan, NO BIAYA SUDAH ADA')
    window.location='input-biaya.php'</script>";
    }
    //jika Nama Biaya sudah ada tampil alert
    if ($cek2 > 0){
    echo "<script>window.alert('Tidak Dapat Simpan, NAMA BIAYA SUDAH ADA')
    window.location='input-biaya.php'</script>";
    }else { //ini berhasil, simpan data
 
            $sql = "insert into biaya 
                    (no_biaya, nm_biaya)
                    values
                    ('$no_biaya', '$nm_biaya')";    

        $hasil = mysqli_query($konek, $sql);

    //jika data telah disimpan, tampil alert
   	echo "<script>window.alert('DATA SUDAH DISIMPAN')
    window.location='input-biaya.php'</script>"; 
    }
?>