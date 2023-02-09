<?php
/*
 * An invoice will be provided for each appointment.
 * When generating an invoice, the patientID will be used to
 *      determine if the patient has a room or an OR booking. The roomID will be obtained if so.
 *      Then the duration of the booking will be calculated.
 *      Using the roomID, the daily cost of the room can be obtained.
 *
 * The doctor can also manage the resources that were used for each appointment.
 * This can include: operating utensils, machines, drugs, etc.
 * The cost of each resource will be multiples with the quantity to obtain
 *      the total cost of that resource.
 * This will be included in the invoice.
 *
 *
 *
 * Using the appointment ID, the patientID and any rooms that have the
 * appointment ID in their schedules will be obtained.
 * Also, any resources that were used will be specified in the appointment table using a foreign key
 * */


/*
 * Make an entity called invoice.
 * Link it with appointment wherein the invoice ID is a foreign key in appointment
 *
 * If the invoice ID is not null, allow the user to view the invoice
 * */

require("../utility/validationHandler.php");
require("../utility/queryHandler.php");
session_start();
date_default_timezone_set("Asia/Colombo");

if(isset($_SESSION["username"])) {
    //
    // Get input
    //




}




