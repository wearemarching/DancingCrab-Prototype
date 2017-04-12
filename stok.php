<!DOCTYPE html>
<html>
<head>
	<title>Dancing Crab Indonesia</title>

	<meta charset="UTF-8">

	<link rel="stylesheet" href="css/stok.css" type="text/css">
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

	<div id="title">Stok Barang</div>
	
	<section class="form-section">
		<br><br><br>
		<table>
			<col width="20">
			<col width="200">
			<col width="20">
			<col width="20">
			<tr>
				<th>Kode</th>
				<th>Nama Barang</th>
				<th>Kuantitas</th>
				<th>Aksi</th>
			</tr>
			<?php
				if ($_SERVER["REQUEST_METHOD"] == "GET") {
					$dbservername="localhost";
					$dbusername="root";
					$dbpassword="";
					$database="backoffice";
					$conn = mysqli_connect($dbservername,$dbusername,$dbpassword,$database);
					
					$sql = "SELECT * FROM `barang`";
					$result = $conn->query($sql);
					
					while ($row = $result->fetch_assoc()) {
						echo "<tr>";
						echo "<td align='center'>B" . $row["ID_Barang"] . "</td>";
						echo "<td>" . $row["Nama_Barang"] . "</td>";
						echo "<td align='center'>" . number_format($row["Jumlah"], 0, ',', '.') . " gr</td>";
						echo "<td align='center'><a href = editbarang.php?ID_Barang=" . $row["ID_Barang"] . ">Edit</a></td>";
						echo "</tr>";
					};
				}
			?>
			<!-- <tr>
				<td align="center">B323</td>
				<td>Garam</td>
				<td align="center">1000gr</td>
			</tr> -->
		</table>
		<center>
			<div style="display: inline;">
				<button class="buttonstok" onclick="location.href='tambahbarang.html'">Tambah Barang</button>
			</div>
		</center>
		<br><br>
	</section>


	<div class="footer">
		Copyright © 2017 Dancing Crab Indonesia
	</div>

	
</body>
</html>
