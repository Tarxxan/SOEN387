function processLogin() {

    let d = new Date;
    let hour = d.getHours();
    let minutes = d.getMinutes();

    window.sessionStorage.setItem("loginTime", hour + ": " + minutes);
    window.sessionStorage.setItem("agent", navigator.userAgent);

}

let processLogout = function () {

    sessionStorage.clear();
};

function comparepasswords() {

    let password = document.getElementById("nepassword");
    let confirmpassword = document.getElementById("neconfirm-password");

    if (password !== confirmpassword) {
        alert("password confirmation must match the password chosen");
    }

}


// Get the iframe
const iframe = document.getElementById('myIframeAdmin');
// Reload the iframe
iframe.contentWindow.location.reload()


document.getElementById("ncsubmit").addEventListener("click", function () {
    alert("Saved!");
});
document.getElementById("nssubmit").addEventListener("click", function () {
    alert("Saved!");
});
document.getElementById("nesubmit").addEventListener("click", function () {
    alert("Saved!");
});
document.getElementById("submit").addEventListener("click", function () {
    alert("Saved!");
});