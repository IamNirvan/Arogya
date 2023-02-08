<?php
require("../utility/validationHandler.php");
require("../utility/queryHandler.php");
session_start();
date_default_timezone_set("Asia/Colombo");

if(isset($_SESSION["username"])) {
    $recId = $_GET["ID"];

    try {
        if(isset($_POST["yesButton"])) {
            $deleteDoctor = "DELETE FROM operatingroomschedule WHERE operatingRoomScheduleID = '$recId';";

            if(handleDeleteQuery($deleteDoctor)) {
                header("Location: ../views/ORSchedule.php");
                die();
            }
            header("Location: ../views/ORSchedule.php?error=Unable to delete record");
        }
        else if(isset($_POST["noButton"])) {
            header("Location: ../views/ORSchedule.php");
            die();
        }
    }
    catch(Exception) {
        header("Location: ../views/ORSchedule.php?error=Unable to delete record");
        die();
    }
}

