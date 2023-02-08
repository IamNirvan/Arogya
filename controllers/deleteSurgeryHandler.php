<?php
require("../utility/validationHandler.php");
require("../utility/queryHandler.php");
session_start();
date_default_timezone_set("Asia/Colombo");

if(isset($_SESSION["username"])) {
    $recId = $_GET["ID"];

    try {
        if(isset($_POST["yesButton"])) {
            $query = "DELETE FROM surgeries WHERE surgeryID = '$recId';";
            if(handleDeleteQuery($query)) {
                header("Location: ../views/medicalHistory.php");
                die();
            }
            else {
                echo "Failure!";
            }
        }
        else if(isset($_POST["noButton"])) {
            header("Location: ../views/medicalHistory.php");
            die();
        }
    }
    catch(Exception) {
        header("Location: ../views/medicalHistory.php?error=Unable to delete record");
        die();
    }

}

