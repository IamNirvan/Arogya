<?php
session_start();
require("../utility/validationHandler.php");
require("../utility/queryHandler.php");

// Get the data from the form
$username = $_POST["username"];
$password = $_POST["password"];
$firstName = stripData($_POST["firstName"]);
$middleName = stripData($_POST["middleName"]);
$lastName = stripData($_POST["lastName"]);
$contactNumber = stripData($_POST["contactNumber"]);
$gender = stripData($_POST["genderOption"]);
//$specialization = stripData($_POST["specialization"]);


if(checkAlphabetChars($username)) {
    if(!validateUsername($username, "SELECT username from employeeaccount WHERE lower(username) = lower('$username')")) {
        header("Location: ../views/addReceptionist.php?usernameError=Username is taken");
        die();
    }
} else {
    header("Location: ../views/addReceptionist.php?usernameError=Invalid input");
    die();
}

if(!validatePassword($password)) {
    header("Location: ../views/addReceptionist.php?passwordError=Password is weak");
    die();
}

if(!checkAlphabetChars($firstName)) {
    header("Location: ../views/addReceptionist.php?firstNameError=Invalid input");
    die();
}

//if(!checkAlphabetChars($middleName)) {
//    header("Location: ../views/addReceptionist.php?middleNameError=Invalid input");
//    die();
//}

if(!checkAlphabetChars($lastName)) {
    header("Location: ../views/addReceptionist.php?lastNameError=Invalid input");
    die();
}

if(!validateContactNumber($contactNumber, "SELECT contactNumber from employee WHERE contactNumber = '$contactNumber'")) {
    header("Location: ../views/addReceptionist.php?contactNumberError=Invalid contact number");
    die();
}
//
//if(!checkAlphabetChars($specialization)) {
//    header("Location: ../views/addReceptionist.php?specializationError=Invalid input");
//    die();
//}

//try {
    $registerEmployeeQuery = "INSERT INTO employee VALUES(NULL, '$firstName', '$middleName', '$lastName', '$contactNumber', '$gender', 'receptionist')";

    if (handleInsertQuery($registerEmployeeQuery)) {
        $getEmployeeIDQuery = "SELECT employeeID FROM employee ORDER BY employeeID DESC LIMIT 1;";
        $records = handleSelectQuery($getEmployeeIDQuery);
        $employeeID = mysqli_fetch_assoc($records)['employeeID'];
        $registerEmployeeAccountQuery = "INSERT INTO employeeaccount VALUES(NULL, '$username', '$password', 'receptionist', '$employeeID')";

        if (handleInsertQuery($registerEmployeeAccountQuery)) {
            header("Location: ../views/manageReceptionist.php");
        }
    }
//}
//catch (Exception) {
//    header("Location: ../views/manageReceptionist.php?error=An error occurred when adding a new doctor");
//}
