<?php
require("../utility/validationHandler.php");
require("../utility/queryHandler.php");
session_start();
date_default_timezone_set("Asia/Colombo");

if(isset($_SESSION["username"])) {
    $recId = $_GET["ID"];

    try {
        if(isset($_POST["yesButton"])) {
            $deleteOccupancy = "DELETE FROM roomoccupancy WHERE occupancyID = '$recId';";

            if(handleDeleteQuery($deleteOccupancy)) {
                header("Location: ../views/patientRoomOccupancy.php");
                die();
            }
            header("Location: ../views/patientRoomOccupancy.php?error=Unable to delete record");
        }
        else if(isset($_POST["noButton"])) {
            header("Location: ../views/patientRoomOccupancy.php");
            die();
        }
    }
    catch(Exception) {
        header("Location: ../views/patientRoomOccupancy.php?error=Unable to delete record");
        die();
    }
}

