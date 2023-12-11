function validate_pcode2() {
    let fName = document.getElementById('pcode2').value;
    let feebackMessage = document.getElementById('pcode2-feedback');

    var xmlhttp = new AsyncRequest();
    xmlhttp.onreadystatechange = function () {
        if (this.readyState == 4) {
            if (this.status == 200) {
                if (this.responseText != null) {
                    feebackMessage.innerHTML = this.responseText;
                }
            }
        }
    };

    let queryParam = "?pcode2=" + fName;
    console.log(AJAX_URL + "pcode2-ajax.php" + queryParam)
    xmlhttp.open("GET", AJAX_URL + "pcode2-ajax.php" + queryParam, true);
    xmlhttp.send();
}