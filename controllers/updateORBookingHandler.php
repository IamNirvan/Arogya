<?php
require("../utility/validationHandler.php");
require("../utility/queryHandler.php");
session_start();
date_default_timezone_set("Asia/Colombo");

if(isset($_SESSION["username"])) {
    $doctorID = $_SESSION["ID"];
    //
    // Get input
    //
    $ORBookingID = $_GET["ID"];
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
    if($date == $currentDate){
      if($startTime < $currentTime) {
          header("Location: ../views/updateORBooking.php?invalidStartTimeError=Invalid start time");
          die();
      }
    }
    if($endTime <= $startTime) {
        header("Location: ../views/updateORBooking.php?invalidDurationError=Invalid end date");
        die();
    }
    //
    // Execute the query
    //
    try {
        $startTime = $_GET["startTime"];
        $endTime = $_GET["endTime"];
        $updateORBookingQuery = "UPDATE operatingroomschedule SET bookedDate = '$date', 
                                 startTime = '$startTime', endTime = '$endTime', 
                                 patientID = '$patientID',
                                 employeeID = '$doctorID',
                                 operatingRoomID = '$operatingRoomID'
                                 WHERE operatingroomscheduleID = '$ORBookingID';";

        if(!handleUpdateQuery($updateORBookingQuery)) {
            header("Location: ../views/ORSchedule.php?error=Error when updating");
            die();
        }
        header("Location: ../views/ORSchedule.php");
    }
    catch(Exception) {
        header("Location: ../views/ORSchedule.php?error=Error when updating");
        die();
    }
}

