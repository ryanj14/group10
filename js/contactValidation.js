function validateForm() {
    var flag = true;
    if(validateName() == false) {
      flag = false;
    }

    if(validateEmail() == false) {
      flag = false;
    }

    if(validateTextArea() == false) {
      flag = false;
    }

    if(flag == true) {
        return true;
    } else {
        return false;
    }
}

function validateName() {
    var name = document.forms["contactForm"]["name"].value
    if (name == "") {
      document.getElementById("nameWarning").style.visibility = 'visible'
      return false;
    } else {
      document.getElementById("nameWarning").style.visibility = 'hidden'
    }
    return true;
}

function validateEmail() {
    var emailPattern = /^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/
    var email = document.forms["contactForm"]["email"].value

    if (!(email.match(emailPattern))) {
      document.getElementById("emailWarning").style.visibility = 'visible'
      return false;
    } else {
      document.getElementById("emailWarning").style.visibility = 'hidden'
      return true;
    }
}

function validateTextArea() {
    var text = document.forms["contactForm"]["inquiry"].value
    if(text == "") {
      document.getElementById("textWarning").style.visibility = 'visible'
      return false;
    } else {
      document.getElementById("textWarning").style.visibility = 'hidden'
    }
    return true;
}