

function AsyncRequest() {
    try {
        var request = new XMLHttpRequest();
    }
    catch (e1) {
        try {
            request = new ActiveXObject("Msxml2.XMLHTTP");
        }
        catch (e2) {
            try {
                request = new ActiveXObject("Microsoft.XMLHTTP");
            }
            catch (e3) {
                alert("Your browser does not support AJAX!");
                request = false;
            }
        }
    }
    return request;
}