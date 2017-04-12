<?php 
	if ($_POST) {
		$idbarang = $_POST['ID_Barang'];
		if ($idbarang != '') {
			
			$dbservername="localhost";
			$dbusername="root";
			$dbpassword="";
			$database="backoffice";
			$conn = mysqli_connect($dbservername,$dbusername,$dbpassword,$database);
		
			$sql = "SELECT supplier.ID_Supplier, supplier.Nama_Supplier FROM barang INNER JOIN penyediaan ON barang.ID_Barang = penyediaan.ID_Barang INNER JOIN supplier ON penyediaan.ID_Supplier = supplier.ID_Supplier WHERE barang.ID_Barang = " . $idbarang;
			$result = $conn->query($sql);
			
			echo "Supplier: ";
			echo "<select id='supplier' name='supplier' id='dropdown'>";
			echo "<option disabled selected value>-- Pilih Supplier --</option>"; 
			while ($row = $result->fetch_assoc()) {
				echo "<option value='" . $row["ID_Supplier"] . "'>" . $row["Nama_Supplier"] . "</option>";
			}
			echo "</select>";
		}
		else
		{
			echo "Supplier: ";
			echo "<select id='supplier' name='supplier' id='dropdown'>";
			echo "<option disabled selected value>-- Pilih Supplier --</option>"; 
			echo "</select>";
		}
	}
?>
