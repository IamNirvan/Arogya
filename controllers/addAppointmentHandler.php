<?php
require("../utility/validationHandler.php");
require("../utility/queryHandler.php");
session_start();
date_default_timezone_set("Asia/Colombo");

if(isset($_SESSION["username"])) {
    $date = stripData($_POST["date"]);
    $startTime = strtotime(stripData($_POST["startTime"]));
    $endTime = strtotime(stripData($_POST["endTime"]));
    $reason = stripData($_POST["reason"]);
    $patientID = $_SESSION["ID"];

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
        // If the booked date and current date match, then make sure the
        // booking time is valid
        //
        if($startTime > $currentTime) {
            $validStartTime = true;
        }
        else {
            header("Location: ../views/addAppointment.php?invalidStartTimeError=Invalid start time");
            die();
        }
    }
    else {
        header("Location: ../views/addAppointment.php?invalidDateError=Invalid date");
        die();
    }
    //
    // Validate the duration
    //
    if($endTime > $startTime) {
        $validDuration = true;
    }
    else {
        header("Location: ../views/addAppointment.php?invalidDurationError=End Time must be greater than the start time");
        die();
    }

    $startTime =stripData($_POST["startTime"]);
    $endTime = stripData($_POST["endTime"]);
    $query = "INSERT INTO appointment VALUES (NULL, '$date', '$startTime', '$endTime', '$reason', '$patientID', '$doctorID', 'open');";
    if(handleInsertQuery($query)) {
        header("Location: ../views/appointment.php");
    }
    else {
        echo "Failure!";
    }
}

