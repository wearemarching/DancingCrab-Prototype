<!DOCTYPE html>
<html>
<head>
	<title>Dancing Crab Indonesia</title>

	<meta charset="UTF-8">

	<link rel="stylesheet" href="css/laporan.css" type="text/css">
	<link href="https://fonts.googleapis.com/css?family=Montserrat" rel="stylesheet">
	<script src="js/laporan.js"></script>
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

	<div id="title">Permintaan Laporan Keuangan</div>
	
	<section class="form-section">
		<div class="laporan">
			<center><form method='post' onsubmit="return verify_input();">
				Tanggal Awal: 
				<input type="date" id="tanggalAwal" name="tanggalAwal">
				<br>
				Tanggal Akhir: 
				<input type="date" id="tanggalAkhir" name="tanggalAkhir">
				<br>
				</center>
				<center><input type="submit" name="add" value="Buat Laporan Keuangan" class="buttonlaporan"></center>
				</div>
			</form>
		</div><br><br>
		<?php
			if (isset($_POST['tanggalAwal']) && isset($_POST['tanggalAkhir'])) {
				
				echo "<center><b>Laporan Keuangan</b></center>";
				echo "<br>";
				echo "<table>";
				echo "	<col width='10'>";
				echo "	<col width='20'>";
				echo "	<col width='190'>";
				echo "	<col width='20'>";
				echo "	<col width='100'>";
				echo "	<col width='50'>";
				echo "	<col width='20'>";
				echo "	<tr>";
				echo "		<th>No</th>";
				echo "		<th>Kode</th>";
				echo "		<th>Nama Barang</th>";
				echo "		<th>Kuantitas</th>";
				echo "		<th>Supplier</th>";
				echo "		<th>Harga</th>";
				echo "		<th>Status Pembayaran</th>";
				echo "	</tr>";
			
				$dbservername="localhost";
				$dbusername="root";
				$dbpassword="";
				$database="backoffice";
				$conn = mysqli_connect($dbservername,$dbusername,$dbpassword,$database);
				
				$sql = "SELECT barang.ID_Barang, barang.Nama_Barang, supplier.Nama_Supplier, purchasebarang.Kuantitas, purchasebarang.Harga, purchasebarang.Status_Pembayaran FROM barang INNER JOIN purchasebarang ON barang.ID_Barang = purchasebarang.ID_Barang INNER JOIN supplier ON purchasebarang.ID_Supplier = supplier.ID_Supplier WHERE Tanggal_Pemesanan > '" . $_POST['tanggalAwal'] . "' AND Tanggal_Pemesanan < '" . $_POST['tanggalAkhir'] . "';";
				$result = $conn->query($sql);
				$totallunas = 0;
				$totalnonlunas = 0;
				$i = 1;
				
				while ($row = $result->fetch_assoc()) {
					echo "<tr>";
					echo "<td align='center'>" . $i . "</td>";
					echo "<td align='center'>B" . $row["ID_Barang"] . "</td>";
					echo "<td>" . $row["Nama_Barang"] . "</td>";
					echo "<td align='center'>" . number_format($row["Kuantitas"], 0, ',', '.') . " gr</td>";
					echo "<td>" . $row["Nama_Supplier"] . "</td>";
					echo "<td>" . 'Rp ' . number_format($row["Harga"], 2, ',', '.') . "</td>";
					if ($row['Status_Pembayaran'] == 1) {
						echo "<td align='center'>Lunas</td>";
						$totallunas += $row["Harga"];
					} else {
						echo "<td align='center'>Belum</td>";
						$totalnonlunas += $row["Harga"];
					}
					echo "</tr>";
					$i++;
				};
				$total = $totalnonlunas+$totallunas;
				echo "</table><br>";
				echo "<table>";
				echo "	<col width='260'>";
				echo "	<col width='150'>";
				echo "	<tr>";
				echo "		<th>Total Pembayaran (Lunas):</th>";
				echo "		<td>" . 'Rp ' . number_format($totallunas, 2, ',', '.') . "</td>";
				echo "	</tr>";
				echo "	<tr>";
				echo "		<th>Total Pembayaran (Belum Lunas):</th>";
				echo "		<td>" . 'Rp ' . number_format($totalnonlunas, 2, ',', '.') . "</td>";
				echo "	</tr>";
				echo "	<tr>";
				echo "		<th>Total Pembelian:</th>";
				echo "		<td>" . 'Rp ' . number_format($total, 2, ',', '.') . "</td>";
				echo "	</tr>";
				echo "</table>";
			} 
		?>
		<br><br>
	</section>


	<div class="footer">
		Copyright © 2017 Dancing Crab Indonesia
	</div>

	
</body>
</html>
