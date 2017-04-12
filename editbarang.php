<!DOCTYPE html>
<html>
<head>
	<title>Dancing Crab Indonesia</title>

	<meta charset="UTF-8">

	<link rel="stylesheet" href="css/editbarang.css" type="text/css">
	<link href="https://fonts.googleapis.com/css?family=Montserrat" rel="stylesheet">
</head>
<body>
	<nav>
		<img src="assets/logo.png" style="vertical-align: middle;" width="3%" onclick="location.href='home.html'">
		<center>
		<div id="navigation"><a href="pemesanan.php">Pemesanan Barang</a></div>
		<div id="navigation"><a href="penerimaan.php">Penerimaan Barang</a></div>
		<div id="navigation"><a href="pembayaran.php">Pembayaran Barang</a></div>
		<div id="navigation"><a href="stok.php">Stok Barang</a></div>
		<div id="navigation"><a href="laporan.php">Laporan Keuangan</a></div>
		</center>
	</nav>

	<div id="title">Edit Barang</div>

	<?php

		$servername = "localhost";
		$dbusername = "root";
		$dbpassword = "";
		$dbname = "backoffice";

		$con = new mysqli($servername, $dbusername, $dbpassword, $dbname);

		$ID_Barang = $_GET['ID_Barang'];

		$sql = "SELECT ID_Barang, Nama_Barang, Kemasan, Harga, Jumlah, Kategori FROM barang WHERE ID_Barang='$ID_Barang'";
		$result = mysqli_query($con, $sql);
		$row = mysqli_fetch_array($result);
	?>
	
	<section class="form-section">
		<div class="form">
			<form name="editbarang" action="edit.php?ID_Barang=<?php echo $ID_Barang;?>" method="post">
				Nama Barang <br>
				<input type="text" name="Nama_Barang" style="width: 600px;" value="<?php echo $row['Nama_Barang']; ?>">
				<br>
				Kemasan <br>
				<input type="text" name="Kemasan" style="width: 600px;" value="<?php echo $row['Kemasan']; ?>">
				<br>
				Harga <br>
				<input type="number" name="Harga" style="width: 600px;" value="<?php echo $row['Harga']; ?>">
				<br>
				Jumlah <br>
				<input type="number" name="Jumlah" style="width: 600px;" value="<?php echo $row['Jumlah']; ?>">
				<br>
				<br>
				<div style="float: right;">
					<input type="submit" value="Edit" class="buttonadd">
				</div>
			</form>
		<br><br><br><br>

	</section>


	<div class="footer">
		Copyright © 2017 Dancing Crab Indonesia
	</div>

	
</body>
</html>
