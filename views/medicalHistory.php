<?php
$pageTitle = "Medical History";
require('partials/header.php'); 
require('partials/navigation.php');
require('../utility/table.php');

if(isset($_SESSION["username"])) {
?>

<main class="app-main">

<?php
    if($_SESSION["accountType"] == "patient") {
        echo '<div id="tableContainer">';
        $query1 = "SELECT * FROM allergies;";
        $columnNames1 = ["Name"];
        $attributes1 = ["name"];
        addTable(columnNames: $columnNames1, attributes: $attributes1, query:$query1, title:"Allergies", size:"smallBox", addLink:"link");
        
        $query2 = "SELECT * FROM examinations;";
        $columnNames2 = ["Name", "Date", "Outcome", "Appointment"];
        $attributes2 = ["name", "examinationDate", "outcome","appointmentID"];
        addTable(columnNames: $columnNames2, attributes: $attributes2, query:$query2, title:"Examinations", size:"smallBox", addLink:"link");
        
        $query3 = "SELECT * FROM immunizations;";
        $columnNames3 = ["Name", "Date", "Appointment"];
        $attributes3 = ["name", "immunizationDate", "appointmentID"];
        addTable(columnNames: $columnNames3, attributes: $attributes3, query:$query3, title:"Immunizations", size:"smallBox", addLink:"link");
        
        $query4 = "SELECT * FROM surgeries;";
        $columnNames4 = ["Name", "Date", "Outcome", "Appointment"];
        $attributes4 = ["name", "surgeryDate", "outcome", "appointmentID"];
        addTable(columnNames: $columnNames4, attributes: $attributes4, query:$query4, title:"Surgeries", size:"smallBox", addLink:"link");
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