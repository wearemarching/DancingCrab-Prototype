function verify_input(){
	var checkboxes = document.querySelectorAll('input[type="checkbox"]');
	var checkedOne = Array.prototype.slice.call(checkboxes).some(x => x.checked);
	if (!checkedOne) {
		alert('Lakukan pembayaran terhadap minimum 1 (satu) barang.');
	} else {
		confirm('Apakah masukan pembayaran sudah benar?');
	}
	return false;
}
