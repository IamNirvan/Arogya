<?php
require("../utility/validationHandler.php");
require("../utility/queryHandler.php");
session_start();
date_default_timezone_set("Asia/Colombo");

if(isset($_SESSION["username"])) {
    //
    // Get input
    //
    $appointmentID = $_GET["appointmentID"];
    $usedResourceID = $_GET["ID"];
    $oldResource = $_GET["oldResource"];
    $resourceID = $_POST["resourceIDs"];
    $quantity = stripData($_POST["quantity"]);
    //
    // Validate the input
    //
    if(!checkNumbers($quantity)) {
        header("location: ../views/updateUsedResource.php?ID=$appointmentID&quantityError=Invalid quantity");
        die();
    }
    //
    // Execute query
    //
    try {
        $updateQuery = "UPDATE usedresources SET resourceID = '$resourceID', quantity = '$quantity' 
                     WHERE usedResourceID = '$usedResourceID';";
        if(!handleUpdateQuery($updateQuery)) {
            header("Location: ../views/manageAppointment.php?ID=$appointmentID&error=Unable to update resource");
            die();
        }
        header("Location: ../views/manageAppointment.php?ID=$appointmentID");
    }
    catch(Exception) {
        header("Location: ../views/manageAppointment.php?ID=$appointmentID&error=Unable to update resource");
        die();
    }
}

