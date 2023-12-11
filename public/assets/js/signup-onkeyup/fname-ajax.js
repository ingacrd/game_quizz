// const URL = window.location.origin;
// const AJAX_URL = URL + "/DW3/numbers_game_project/src/signup-onkeyup/";

// this will be applied for both the first and last name
function validate_fName() {
    let fName = document.getElementById('fName').value;
    let feebackMessage = document.getElementById('fName-feedback');

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

    let queryParam = "?fName=" + fName;
    console.log(AJAX_URL + "fname-ajax.php" + queryParam)
    xmlhttp.open("GET", AJAX_URL + "fname-ajax.php" + queryParam, true);
    xmlhttp.send();
}