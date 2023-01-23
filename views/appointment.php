<?php
$pageTitle = "Appointment";

require('partials/header.php'); 
require('partials/navigation.php');
require('../utility/table.php');
require('../utility/searchPanel.php');

if(isset($_SESSION["username"])) {

    if(isset($_GET["searchButton"])) {
        $option = $_GET['searchOption'];
        $term = $_GET['searchBar'];

        $query1 = "SELECT * FROM appointment WHERE $option = '$term';";
    }
    else {
        $query1 = "SELECT * FROM appointment;";
    }

?>

<main class="app-main">

<?php
    if($_SESSION["accountType"] == "receptionist") {
        $options = [
            "Employee ID" => "employeeID", 
            "Patient ID" => "patientID", 
            "Date" => "bookedDate", 
            "Start time" => "startTime"
        ];

        echo '<form id="searchPanelForm" method="GET" action="'.$_SERVER["PHP_SELF"].'" autocomplete="off">';
            addSearchBar($options);
        echo '</form>';

        echo '<div id="tableContainer">';
        $columnNames1 = ["ID", "Date", "Start time", "End time", "Patient ID", "Employee ID", "Status"];
        $attributes1 = ["appointmentID", "bookedDate", "startTime", "endTime", "patientID", "employeeID", "appointmentStatus"];
        addTable(columnNames: $columnNames1, attributes: $attributes1, query:$query1, title:"All Appointments", size:"extraLargeBox");
        echo '</div>';
    }
    else if($_SESSION["accountType"] == "patient") {
        echo '<div id="tableContainer">';
        $query1 = "SELECT * FROM appointment;";
        $columnNames1 = ["ID", "Date", "Start time", "End time", "Status"];
        $attributes1 = ["appointmentID", "bookedDate", "startTime", "endTime", "appointmentStatus"];
        addTable(columnNames: $columnNames1, attributes: $attributes1, query:$query1, title:"All Appointments", size:"extraLargeBox", addLink:"link");
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