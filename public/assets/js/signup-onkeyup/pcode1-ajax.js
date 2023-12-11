function validate_pcode1() {
    let fName = document.getElementById('pcode1').value;
    let feebackMessage = document.getElementById('pcode1-feedback');

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

    let queryParam = "?pcode1=" + fName;
    console.log(AJAX_URL + "pcode1-ajax.php" + queryParam)
    xmlhttp.open("GET", AJAX_URL + "pcode1-ajax.php" + queryParam, true);
    xmlhttp.send();
}