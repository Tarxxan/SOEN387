

let passwordpattern = /(?=.*\\d)(?=.*[a-z])(?=.*[A-Z]).{8,}/;
let postalcodepattern=/^[A-Z][1-9][a-zA-Z]\s[1-9][A-Z][1-9]$/g;
let namespattern=/[a-zA-Z\s]+(\.)? [a-zA-Z]+/g;
let phonepattern=/[0-9]{3}\s[0-9]{2}-[0-9]{3}/

function validateneformForm() {

    let name = document.forms ["neform"] ["nename"].value.trim();
    let lastname = document.forms ["neform"] ["nelastname"].value.trim();
    let streetnumber = document.forms ["neform"] ["neestreetnumber"].value.trim();
    let streetname = document.forms ["neform"] ["nestreetname"].value.trim();
    let city = document.forms ["neform"] ["necity"].value.trim();
    let province = document.forms ["neform"] ["neprovince"].value.trim();
    let postalcode = document.forms ["neform"] ["nepostalcode"].value.trim();
    let email = document.forms ["neform"] ["neemail"].value.trim();
    let phone = document.forms ["neform"] ["nephone"].value.trim();
    let dateofbirth = document.forms ["neform"] ["nedateofbirth"].value.trim();
    let password = document.forms ["neform"] ["nepassword"].value.trim();
    let confirmpassword = document.forms ["neform"] ["neconfirmpassword"].value.trim();



    if (name === "") {
        alert("Name must be filled out");
        return false;
    }
    if (lastname === "") {
        alert("Name must be filled out");
        return false;
    }


if( streetnumber === "") {
    alert("street number must be filled out");
    return false;
}
if( streetname === "") {
alert ("street name must be filled out")
return false;
}
if( city === "") {
alert ("city must be filled out");
return false;
}
if( province === "") {
alert ("province must be filled out");
return false;
}
if( postalcode === "") {
alert ("postal code must be filled out");
return false;
}
if( email === "") {
alert ("email must be filled out");
return false;
}
if( phone === "") {
alert ("phone number must be filled out");
return false;
}
if( dateofbirth === "") {
alert ("date of birth must be filled out");
return false;
}
if( password === "") {
alert ("password must be filled out");
return false;
}
if( confirmpassword === "") {
alert ("password confirmation must be filled out");
return false;
}
   if (password === "") {
        alert("Psw must be filled out");
        return false;
    }

   let match= password.match(passwordpattern);
    if (!match) {
    alert("Invalid Password combination try again");
    return false;
    }
    if(!confirmpassword===password){
        alert("Password confirmation does not match the password chosen try again");
        return false;
    }

    if (email.validity.typeMismatch){
        alert("This is not an email address try again");
        return false;
    }


    if (phone.validity.typeMismatch){
        alert("This is not an phone number try again");
        return false;
    }

 if(lastname.match(namespattern)  ){
alert( "    try again ");
 return false;
 }
 if(!streetnumber.match( /^\d+$/) ){
alert( "    try again ");
 return false;
 }
 if(!streetname.match( namespattern)   ){
alert( "    try again ");
 return false;
 }
 if(!city.match( namespattern )){
alert( "    try again ");
 return false;
 }
 if(province.match( namespattern   )){
alert( "    try again ");
 return false;
 }
 if(postalcode.match(postalcodepattern )){
alert( "    try again ");
 return false;
 }

 if(phone.match(  phonepattern )){
alert( "    try again ");
 return false;
 }
 if(dateofbirth.validity.typeMismatch  ){
alert( "    try again ");
 return false;
 }


}