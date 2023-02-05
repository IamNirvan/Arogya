<?php
require("../utility/validationHandler.php");
require("../utility/queryHandler.php");
session_start();
date_default_timezone_set("Asia/Colombo");

if(isset($_SESSION["username"])) {
    $doctorID = $_SESSION["ID"];
    $startDate = $_GET["startDate"];
    $endDate = $_GET["endDate"];
    $startTime = strtotime($_GET["startTime"]);
    $endTime = strtotime($_GET["endTime"]);
    $patientID = $_POST["patientIDs"];
    $roomID = $_POST["roomIDs"];
    $currentDate = date('Y-m-d');
    $currentTime = time();
    //
    // Validate input
    //
    if($startDate < $currentDate) {
        header("Location: ../views/addPatientRoomOccupancy.php?invalidStartDateError=Invalid start date");
        die();
    }
    if($startDate == $currentDate){
      if($startTime < $currentTime) {
          header("Location: ../views/addPatientRoomOccupancy.php?invalidStartTimeError=Invalid start time");
          die();
      }
    }

    if($endDate < $startDate) {
        header("Location: ../views/addPatientRoomOccupancy.php?invalidEndDateError=Invalid end date");
        die();
    }

    if($endTime <= $startTime) {
        header("Location: ../views/addPatientRoomOccupancy.php?invalidDurationError=Invalid end time");
        die();
    }

    try {
        $startTime = $_GET["startTime"];
        $endTime = $_GET["endTime"];
        $insertRoomOccupancyQuery = "INSERT INTO roomoccupancy VALUES
                                (NULL, '$startDate', '$startTime', '$endDate', '$endTime', '$roomID', '$patientID',
                                 'active');";

        if(handleInsertQuery($insertRoomOccupancyQuery)) {
            header("Location: ../views/patientRoomOccupancy.php");
            die();
        }
        else {
            header("Location: ../views/addPatientRoomOccupancy.php?error=Error when making booking");
            die();
        }
    }
    catch(Exception) {
        header("Location: ../views/addPatientRoomOccupancy.php?error=Error when making booking");
    }
}

