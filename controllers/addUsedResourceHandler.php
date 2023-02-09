<?php
require("../utility/validationHandler.php");
require("../utility/queryHandler.php");
session_start();
date_default_timezone_set("Asia/Colombo");

if(isset($_SESSION["username"])) {
    //
    // Get input
    //
    $appointmentID = $_GET["ID"];
    $resourceID = stripData($_POST["resourceIDs"]);
    $quantity = stripData($_POST["quantity"]);
    //
    // Validate input
    //
    if(!checkNumbers($quantity)) {
        header("location: ../views/addUsedResource.php?ID=$appointmentID&quantityError=Invalid quantity");
        die();
    }
    //
    // Execute query
    //
    try {
        $insertQuery = "INSERT INTO usedresources VALUES (NULL, '$appointmentID', '$resourceID', '$quantity');";
        if(!handleInsertQuery($insertQuery)) {
            header("Location: ../views/manageAppointment.php?ID=$appointmentID&error=Unable to add resource");
            die();
        }
        header("Location: ../views/manageAppointment.php?ID=$appointmentID");
    }
    catch(Exception) {
        header("Location: ../views/manageAppointment.php?ID=$appointmentID&error=Unable to add resource");
        die();
    }
}

