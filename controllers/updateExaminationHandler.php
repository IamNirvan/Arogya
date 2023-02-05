<?php
require("../utility/validationHandler.php");
require("../utility/queryHandler.php");
session_start();
date_default_timezone_set("Asia/Colombo");

if(isset($_SESSION["username"])) {
    $examID = $_GET["ID"];
    $patientID = $_SESSION["ID"];
    $oldName = $_GET["examName"];
    $examName = stripData($_POST["examName"]);
    $outcome = stripData($_POST["examOutcome"]);
    $appointmentID = $_POST["appointmentIDs"];
    $currentDate = date("Y-m-d");

    if(!checkAlphabetChars($examName)) {
        header("location: ../views/addExamination.php?examNameError=Invalid name");
        die();
    }
    if(!checkAnyChars($outcome)) {
        header("location: ../views/addExamination.php?examOutcomeError=Invalid input");
        die();
    }
    $dateSelectQuery = "SELECT bookedDate from appointment WHERE appointmentID = '$appointmentID';";
    $dateRecord = handleSelectQuery($dateSelectQuery);

    if($dateRecord) {
        $bookedDate = mysqli_fetch_assoc($dateRecord)["bookedDate"];
        $updateQuery = "UPDATE examinations SET 
                                name = '$examName',
                                examinationDate = '$bookedDate',
                                outcome = '$outcome',
                                patientID = '$patientID',
                                appointmentID = '$appointmentID'
                                WHERE examinationID = '$examID';";
        if(handleUpdateQuery($updateQuery)) {
            header("Location: ../views/medicalHistory.php");
        }
        else {
            echo "Failure!";
        }
    }
}

