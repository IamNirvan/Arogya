<?php
$pageTitle = "Patients";
require('partials/header.php'); 
require('partials/navigation.php');
require('../utility/table.php');

if(isset($_SESSION["username"])) {
?>

<main class="app-main">

<?php
    if($_SESSION["accountType"] == "receptionist") {
        echo '<div id="tableContainer">';
        $query1 = "SELECT patient.patientID, patient.firstName, patient.lastName, patient.patientNIC FROM roomoccupancy INNER JOIN patient ON roomoccupancy.patientID = patient.patientID;";
        $columnNames1 = ["ID", "First name", "Last name", "NIC"];
        $attributes1 = ["patientID", "firstName", "lastName", "patientNIC"];
        addTable(columnNames: $columnNames1, attributes: $attributes1, query:$query1, title:"Admitted patients", size:"extraLargeBox");
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