<?php
require("../utility/validationHandler.php");
require("../utility/queryHandler.php");
session_start();
date_default_timezone_set("Asia/Colombo");

if(isset($_SESSION["username"])) {
    $recId = $_GET["ID"];

    try {
        if(isset($_POST["yesButton"])) {
            $deleteOccupancy = "DELETE FROM roomoccupancy WHERE roomoccupancyID = '$recId';";

            if(!handleDeleteQuery($deleteOccupancy)) {
                header("Location: ../views/patientRoomOccupancy.php?error=Error when deleting details");
                die();
            }
            header("Location: ../views/patientRoomOccupancy.php");
        }
        else if(isset($_POST["noButton"])) {
            header("Location: ../views/patientRoomOccupancy.php");
            die();
        }
    }
    catch(Exception) {
        header("Location: ../views/patientRoomOccupancy.php?deleteError=Unable to delete record");
        die();
    }

}

