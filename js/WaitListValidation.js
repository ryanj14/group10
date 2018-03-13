// This function runs all the validation functions and
// returns true if the user input pass the tests
function validateForm() {

    if (validateFName() == false) {
        return false;
    }
    else if(validateLName() == false){
        return false;
    }
    else if(validateEmailEmpty() == false){
        return false;
    }
    else if(validateBusiness() == false){
        return false;
    }
    else if(validatePhoneNum() == false){
        return false;
    }
    else if(validateAddress() == false){
        return false;
    }else{
        if(ValidateEmail(document.waitForm.email) == false)
        {
            yV.focus();
            return false;
        } else {
            return true;
        }
    }
}

// Checks to see if the first name is empty.
// Returns false if it's empty; Else true
function validateFName(){
    var fName = document.forms["waitForm"]["firstName"];
    var fNameValue = document.forms["waitForm"]["firstName"].value;

    if(fNameValue == ""){
        alert("First name must be filled out");
        fName.focus();
        return false;
    }
    return true;
}

// Checks to see if the last name is empty.
// Returns false if it's empty; Else true
function validateLName(){
    var lName = document.forms["waitForm"]["lastName"];
    var lNameValue = document.forms["waitForm"]["lastName"].value;

    if(lNameValue == ""){
        alert("Last name must be filled out");
        lName.focus();
        return false;
    }
    return true;
}

// This checks to see if the email is empty.
// Returns false if it's empty; Else true
function validateEmailEmpty(){
    var email = document.forms["waitForm"]["email"];
    var emailValue = document.forms["waitForm"]["email"].value;

    if(emailValue == ""){
        alert("email must be filled out");
        email.focus();
        return false;
    }
    return true;
}

// This checks to see if the business name is empty.
// Returns false if it's empty; Else true
function validateBusiness(){
    var busi = document.forms["waitForm"]["business"];
    var busiValue = document.forms["waitForm"]["business"].value;

    if(busiValue == ""){
        alert("business name must be filled out");
        busi.focus();
        return false;
    }
    return true; 
}

// This checks to see if the phone number is empty.
// Returns false if it's empty; Else true
function validatePhoneNum(){
    var phoneNum = document.forms["waitForm"]["phoneNumber"];
    var phoneNumValue = document.forms["waitForm"]["phoneNumber"].value;

    if(phoneNumValue == ""){
        alert("Phone number must be filled out");
        phoneNum.focus();
        return false;
    }
    return true; 
}

// This checks to see if the address is empty.
// Return flase if it's empty; Else true
function validateAddress(){
    var address = document.forms["waitForm"]["address"];
    var addressValue = document.forms["waitForm"]["address"].value;

    if(addressValue == ""){
        alert("Address must be filled out");
        address.focus();
        return false;
    }
    return true; 
}

// This checks to see if the email is an actual email
// address. Returns false if it doesn't pass; Else true
function ValidateEmail(mail) {
    var mailformat = /^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/;
    if(mail.value.match(mailformat)){
        return true;
    } else {
        alert("You have entered an invalid email address!");
        return false;
    }
}