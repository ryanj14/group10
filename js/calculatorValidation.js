function validateForm() {
    if(validateRadio() == false){
        return false;
    } else if(validateWorkers() == false) {
        return false;
    } else if(annualBudget() == false) {
        return false;
    } else {
        if(workersHired() == false){
            alert("hire error");
            return false;
        } else if(workerHours() == false){
            alert("hours error");
            return false;
        } else if(validateCrops() == false){
            alert("crops error");
            return false;
        } else{
            return true;
        }
    }
}

function validateRadio(){
    var radios = document.getElementsByName("growingType");
    var formValid = false;
    var i = 0;

    for(var i = 0; i < radios.length;i++){
        if(radios[i].checked == true){
            formValid = true;    
        }
    }

    if (!formValid){  
        alert("Must check a growing type");
        return formValid;
    } 
}

function validateWorkers(){
    var workers = document.getElementsByName("weeding");
    var formValid = false;
    var i = 0;

    for(var i = 0; i < workers.length;i++){
        if(workers[i].checked == true){
            formValid = true;    
        }
    }

    if (!formValid){  
        alert("Must check the hired workers");
        return formValid;
    } 
}

function workersHired(){
    var workers = getRadioWorker();
    var workerHired = document.forms["calculatorForm"]["workers"];
    var workerHiredValue = document.forms["calculatorForm"]["workers"].value;

    if(workers == 'Yes'){   
        if(workerHiredValue == ""){
            alert("Must put in the number of workers");
            workerHired.focus();
            return false;
        }
        var intHired = parseInt(workerHiredValue);
        if(intHired > 0) {
            return true;
        } else {
            alert("Enter a positive number");
            workerHired.focus();
            return false;
        } 
    }
    return true;
}

function workerHours(){
    var workers = getRadioWorker();
    var workerHours = document.forms["calculatorForm"]["weeklyWorkers"];
    var workerHoursValue = document.forms["calculatorForm"]["weeklyWorkers"].value;

    if(workers == 'Yes'){
        if(workerHoursValue == ""){
            alert("Must put in the hours for the workers");
            workerHours.focus();
            return false;
        }
        var intHours = parseInt(workerHoursValue);
        if(intHours > 0) {
            return true;
        } else {
            alert("Enter a positive number");
            workerHours.focus();
            return false;
        } 
    }
    return true;
}

function getRadioWorker(){
    var radios = document.getElementsByName("weeding");
    for (var i = 0; i < radios.length; i++) {
        var someRadio = radios[i];
        if (someRadio.checked) {
            var rdValue = someRadio.value;
            return rdValue;
        }
    }
}

function annualBudget(){
    var budget = document.forms["calculatorForm"]["annualBudget"];
    var budgetValue = document.forms["calculatorForm"]["annualBudget"].value;

    if(budgetValue == ""){
        alert("Enter the annual budget per acre");
        return false;
    }
    var intBudget = parseInt(budgetValue);
    if(intBudget > 0) {
        return true;
    } else {
        alert("Enter a positive number");
        budget.focus();
        return false;
    }
    alert("Something broke to reach this point");
    return false;
}

function validateCrops(){
    if(validateVegtables() == false){
        alert("error");
        return false;
    } else if(validateBerries() == false){
        return false;
    } else if (validateHerbs() == false){
        return false;
    } else if(validateOrchards() == false){
        return false;
    } else if(validateVineyards() == false){
        return false;
    } else if(validateOther() == false){
        return false;
    } else {
        return true;
    }
}

function validateVegtables(){
    var vegtable = document.forms["calculatorForm"]["cultivate"];
    var vegtableValue = document.forms["calculatorForm"]["cultivate"].value;

    if(vegtableValue == ""){
        return true;
    }

    var intVegtable = parseInt(vegtableValue);
    if(intVegtable > 0) {
        return true;
    } else {
        alert("Enter a positive number");
        vegtable.focus();
        return false;
    }
}

function validateBerries(){
    var berries = document.forms["calculatorForm"]["cultivate2"];
    var berriesValue = document.forms["calculatorForm"]["cultivate2"].value;

    if(berriesValue == ""){
        return true;
    }

    var intBerries = parseInt(berriesValue);
    if(intBerries > 0) {
        return true;
    } else {
        alert("Enter a positive number");
        berries.focus();
        return false;
    }
}

function validateHerbs(){
    var herbs = document.forms["calculatorForm"]["cultivate3"];
    var herbsValue = document.forms["calculatorForm"]["cultivate3"].value;

    if(herbsValue == ""){
        return true;
    }

    var intHerbs = parseInt(herbsValue);
    if(intHerbs > 0) {
        return true;
    } else {
        alert("Enter a positive number");
        herbs.focus();
        return false;
    }
}

function validateOrchards(){
    var orchards = document.forms["calculatorForm"]["cultivate4"];
    var orchardsValue = document.forms["calculatorForm"]["cultivate4"].value;

    if(orchardsValue == ""){
        return true;
    }

    var intOrchards = parseInt(orchardsValue);
    if(intOrchards > 0) {
        return true;
    } else {
        alert("Enter a positive number");
        orchards.focus();
        return false;
    }
}

function validateVineyards(){
    var vine = document.forms["calculatorForm"]["cultivate5"];
    var vineValue = document.forms["calculatorForm"]["cultivate5"].value;

    if(vineValue == ""){
        return true;
    }

    var intVine = parseInt(vineValue);
    if(intVine > 0) {
        return true;
    } else {
        alert("Enter a positive number");
        vine.focus();
        return false;
    }
}

function validateOther(){
    var other = document.forms["calculatorForm"]["cultivate6"];
    var otherValue = document.forms["calculatorForm"]["cultivate6"].value;

    if(otherValue == ""){
        return true;
    }

    var intOther = parseInt(otherValue);
    if(intOther > 0) {
        return true;
    } else {
        alert("Enter a positive number");
        other.focus();
        return false;
    }
}