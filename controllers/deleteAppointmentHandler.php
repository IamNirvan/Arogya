<?php
require("../utility/validationHandler.php");
require("../utility/queryHandler.php");
session_start();
date_default_timezone_set("Asia/Colombo");

if(isset($_SESSION["username"])) {
    $recId = $_GET["ID"];

    try {
        if(isset($_POST["yesButton"])) {
            $query = "DELETE FROM appointment WHERE appointmentID = '$recId';";

            if(handleDeleteQuery($query)) {
                header("Location: ../views/appointment.php");
                die();
            }
            header("Location: ../views/appointment.php?error=Unable to delete record");
        }
        else if(isset($_POST["noButton"])) {
            header("Location: ../views/appointment.php");
            die();
        }
    }
    catch(Exception) {
        header("Location: ../views/appointment.php?error=Unable to delete record");
        die();
    }

}

