<?php
$pageTitle = "Home";

require('partials/header.php'); 

if(isset($_SESSION["username"])) {

require('partials/navigation.php');
require('../utility/table.php');
require('../utility/card.php');
?>

<main class="app-main">

<?php
$currentDate = date("Y-m-d");

if($_SESSION["accountType"] == "receptionist") {
    echo '<div class="cardContainer">';
        // To get the number of avaiable patient rooms
        $data1 = handleSelectQuery("SELECT COUNT(roomoccupancy.roomID) AS roomID FROM roomoccupancy INNER JOIN room WHERE roomoccupancy.roomID != room.roomID;");

        if($data1 != false) {
            $data1Fetched = mysqli_fetch_assoc($data1);
            addCard("Available patient rooms", $data1Fetched["roomID"], "images/icons/bed-black.png");
        }
        else {
            addCard("Available patient rooms", "Failed to load data", "images/icons/bed-black.png");
        }

        // To get the number of today's appointments.
        $data2 = handleSelectQuery("SELECT COUNT(appointmentID) AS appointmentID FROM appointment WHERE appointmentStatus = 'open' AND bookedDate = '$currentDate'");

        if($data2 != false) {
            $data2Fetched = mysqli_fetch_assoc($data2);
            addCard("Today's appointments", $data2Fetched["appointmentID"], "images/icons/appointment-black.png");
        }
        else {
            addCard("Today's appointments", "Unable to load data", "images/icons/appointment-black.png");
        }
        
        // To get the number avaiable ORs.
        $data3 = handleSelectQuery("SELECT COUNT(operatingroomschedule.operatingRoomID) AS roomID FROM operatingroomschedule INNER JOIN operatingroom WHERE operatingroomschedule.operatingRoomID != operatingroom.operatingRoomID;");

        if($data3 != false) {
            $data3Fetched = mysqli_fetch_assoc($data3);
            addCard("Available Operating Rooms", $data3Fetched["roomID"], "images/icons/OR-black.png");
        }
        else {
            addCard("Available Operating Rooms", "Unable to load data", "images/icons/OR-black.png");
        }
    echo '</div>';

    echo '<div id="tableContainer">';
    // To get all the open appointments for the day
    $query1 = "SELECT appointmentID, startTime, endTime, patientID, employeeID FROM appointment WHERE appointmentStatus = 'open' AND bookedDate = '$currentDate'";
    $columnNames1 = ["ID", "Start", "End", "Patient ID", "Employee ID"];
    $attributes1 = ["appointmentID", "startTime", "endTime", "patientID", "employeeID"];
    addTable(columnNames: $columnNames1, attributes: $attributes1, query:$query1, title:"Today's Appointments", size:"smallBox", openLink:"appointment.php");

    // To get the room occupancy list
    $query2 = "SELECT roomID, startDate, endDate, startTime, endTime, patientID FROM roomoccupancy WHERE occupancyStatus = 'active'";
    $columnNames2 = ["ID", "Start date", "End date", "Start time", "End time", "Patient ID"];
    $attributes2 = ["roomID", "startDate", "endDate", "startTime", "endTime", "patientID"];
    addTable(columnNames: $columnNames2, attributes: $attributes2, query:$query2, title:"Room Occupancy", size:"smallBox", openLink:"PatientRoomOccupancy.php");
    
    // To get the list of admitted patients
    $query3 = "SELECT roomoccupancy.occupancyID, roomoccupancy.startDate, roomoccupancy.endDate, patient.firstName, patient.lastName FROM roomoccupancy INNER JOIN patient ON roomoccupancy.patientID = patient.patientID;";
    $columnNames3 = ["ID", "Start date", "End date", "First name", "Last name"];
    $attributes3 = ["occupancyID", "startDate", "endDate", "firstName", "lastName"];
    addTable(columnNames: $columnNames3, attributes: $attributes3, query:$query3, title:"Admitted Patients", size:"largeBox", openLink:"patients.php");
    echo '</div>';
}
else if($_SESSION["accountType"] == "patient") {
    echo '<div id="tableContainer">';
    $query1 = "SELECT appointmentID, startTime, endTime, patientID, employeeID FROM appointment WHERE appointmentStatus = 'open';";
    $columnNames1 = ["ID", "Start", "End", "Patient ID", "Employee ID"];
    $attributes1 = ["appointmentID", "startTime", "endTime", "patientID", "employeeID"];
    addTable(columnNames: $columnNames1, attributes: $attributes1, query:$query1, title:"Open Appointments", size:"largeBox", openLink:"appointment.php");

    $query2 = "SELECT appointmentID, startTime, endTime, patientID, employeeID FROM appointment WHERE appointmentStatus = 'closed';";
    $columnNames2 = ["ID", "Start", "End", "Patient ID", "Employee ID"];
    $attributes2 = ["appointmentID", "startTime", "endTime", "patientID", "employeeID"];
    addTable(columnNames: $columnNames2, attributes: $attributes2, query:$query2, title:"Closed Appointments", size:"largeBox", openLink:"appointment.php");
    echo '</div>';
}




?>


</main>


<?php
}
else {
    header("Location: login.php");
}
?>