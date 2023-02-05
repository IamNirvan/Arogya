<?php
require("../utility/validationHandler.php");
require("../utility/queryHandler.php");
session_start();
date_default_timezone_set("Asia/Colombo");

if(isset($_SESSION["username"])) {
    $recId = $_GET["ID"];

    try {
        if(isset($_POST["yesButton"])) {
            $deleteReceptionist = "DELETE FROM employee WHERE employeeID = '$recId';";

            if(!handleDeleteQuery($deleteReceptionist)) {
                header("Location: ../views/manageReceptionist.php?error=Error when deleting details");
                die();
            }
            header("Location: ../views/manageReceptionist.php");
        }
        else if(isset($_POST["noButton"])) {
            header("Location: ../views/manageReceptionist.php");
            die();
        }
    }
    catch(Exception) {
        header("Location: ../views/manageReceptionist.php?deleteError=Unable to delete record");
        die();
    }

}

