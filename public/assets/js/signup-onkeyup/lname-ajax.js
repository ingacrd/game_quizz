function validate_lName() {
    let fName = document.getElementById('lName').value;
    let feebackMessage = document.getElementById('lName-feedback');

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

    let queryParam = "?lName=" + fName;
    console.log(AJAX_URL + "lname-ajax.php" + queryParam)
    xmlhttp.open("GET", AJAX_URL + "lname-ajax.php" + queryParam, true);
    xmlhttp.send();
}