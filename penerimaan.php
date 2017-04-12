<!DOCTYPE html>
<html>
<head>
	<title>Dancing Crab Indonesia</title>

	<meta charset="UTF-8">

	<link rel="stylesheet" href="css/penerimaan.css" type="text/css">
	<link href="https://fonts.googleapis.com/css?family=Montserrat" rel="stylesheet">
	<script src="js/penerimaan.js"></script>
</head>
<?php
	if ($_SERVER["REQUEST_METHOD"] == "POST") {
		
		$dbservername="localhost";
		$dbusername="root";
		$dbpassword="";
		$database="backoffice";
		$conn = mysqli_connect($dbservername,$dbusername,$dbpassword,$database);
		
		$subject="Notifikasi Pembayaran";
		$msg="Email ini ditujukan sebagai reminder pembayaran untuk barang-barang berikut:\n";
		$to="jasongustaman@gmail.com";
		$header="";
		
	   foreach($_POST['purchase'] as $check) {
			$sql = "SELECT * FROM barang INNER JOIN purchasebarang ON barang.ID_Barang = purchasebarang.ID_Barang INNER JOIN supplier ON purchasebarang.ID_Supplier = supplier.ID_Supplier WHERE purchasebarang.ID_Pembelian = " . $check . ";";
			$result = $conn->query($sql);
			$row = $result->fetch_assoc();
			$msg = $msg . "- " . $row['Nama_Barang'] . " (" . $row['Kuantitas'] . " gr) : Rp. " . number_format($row["Harga"], 2, ',', '.') . " - " . $row['Nama_Supplier'] . "\n";
			
			$sql = "UPDATE `purchasebarang` SET `Status_Penerimaan` = '1', `Tanggal_Penerimaan` = CURRENT_TIME() WHERE `purchasebarang`.`ID_Pembelian` = " . $check . ";";
			$result = $conn->query($sql);
		}
		
		$success=mail($to,$subject,$msg,$header);
		if($success==true){
			echo "Email send successfully ";
		} else{
			echo "Error sending email";
		}
	}
?>
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
	
	<div id="title">Penerimaan Barang</div>
	
	<section class="form-section">
	<form method="post" onsubmit="return verify_input();">
		<br><br><br>
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
				<th>Terima</th>
			</tr>				
			<?php
				$dbservername="localhost";
				$dbusername="root";
				$dbpassword="";
				$database="backoffice";
				$conn = mysqli_connect($dbservername,$dbusername,$dbpassword,$database);
				
				$sql = "SELECT purchasebarang.ID_Pembelian ,barang.ID_Barang, barang.Nama_Barang, supplier.Nama_Supplier, purchasebarang.Kuantitas, purchasebarang.Harga FROM barang INNER JOIN purchasebarang ON barang.ID_Barang = purchasebarang.ID_Barang INNER JOIN supplier ON purchasebarang.ID_Supplier = supplier.ID_Supplier WHERE purchasebarang.Status_Penerimaan = 0;";
				$result = $conn->query($sql);
				
				while ($row = $result->fetch_assoc()) {
					echo "<tr>";
					echo "<td align='center'>B" . $row["ID_Barang"] . "</td>";
					echo "<td>" . $row["Nama_Barang"] . "</td>";
					echo "<td align='center'>" . number_format($row["Kuantitas"], 0, ',', '.') . " gr</td>";
					echo "<td>" . $row["Nama_Supplier"] . "</td>";
					echo "<td>" . 'Rp ' . number_format($row["Harga"], 2, ',', '.') . "</td>";
					echo "<td align='center'><input type='checkbox' name='purchase[]' value='" . $row["ID_Pembelian"] . "'></td>";
					echo "</tr>";
				};
			?>
			<!-- 
			<tr>
				<td align="center">B212</td>
				<td>Gula Pasir</td>
				<td align="center">1000gr</td>
				<td>Indofood</td>
				<td>100.000</td>
				<td align="center"><input type="checkbox"></td>
			</tr>
			-->
		</table>
		<div style="float: right;">
		<input type="submit" name="add" value="Konfirmasi Penerimaan" class="buttonconfirm">
		<br><br>
	</form>
	</section>
	<div class="footer">
		Copyright © 2017 Dancing Crab Indonesia
	</div>

	
</body>
</html>
