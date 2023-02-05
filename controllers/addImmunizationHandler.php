<?php
require("../utility/validationHandler.php");
require("../utility/queryHandler.php");
session_start();
date_default_timezone_set("Asia/Colombo");

if(isset($_SESSION["username"])) {
    $patientID = $_SESSION["ID"];
    $immunizationName = stripData($_POST["immunizationName"]);
    $appointmentID = $_POST["appointmentIDs"];

    if(!checkAnyChars($immunizationName)) {
        header("location: ../views/addImmunizations.php?immunizationNameError=Invalid name");
        die();
    }
    //
    // Checks to see if the immunization entry has the same name and the same appointment ID.
    // This is essentially a duplicate. Therefore, it will not be allowed
    //
    $selectQuery = "SELECT * 
                        FROM immunizations 
                        WHERE lower(name) = lower('$immunizationName') 
                        AND appointmentID = '$appointmentID' 
                        AND patientID = '$patientID'";
    $records = handleSelectQuery($selectQuery);
    if(!$records) {
        $dateSelectQuery = "SELECT bookedDate from appointment WHERE appointmentID = '$appointmentID';";
        $dateRecord = handleSelectQuery($dateSelectQuery);

        if ($dateRecord) {
            $bookedDate = mysqli_fetch_assoc($dateRecord)["bookedDate"];
            $insertQuery = "INSERT INTO immunizations
                                VALUES (NULL, '$immunizationName', '$bookedDate', '$patientID', '$appointmentID');";
            if (handleInsertQuery($insertQuery)) {
                header("Location: ../views/medicalHistory.php");
            } else {
                echo "Failure!";
            }
        }
    }
    else {
        header("location: ../views/addImmunizations.php?immunizationNameError=Entry already exists");
        die();
    }
}

