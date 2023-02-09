<?php
require("../utility/validationHandler.php");
require("../utility/queryHandler.php");
session_start();
date_default_timezone_set("Asia/Colombo");

if(isset($_SESSION["username"])) {
    $usedResourceId = $_GET["ID"];
    $appointmentID = $_SESSION["appointmentID"];

    try {
        if(isset($_POST["yesButton"])) {
            $query = "DELETE FROM usedresources WHERE usedResourceID = '$usedResourceId';";

            if(handleDeleteQuery($query)) {
                header("Location: ../views/manageAppointment.php?ID=$appointmentID");
                die();
            }
            header("Location: ../views/manageAppointment.php?ID=$appointmentID&error=Unable to delete record");
        }
        else if(isset($_POST["noButton"])) {
            header("Location: ../views/manageAppointment.php?ID=$appointmentID");
            die();
        }
    }
    catch(Exception) {
        header("Location: ../views/manageAppointment.php?ID=$appointmentID&error=Unable to delete record");
        die();
    }
}

