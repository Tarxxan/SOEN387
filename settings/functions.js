

function processLogin()
{
let d = new Date;
let hour = d.getHours();
let minutes = d.getMinutes();

window.sessionStorage.setItem("loginTime",hour+": "+minutes);
window.sessionStorage.setItem("agent", navigator.userAgent);

// For testing
alert("For testing purposes Login Time: "+window.sessionStorage.getItem("loginTime")+"\nAgent: "+window.sessionStorage.getItem("agent"));


}

var processLogout = function() {

	sessionStorage.clear();
	alert("Session ended");
}



