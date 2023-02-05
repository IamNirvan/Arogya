<?php
require("../utility/validationHandler.php");
require("../utility/queryHandler.php");
session_start();
date_default_timezone_set("Asia/Colombo");

if(isset($_SESSION["username"])) {
    $occupancyID = $_GET["ID"];
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
    if($startDate == $currentDate){
      if($startTime < $currentTime) {
          header("Location: ../views/updatePatientRoomOccupancy.php?invalidStartTimeError=Invalid start time");
          die();
      }
    }

    if($endDate < $startDate) {
        header("Location: ../views/updatePatientRoomOccupancy.php?invalidEndDateError=Invalid end date");
        die();
    }

    if($endTime <= $startTime) {
        header("Location: ../views/updatePatientRoomOccupancy.php?invalidDurationError=Invalid end time");
        die();
    }

    try {
        $startTime = $_GET["startTime"];
        $endTime = $_GET["endTime"];
        $updateRoomOccupancyQuery = "UPDATE roomoccupancy SET 
                                        startDate = '$startDate', 
                                        startTime = '$startTime', 
                                        endDate = '$endDate', 
                                        endTime = '$endTime', 
                                        roomID = '$roomID', 
                                        patientID = '$patientID' 
                                        WHERE occupancyID = '$occupancyID';";

        if(handleUpdateQuery($updateRoomOccupancyQuery)) {
            header("Location: ../views/patientRoomOccupancy.php");
            die();
        }
        else {
            header("Location: ../views/patientRoomOccupancy.php?error=Error when making booking");
            die();
        }
    }
    catch(Exception) {
        header("Location: ../views/patientRoomOccupancy.php?error=Error when making booking");
    }
}

