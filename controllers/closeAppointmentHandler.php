<?php
require("../utility/validationHandler.php");
require("../utility/queryHandler.php");
session_start();
date_default_timezone_set("Asia/Colombo");

if(isset($_SESSION["username"])) {
    $appointmentID = $_GET['appointmentID'];
    //
    // Execute query
    //
    try {
        $updateQuery = "UPDATE appointment SET appointmentStatus = 'close' WHERE appointmentID = '$appointmentID';";
        if(!handleUpdateQuery($updateQuery)) {
            header("Location: ../views/appointment.php?error=Unable to close appointment");
            die();
        }
        header("Location: ../views/appointment.php");
    }
    catch(Exception) {
        header("Location: ../views/appointment.php?&error=Unable to close appointment");
        die();
    }
}

