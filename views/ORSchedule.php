<?php
$pageTitle = "Operating room schedule";
require('partials/header.php'); 
require('partials/navigation.php');
require('../utility/table.php');

if(isset($_SESSION["username"])) {
?>

<main class="app-main">

<?php
    if($_SESSION["accountType"] == "receptionist") {
        echo '<div id="tableContainer">';
        $query1 = "SELECT * FROM operatingroomschedule;";
        $columnNames1 = ["Date", "Start time", "End time", "Operating room ID"];
        $attributes1 = ["bookedDate", "startTime", "endTime", "operatingRoomID"];
        addTable(columnNames: $columnNames1, attributes: $attributes1, query:$query1, title:"Operating Room Bookings", size:"extraLargeBox");
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