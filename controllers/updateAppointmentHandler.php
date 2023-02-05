<?php
require("../utility/validationHandler.php");
require("../utility/queryHandler.php");
session_start();
date_default_timezone_set("Asia/Colombo");

if(isset($_SESSION["username"])) {
    $recId = $_GET["ID"];
    $date = stripData($_POST["date"]);
    $startTime = strtotime(stripData($_POST["startTime"]));
    $endTime = strtotime(stripData($_POST["endTime"]));
    $reason = stripData($_POST["reason"]);
    $appointmentStatus = $_POST["appointmentStatus"];
    $doctorID = $_POST["doctorIDs"];
    $currentDate = date("Y-m-d");
    $currentTime = time();

    $validDate = false;
    $validStartTime = false;
    $validDuration = false;

    if($date > $currentDate) {
        $validDate = true;
    }
    else if($date == $currentDate) {
        $validDate = true;
        //
        // Validate the start time
        //
        if($startTime > $currentTime) {
            $validStartTime = true;
        }
        else {
            header("Location: ../views/updateAppointment.php?ID=$recId&invalidStartTimeError=Invalid start time");
            die();
        }
    }
    //
    // Validate the duration of the appointment
    //
    if($startTime < $endTime) {
        $validDuration = true;
    }
    else {
        header("Location: ../views/updateAppointment.php?ID=$recId&invalidDurationError=End Time must be greater than the start time");
        die();
    }

    $startTime =stripData($_POST["startTime"]);
    $endTime = stripData($_POST["endTime"]);
    $query = "UPDATE appointment SET 
               bookeddate = '$date',
               startTime = '$startTime',
               endTime = '$endTime', 
               description = '$reason', 
               employeeID = '$doctorID', 
               appointmentStatus = '$appointmentStatus' 
               WHERE appointmentID = '$recId';";

    if(handleInsertQuery($query)) {
        header("Location: ../views/appointment.php");
    }
    else {
        echo "Failure!";
    }
}