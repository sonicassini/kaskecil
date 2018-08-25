<?php
	$no_pengeluaran = $_POST['no_pengeluaran'];
	$tgl_pengeluaran = $_POST['tgl_pengeluaran'];
	$no_biaya 	= $_POST['no_biaya'];
	$jml_pengeluaran = $_POST['jml_pengeluaran'];
	$keterangan = $_POST['keterangan'];
	//menghilangkan titik ribuan
	$jml_pengeluaran1 = str_replace(".", "", $jml_pengeluaran);

	
	include "koneksi.php";
	//ubah no_biaya menjadi nm_biaya
	$res = mysqli_query($konek, "select * from biaya");
                    if (!$res) die("Gagal Query Biaya");
                    while($row = mysqli_fetch_assoc($res)){
                    	if ($no_biaya=="{$row['no_biaya']}")  $nm_biaya="{$row['nm_biaya']}";
                    }
    //ambil nilai saldo                
    $sql = "select SUM(IF(nm_akun = 'Kas', jml_transaksi, 0)) 
    		- SUM(IF(nm_akun NOT IN ('Kas'), jml_transaksi, 0)) 
    		as saldo from kas_kecil";
		$tes = mysqli_query($konek, $sql);
		$dt = mysqli_fetch_assoc($tes);
		$saldo = $dt['saldo'];

    //Validasi jika melebihi saldo
    $pesan = "TIDAK DAPAT SIMPAN \\n" ;
    if ($jml_pengeluaran1 > $saldo){
		$pesan .= "Saldo Tidak Mencukupi \\n";
		echo "
			<script>
			alert('$pesan');
			self.history.back();
			</script>
		";
		exit; 
		}

//validasi tanggal > tgl sistem
$tanggal_transaksi = date_create($tgl_pengeluaran);
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
	$tgl_tran = date_create($tgl_pengeluaran);
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

    //validasi untuk duplikat data
	$cek = mysqli_num_rows(mysqli_query($konek, "SELECT * FROM pengeluaran_kk WHERE no_pengeluaran='$no_pengeluaran'"));
    if ($cek > 0){
    echo "<script>window.alert('Tidak Dapat Simpan, NO PENGELUARAN SUDAH ADA')
    window.location='input-pengeluaran.php'</script>";
    }else { //ini berhasil, simpan data
    	$sql1 = "insert into pengeluaran_kk 
					(no_pengeluaran, tgl_pengeluaran, no_biaya, 
					jml_pengeluaran, nm_pengeluaran)
					values
					('$no_pengeluaran', '$tgl_pengeluaran', '$no_biaya', 
					'$jml_pengeluaran1', '$nm_biaya')";

		$sql2 = "insert into kas_kecil 
					(no_kaskecil, tgl_kaskecil, jml_transaksi, nm_akun, 
					keterangan, level, no_pengeluaran)
					values
					('$no_pengeluaran', '$tgl_pengeluaran', '$jml_pengeluaran1', 
					'$nm_biaya', '$keterangan', '3', '$no_pengeluaran')";
		
		$sql3 = "update kas_kecil set 
                    saldo = (($saldo - $jml_pengeluaran1))
                    where no_kaskecil = '$no_pengeluaran'
                    ";

	$hasil = mysqli_query($konek, $sql1);
	$hasil = mysqli_query($konek, $sql2);
	$hasil = mysqli_query($konek, $sql3);

    echo "<script>window.alert('DATA SUDAH DISIMPAN')
    window.location='input-pengeluaran.php'</script>";
    }
 
?>