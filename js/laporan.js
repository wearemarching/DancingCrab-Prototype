function verify_input() {
	var tanggalAwal = document.getElementById("tanggalAwal").value;
	var tanggalAkhir = document.getElementById("tanggalAkhir").value;
	if (tanggalAwal == '') {
		alert('Masukkan tanggal awal!');
	} else if (tanggalAkhir == '') {
		alert('Masukkan tanggal akhir!');
	} else {
		var tAwal = Date.parse(tanggalAwal);
		var tAkhir = Date.parse(tanggalAkhir);
		if (tAkhir < tAwal) {
			alert('Tanggal akhir harus lebih besar dari tanggal awal.');
		} else {
			return confirm('Apakah masukkan tanggal sudah benar?');
		}
	}
	return false;
}
