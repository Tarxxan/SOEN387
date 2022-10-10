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


function myFunction() {
    var ns = document.getElementById("nspassword");
    var nsc = document.getElementById("nsconfirm-password")
    var ne = document.getElementById("nepassword");
    var nec = document.getElementById("neconfirm-password")

    if (ns.type === "password") {
        ns.type = "text";
    } else {
        ns.type = "password";
    }
    if (nsc.type === "password") {
        nsc.type = "text";
    } else {
        nsc.type = "password";
    }
    if (ne.type === "password") {
        ne.type = "text";
    } else {
        ne.type = "password";
    }
    if (nec.type === "password") {
        nec.type = "text";
    } else {
        nec.type = "password";
    }
}