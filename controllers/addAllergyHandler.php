<?php
require("../utility/validationHandler.php");
require("../utility/queryHandler.php");
session_start();
date_default_timezone_set("Asia/Colombo");

if(isset($_SESSION["username"])) {
    $patientID = $_SESSION["ID"];
    $allergyName = stripData($_POST["allergyName"]);

    if(!checkAnyChars($allergyName)) {
        header("location: ../views/addAllergy.php?allergyNameError=Invalid name");
        die();
    }

    $selectQuery = "SELECT * FROM allergies WHERE lower(name) = lower('$allergyName') AND patientID = '$patientID'";
    $records = handleSelectQuery($selectQuery);
    if(!$records) {
        $updateQuery = "INSERT INTO allergies VALUES (NULL, '$allergyName', '$patientID');";
        if(handleInsertQuery($updateQuery)) {
            header("Location: ../views/medicalHistory.php");
        }
        else {
            echo "Failure!";
        }
    }
    else {
        header("location: ../views/addAllergy.php?allergyNameError=Allergy already exists");
        die();
    }
}

