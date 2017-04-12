<?php

	$servername = "localhost";
	$dbusername = "root";
	$dbpassword = "";
	$dbname = "backoffice";

	$ID_Barang = $_GET['ID_Barang'];
	$Nama_Barang = (isset($_POST['Nama_Barang']) ? $_POST['Nama_Barang'] : '');
	$Kemasan = (isset($_POST['Kemasan']) ? $_POST['Kemasan'] : '');
	$Harga = (isset($_POST['Harga']) ? $_POST['Harga'] : '');
	$Jumlah = (isset($_POST['Jumlah']) ? $_POST['Jumlah'] : '');
	$Kategori = (isset($_POST['Kategori']) ? $_POST['Kategori'] : '');


	$con = new mysqli($servername, $dbusername, $dbpassword, $dbname);
	
	if ($con->connect_error) {
		die("connection failed: " . $con->connect_error);
	}

	$sql = "UPDATE barang SET Nama_Barang = '$Nama_Barang', Kemasan = '$Kemasan', Harga = '$Harga', Jumlah = '$Jumlah', Kategori = '$Kategori' WHERE ID_Barang = '$ID_Barang'";

	$con->query($sql);

	$con->close();

	header("Location: stok.php"); exit();
?>