function verify_input(){
	var checkboxes = document.querySelectorAll('input[type="checkbox"]');
	var checkedOne = Array.prototype.slice.call(checkboxes).some(x => x.checked);
	if (!checkedOne) {
		alert('Terima minimum 1 (satu) barang.');
	} else {
		return confirm('Apakah masukan penerimaan sudah benar?');
	}
	return false;
}
