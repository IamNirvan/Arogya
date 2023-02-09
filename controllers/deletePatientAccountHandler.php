<?php
require("../utility/validationHandler.php");
require("../utility/queryHandler.php");
session_start();
date_default_timezone_set("Asia/Colombo");

if(isset($_SESSION["username"])) {
    $recId = $_SESSION["ID"];

    try {
        if(isset($_POST["yesButton"])) {
            $deletePatient = "DELETE FROM patient WHERE patientID = '$recId';";

            if(!handleDeleteQuery($deletePatient)) {
                header("Location: ../views/manageAccount.php?error=Error when deleting details");
                die();
            }
            header("Location: ../views/login.php");
        }
        else if(isset($_POST["noButton"])) {
            header("Location: ../views/manageAccount.php");
            die();
        }
    }
    catch(Exception) {
        header("Location: ../views/manageAccount.php?error=Unable to delete record");
        die();
    }
}

