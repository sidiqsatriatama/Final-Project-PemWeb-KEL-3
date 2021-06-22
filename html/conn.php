<?php
	//konfigurasi database
	$host 		= "localhost";
	$user 		= "root";
	$password 	= "";
	$database 	= "onnary";

	// akses ke database
	$koneksi = mysqli_connect($host, $user, $password, $database);
	if(!$koneksi){
		die("Koneksi gagal : " . msqli_connect_error());
	}
 
?>