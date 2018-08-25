<?php
	session_start();
	$username	= htmlspecialchars($_POST['username']);
	$password	= htmlspecialchars($_POST['password']);
	include "koneksi.php";
	$sql = "select * from pengguna 
			where username = '$username'
					and password = ('$password')";
	$hasil = mysqli_query($konek, $sql);
	if (!$hasil) die("gagal Query User");
	// sampai sini berarti berhasil query.
	// Data user dan password dianggap benar, jika
	//   terdapat data yang sesuai / ditemukan
	//   cirinya adalah banyak baris > 0
	if (mysqli_num_rows($hasil) > 0){
		// ini berarti data ditemukan
		// ambil nama dan level dari user
		$dt = mysqli_fetch_assoc($hasil);
		// masukkan ke session
		$_SESSION['username'] 	= $dt['username'];
		$_SESSION['password']	= $dt['password'];
		// jalankan home.php
		header("location:home.php");

	} else {
		//jika tidak ada baris data yg ditemukan
		//berarti user atau password salah
		//jalankan lagi file login.php
		header("location:login.php?pesan=Username atau Password anda salah");

	}

?>