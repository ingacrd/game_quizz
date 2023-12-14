const URL = window.location.origin;//
//require_once(__DIR__ . '/../config.php');
const AJAX_URL = URL + "/src/signup-onkeyup/";

function validate_userName() {
    let userName = document.getElementById('userName').value;
    let feebackMessage = document.getElementById('username-feedback');

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

    let queryParam = "?userName=" + userName;
    console.log(AJAX_URL + "uname-ajax.php" + queryParam)
    xmlhttp.open("GET", AJAX_URL + "uname-ajax.php" + queryParam, true);
    xmlhttp.send();
}
