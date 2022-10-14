
function validatencformForm() {
let courseCode = document.forms["ncform"]["courseCode"].value;
let courseTitle = document.forms["ncform"]["courseTitle"].value;
let semester = document.forms["ncform"]["semester"].value;
let days = document.forms["ncform"]["days"].value;
let time = document.forms["ncform"]["time"].value;
let startDate = document.forms["ncform"]["startDate"].value;
let endDate = document.forms["ncform"]["endDate"].value;
let instructor = document.forms["ncform"]["instructor"].value;
let room = document.forms["ncform"]["room"].value;


if(courseCode === "") {
alert(" Course code cannot be blank, try again");
return false;
}
if(courseTitle === "") {
alert("cannot be blank, try again");
return false;
}
if(semester === "") {
alert("cannot be blank, try again");
return false;
}
if(days === "") {
alert(" cannot be blank, try again");
return false;
}
if(time === "") {
alert(" cannot be blank, try again");
return false;
}
if(startDate === "") {
alert(" cannot be blank, try again");
return false;
}
if(endDate === "") {
alert(" cannot be blank, try again");
return false;
}
if(instructor === "") {
alert(" cannot be blank, try again");
return false;
}
if(room  === "") {alert("cannot be blank, try again");
return false;
}

}