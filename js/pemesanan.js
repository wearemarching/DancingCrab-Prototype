function isNumber(n) {
  return !isNaN(parseInt(n,10)) && isFinite(n);
}

function verify_input(){
	var barang = document.getElementById("barang").value;
	var kuantitas = document.getElementById("kuantitas").value;
	var supplier = document.getElementById("supplier").value;
	
	if(barang == '') {
		alert("Pilih barang yang ingin ditambahkan.");
	} else if (!isNumber(kuantitas) || kuantitas <= 0) {
		alert("Kuantitas tidak valid!");
	} else if (supplier == '') {
		alert('Pilih supplier untuk barang yang akan ditambahkan.');
	} else {
		return true;
	}
	return false;
}
