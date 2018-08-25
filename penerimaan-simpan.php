<?php
	$no_penerimaan = $_POST['no_penerimaan'];
	$tgl_penerimaan = $_POST['tgl_penerimaan'];
	$nm_penerimaan = $_POST['nm_penerimaan'];
	$jml_penerimaan = $_POST['jml_penerimaan'];
	
	/*
	//Validasi saldo max
	if (strlen(trim($jml_penerimaan)) == 0){
	$pesan = "Saldo Max";

		echo "
			<script>
			alert('$pesan');
			self.history.back();
			</script>
		";
		exit; 
	} */

	//menghilangkan titik ribuan
	$jml_penerimaan1 = str_replace(".", "", $jml_penerimaan);
	//aktifkan jika metode imprest=> $jml_penerimaan2 = str_replace(",", "", $jml_penerimaan);

	//validasi untuk duplikat data
	include "koneksi.php";

	$cek = mysqli_num_rows(mysqli_query($konek, 
		"SELECT * FROM penerimaan_kk WHERE no_penerimaan='$no_penerimaan'"));
    if ($cek > 0){
    echo "<script>window.alert('Tidak Dapat Simpan, NO PENERIMAAN SUDAH ADA')
    window.location='input-penerimaan.php'</script>";
    }else { //ini berhasil, simpan data

    	//pengisian level akun
        if ($nm_penerimaan == 'Pembentukan Kas Kecil'){
        $level = 1;
        }else{
        $level = 2;
        }

//validasi tanggal > tgl sistem
$tanggal_transaksi = date_create($tgl_penerimaan);
$pesan1 = "TIDAK DAPAT SIMPAN, tanggal ".date_format($tanggal_transaksi, "Y-m-d")." belum terjadi transaksi, sekarang tanggal ".date("Y-m-d");
	if((date("Y-m-d", strtotime("+0 days")) < date_format($tanggal_transaksi,"Y-m-d"))){
	echo "
			<script>
				alert('$pesan1');
				self.history.back();
			</script>
	";
	exit;
}

//validasi tanggal transaksi kini < tgl transaksi terakhir
	//ambil tanggal terakhir                
    $sql = "select tgl_kaskecil from kas_kecil order by tgl_kaskecil desc limit 1";
		$tes = mysqli_query($konek, $sql);
		$dt = mysqli_fetch_assoc($tes);
		$tgl_terakhir = $dt['tgl_kaskecil'];
	
	//validasi
	$tgl_tran = date_create($tgl_penerimaan);
	$tgl_akhir = date_create($tgl_terakhir);
	$pesan2 = "TIDAK DAPAT SIMPAN, tanggal transaksi terakhir telah tersimpan pada ".date_format($tgl_akhir, "Y-m-d");
	if((date_format($tgl_tran,"Y-m-d") < date_format($tgl_akhir,"Y-m-d"))){
	echo "
			<script>
				alert('$pesan2');
				self.history.back();			
			</script>
	";
	exit;
}

    //ambil nilai saldo                
    $sql = "select SUM(IF(nm_akun = 'Kas', jml_transaksi, 0)) 
    		- SUM(IF(nm_akun NOT IN ('Kas'), jml_transaksi, 0)) 
    		as saldo from kas_kecil";
		$tes = mysqli_query($konek, $sql);
		$dt = mysqli_fetch_assoc($tes);
		$saldo = $dt['saldo'];


    	//aktifkan jika metode imprest=> if ($nm_penerimaan == 'Pembentukan Kas Kecil') {
    		$sql1 = "insert into penerimaan_kk 
					(no_penerimaan, tgl_penerimaan, nm_penerimaan, jml_penerimaan)
					values
					('$no_penerimaan', '$tgl_penerimaan', '$nm_penerimaan', '$jml_penerimaan1')
					";

			$sql2 = "insert into kas_kecil 
					(no_kaskecil, tgl_kaskecil, jml_transaksi, nm_akun, keterangan, level, no_penerimaan)
					values
					('$no_penerimaan', '$tgl_penerimaan', '$jml_penerimaan1', 'Kas', '$nm_penerimaan', '$level', '$no_penerimaan')
					";
			$sql3 = "update kas_kecil set 
                    saldo = (($saldo + $jml_penerimaan1))
                    where no_kaskecil = '$no_penerimaan'
                    ";
					
    	/* aktifkan jika metode imprest
    	}else{
    		$sql1 = "insert into penerimaan_kk 
					(no_penerimaan, tgl_penerimaan, nm_penerimaan, jml_penerimaan)
					values
					('$no_penerimaan', '$tgl_penerimaan', '$nm_penerimaan', '$jml_penerimaan2')
					";

			$sql2 = "insert into kas_kecil 
					(no_kaskecil, tgl_kaskecil, jml_transaksi, nm_akun, keterangan, no_penerimaan)
					values
					('$no_penerimaan', '$tgl_penerimaan', '$jml_penerimaan2', 'Kas', '$nm_penerimaan', '$no_penerimaan')
					";
    	} */	

	$hasil = mysqli_query($konek, $sql1);
	$hasil = mysqli_query($konek, $sql2);
	$hasil = mysqli_query($konek, $sql3);

    echo "<script>window.alert('DATA SUDAH DISIMPAN')
    window.location='input-penerimaan.php'</script>"; 
    }
 
?>