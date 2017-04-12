<!DOCTYPE html>
<html>
<head>
	<title>Dancing Crab Indonesia</title>

	<meta charset="UTF-8">

	<link rel="stylesheet" href="css/pemesanan.css" type="text/css">
	<link href="https://fonts.googleapis.com/css?family=Montserrat" rel="stylesheet">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.0/jquery.min.js"></script>
	<script src="js/pemesanan.js"></script>
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

	<?php
		if ($_POST) {
			$dbservername="localhost";
			$dbusername="root";
			$dbpassword="";
			$database="backoffice";
			$conn = mysqli_connect($dbservername,$dbusername,$dbpassword,$database);
			
			if (isset($_POST['deleteid'])) {
				$sql = "DELETE FROM `purchasebarang` WHERE `purchasebarang`.`ID_Pembelian` = " . $_POST['deleteid'];
				$result = $conn->query($sql);
			}
			
			if (isset($_POST['barang'])) {
				$idbarang = $_POST['barang'];
				$idsupplier = $_POST['supplier'];
				$jumlah = $_POST['kuantitas'];
			
				$sql = "SELECT * FROM barang WHERE barang.ID_Barang = " . $idbarang;
				$result = $conn->query($sql);
				$row = $result->fetch_assoc();
				$harga = $row["Harga"] * $jumlah;
				
				$sql = "INSERT INTO `purchasebarang` (`ID_Pembelian`, `ID_Barang`, `Kuantitas`, `ID_Supplier`, `Harga`, `Tanggal_Pemesanan`, `Status_Penerimaan`, `Tanggal_Penerimaan`, `Status_Pembayaran`, `Tanggal_Pembayaran`) VALUES (NULL, '" . $idbarang ."', '" . $jumlah . "', '" . $idsupplier . "', '" . $harga . "', CURRENT_TIMESTAMP, '0', NULL, '0', NULL);";
				$result = $conn->query($sql);
			}
		}
	?>
	<div id="title">Pemesanan Barang</div>
	
	<section class="form-section">
		<div class="form">
			<form action="pemesanan.php" method="post" onsubmit="return verify_input();">
				Nama Barang: 
				<select id="barang" name="barang" id="dropdown" onchange="get_supplier();">
					<option disabled selected value>-- Pilih Nama Barang --</option>					
					<?php
						$dbservername="localhost";
						$dbusername="root";
						$dbpassword="";
						$database="backoffice";
						$conn = mysqli_connect($dbservername,$dbusername,$dbpassword,$database);
						
						$sql = "SELECT * FROM `barang`";
						$result = $conn->query($sql);
						
						while ($row = $result->fetch_assoc()) {
							echo "<option value='". $row["ID_Barang"] . "'>" . $row["Nama_Barang"] . "</option>";
						};
					?>
					<!-- <option value="barang1">barang1</option>
					<option value="barang2">barang2</option>
					<option value="barang3">barang3</option> -->
				</select>
				<br>
				Kuantitas: 
				<input type="text" id="kuantitas" name="kuantitas">
				<br>
				<div id="get_supplier">
					Supplier: 
					<select id="supplier" name="supplier" id="dropdown">
						<option disabled selected value>-- Pilih Supplier --</option>
					</select>
					<!-- <select name="supplier" id="dropdown">
						<option disabled selected value>-- Pilih Supplier --</option>
						<option value="supplier1">supplier1</option>
						<option value="supplier2">supplier2</option>
						<option value="supplier3">supplier3</option>
					</select> -->
				</div>
				<br>
				<div style="float: right;">
				<input type="submit" name="add" value="Tambah Barang" class="buttonadd">
				</div>
			</form>
		</div><br><br><br><br>
		<table>
			<col width="20">
			<col width="200">
			<col width="20">
			<col width="100">
			<col width="50">
			<col width="20">
			<tr>
				<th>Kode</th>
				<th>Nama Barang</th>
				<th>Kuantitas</th>
				<th>Supplier</th>
				<th>Harga</th>
				<th>Edit</th>
			</tr>
			<!--
			<tr>
				<td align="center">B212</td>
				<td>Gula Pasir</td>
				<td align="center">1000gr</td>
				<td>Indofood</td>
				<td>100.000</td>
				<td align="center"><img src="cancel.png" width="15"></td>
			</tr>
			-->
			<?php 
				$dbservername="localhost";
				$dbusername="root";
				$dbpassword="";
				$database="backoffice";
				$conn = mysqli_connect($dbservername,$dbusername,$dbpassword,$database);
				
				$sql = "SELECT purchasebarang.ID_Pembelian, barang.ID_Barang, barang.Nama_Barang, supplier.Nama_Supplier, purchasebarang.Kuantitas, purchasebarang.Harga FROM barang INNER JOIN purchasebarang ON barang.ID_Barang = purchasebarang.ID_Barang INNER JOIN supplier ON purchasebarang.ID_Supplier = supplier.ID_Supplier WHERE purchasebarang.Status_Penerimaan = 0;";
				$result = $conn->query($sql);
				
				while ($row = $result->fetch_assoc()) {
					echo "<tr>";
					echo "<td align='center'>B" . $row["ID_Barang"] . "</td>";
					echo "<td>" . $row["Nama_Barang"] . "</td>";
					echo "<td align='center'>" . number_format($row["Kuantitas"], 0, ',', '.') . " gr</td>";
					echo "<td>" . $row["Nama_Supplier"] . "</td>";
					echo "<td>" . 'Rp ' . number_format($row["Harga"], 2, ',', '.') . "</td>";
					echo "<form method='post'><td align='center'><input type='image' src='assets/cancel.png' width='15' onclick=\"return confirm('Are you sure you want to remove this item?');\"></td>";
					echo "<input type='hidden' name='deleteid' value='" . $row["ID_Pembelian"] . "'></form>";
					echo "</tr>";
				};			
			?>
		</table>
		<br><br>
	</section>


	<div class="footer">
		Copyright © 2017 Dancing Crab Indonesia
	</div>
	
	<script type="text/javascript">
	function get_supplier() { // Call to ajax function
		var idbarang = $('#barang').val();
		var dataString = "ID_Barang="+idbarang;
		$.ajax({
			type: "POST",
			url: "getSupplier.php", // Name of the php files
			data: dataString,
			success: function(html)
			{
				$("#get_supplier").html(html);
			}
		});
	}
	</script>

</body>
</html>
