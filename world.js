
function onclickSubmit(event) {


    do {
        let queryObj = document.getElementById("country");
        /*if (!queryObj.validity.valid) {
            alert("Please enter a valid Avenger Name or Alias");
            break;
        }*/
        let inputString = queryObj.value;
        inputString = encodeURIComponent(inputString.trim());
        let queryRequest = new Request('world.php?country=' + inputString);
        let result = document.getElementById("result");

        fetch(queryRequest)
                .then(response => {
                    if (!response.ok) {
                        throw new Error(`HTTP error! status: ${response.status}`);
                    }
                    return response.text();
                })
                .then(responseText => {
                    result.innerHTML = responseText;
                })
                .catch((error) => {
                    result.innerHTML = "<h4 class=\"queryerror\">"+'Error:' + error.message+"</h4>";
                });
    } while (false);
    event.stopPropagation();
    event.preventDefault();
}

window.onload = function () {
    let elementBtn = document.getElementById("lookup");
    elementBtn.addEventListener("click", onclickSubmit);
}