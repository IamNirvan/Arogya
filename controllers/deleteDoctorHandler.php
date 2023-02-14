<?php
require("../utility/validationHandler.php");
require("../utility/queryHandler.php");
session_start();
date_default_timezone_set("Asia/Colombo");

if(isset($_SESSION["username"])) {
    $recId = $_GET["ID"];

    try {
        if(isset($_POST["yesButton"])) {
            $deleteDoctor = "DELETE FROM employee WHERE employeeID = '$recId';";

            if(handleDeleteQuery($deleteDoctor)) {
                header("Location: ../views/manageDoctor.php");
                die();
            }
            header("Location: ../views/manageDoctor.php?error=Error when deleting details");
        }
        else if(isset($_POST["noButton"])) {
            header("Location: ../views/manageDoctor.php");
            die();
        }
    }
    catch(Exception) {
        header("Location: ../views/manageDoctor.php?error=Unable to delete record");
        die();
    }
}