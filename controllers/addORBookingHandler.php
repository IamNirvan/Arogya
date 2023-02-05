<?php
require("../utility/validationHandler.php");
require("../utility/queryHandler.php");
session_start();
date_default_timezone_set("Asia/Colombo");

if(isset($_SESSION["username"])) {
    $doctorID = $_SESSION["ID"];
    $date = $_GET["date"];
    $startTime = strtotime($_GET["startTime"]);
    $endTime = strtotime($_GET["endTime"]);
    $patientID = $_POST["patientIDs"];
    $operatingRoomID = $_POST["operatingRoomIDs"];
    $currentDate = date('Y-m-d');
    $currentTime = time();
    //
    // Validate input
    //
    if($date < $currentDate) {
        header("Location: ../views/addORBooking.php?invalidDateError=Invalid date");
        die();
    }
    if($date == $currentDate){
      if($startTime < $currentTime) {
          header("Location: ../views/addORBooking.php?invalidStartTimeError=Invalid start time");
          die();
      }
    }
    if($endTime <= $startTime) {
        header("Location: ../views/addORBooking.php?invalidDurationError=Invalid end date");
        die();
    }

    try {
        $startTime = $_GET["startTime"];
        $endTime = $_GET["endTime"];
        $insertORBookingQuery = "INSERT INTO operatingroomschedule VALUES 
                                (NULL, '$date', '$startTime', '$endTime', '$patientID', 
                                 '$doctorID', '$operatingRoomID');";

        if(handleInsertQuery($insertORBookingQuery)) {
            header("Location: ../views/ORSchedule.php");
            die();
        }
        else {
            header("Location: ../views/addORBooking.php?error=Error when making booking");
            die();
        }
    }
    catch(Exception) {
        header("Location: ../views/addORBooking.php?error=Error when making booking");
    }
}

