<?php
$pageTitle = "Patient room occupancy";

require('partials/header.php'); 
require('partials/navigation.php');
require('../utility/table.php');

if(isset($_SESSION["username"])) {
?>

<main class="app-main">

<?php
    if($_SESSION["accountType"] == "receptionist") {
        echo '<div id="tableContainer">';
        $query1 = "SELECT * FROM roomoccupancy;";
        $columnNames1 = ["ID", "Start date", "End date", "Start time", "End time", "Room ID", "Patient ID", "Status"];
        $attributes1 = ["occupancyID", "startDate", "endDate", "startTime", "endTime", "roomID", "patientID", "occupancyStatus"];
        addTable(columnNames: $columnNames1, attributes: $attributes1, query:$query1, title:"Patient Room Bookings", size:"extraLargeBox");
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