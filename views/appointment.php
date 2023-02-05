<?php
$pageTitle = "Appointments";

require('partials/header.php'); 
require('partials/navigation.php');
require('../utility/table.php');
require('../utility/searchPanel.php');
require('../utility/informationPanel.php');

if(isset($_SESSION["username"])) {
    $currentdate = date('Y-m-d');
?>

<main class="app-main">
<?php
    if($_SESSION["accountType"] == "receptionist") {
        if(isset($_GET["ID"])) {
            $recId = $_GET["ID"];
            $informationPanelQuery = "SELECT
                                        appointmentID as 'Appointment ID',
                                        bookedDate as 'Booked date',
                                        startTime as 'Start time',
                                        endTime as 'End time',
                                        description as 'Reason',
                                        patientID as 'Patient ID',
                                        employeeID as 'Employee ID',
                                        appointmentStatus as 'Status'
                                        FROM appointment WHERE appointmentID = '$recId';";
        }
        else {
            $informationPanelQuery = "SELECT
                                        appointmentID as 'Appointment ID',
                                        bookedDate as 'Booked date', startTime as 'Start time',
                                        endTime as 'End time',
                                        description as 'Reason',
                                        patientID as 'Patient ID',
                                        employeeID as 'Employee ID',
                                        appointmentStatus as 'Status'
                                        FROM appointment WHERE bookedDate >= '$currentdate';";
        }
        //
        // Information panel
        //
        $panelRecords = handleSelectQuery($informationPanelQuery);
        if($panelRecords) {
            $panelFetched = mysqli_fetch_assoc($panelRecords);
            echo '<form id="informationPanelForm" method="POST" action="'.$_SERVER["PHP_SELF"].'">';
            addInformationPanel($panelFetched);
            echo '</form>';
        }
        //
        // Search panel
        //
        $options = [
            "Employee ID" => "employeeID", 
            "Patient ID" => "patientID", 
            "Date" => "bookedDate",
            "Status" => "appointmentStatus"
        ];
        echo '<form id="searchPanelForm" method="GET" action="'.$_SERVER["PHP_SELF"].'" autocomplete="off">';
            addSearchBar($options);
        echo '</form>';
        //
        // Table
        //
        echo '<div id="tableContainer">';
        if(isset($_GET["searchButton"])) {
            $option = $_GET['searchOption'];
            $term = $_GET['searchBar'];
            $tableDataQuery = "SELECT * FROM appointment WHERE $option = '$term';";
        }
        else {
            $tableDataQuery = "SELECT * FROM appointment WHERE bookedDate >= '$currentdate';";
        }
        $columnNames1 = ["ID", "Date", "Start time", "End time", "Patient ID", "Employee ID", "Status"];
        $attributes1 = ["appointmentID", "bookedDate", "startTime", "endTime", "patientID", "employeeID",
            "appointmentStatus"];
        addTable(columnNames: $columnNames1, attributes: $attributes1, query:$tableDataQuery,
            title:"All Appointments", size:"largeBox", viewLink: $_SERVER['PHP_SELF']);
//        addTable(columnNames: $columnNames1, attributes: $attributes1, query:$tableDataQuery,
//            title:"All Appointments", size:"largeBox", addItemPage: "addAppointment.php",
//            updateLink: "updateAppointment.php", deleteLink: "deleteAppointment.php",
//            viewLink: $_SERVER['PHP_SELF']);
        echo '</div>';
    }
    else if($_SESSION["accountType"] == "patient") {
        $patientID = $_SESSION["ID"];
        if(isset($_GET["ID"])) {
            $recId = $_GET["ID"];
            $informationPanelQuery = "SELECT
                                        appointmentID as 'Appointment ID',
                                        bookedDate as 'Booked date',
                                        startTime as 'Start time',
                                        endTime as 'End time',
                                        description as 'Reason',
                                        patientID as 'Patient ID',
                                        employeeID as 'Employee ID',
                                        appointmentStatus as 'Status'
                                        FROM appointment WHERE patientID = '$patientID' AND appointmentID = '$recId';";
        }
        else {
            $informationPanelQuery = "SELECT
                                        appointmentID as 'Appointment ID',
                                        bookedDate as 'Booked date', startTime as 'Start time',
                                        endTime as 'End time',
                                        description as 'Reason',
                                        patientID as 'Patient ID',
                                        employeeID as 'Employee ID',
                                        appointmentStatus as 'Status'
                                        FROM appointment WHERE patientID = '$patientID';";
        }
        //
        // Information panel
        //
        $panelRecords = handleSelectQuery($informationPanelQuery);
        if($panelRecords) {
            $panelFetched = mysqli_fetch_assoc($panelRecords);
            echo '<form id="informationPanelForm" method="POST" action="'.$_SERVER["PHP_SELF"].'">';
            addInformationPanel($panelFetched);
            echo '</form>';
        }
        //
        // Search panel
        //
        $options = [
            "ID" => "appointmentID",
            "Date" => "bookedDate",
            "Status" => "appointmentStatus"
        ];
        echo '<form id="searchPanelForm" method="GET" action="'.$_SERVER["PHP_SELF"].'" autocomplete="off">';
        addSearchBar($options);
        echo '</form>';
        //
        // Table
        //
        echo '<div id="tableContainer">';
        if(isset($_GET["searchButton"])) {
            $option = $_GET['searchOption'];
            $term = $_GET['searchBar'];
            $tableDataQuery = "SELECT * FROM appointment WHERE $option = '$term' AND patientID = '$patientID';";
        }
        else {
            $tableDataQuery = "SELECT * FROM appointment WHERE patientID = '$patientID';";
        }
        $columnNames1 = ["ID", "Date", "Start time", "End time", "Status"];
        $attributes1 = ["appointmentID", "bookedDate", "startTime", "endTime", "appointmentStatus"];
        addTable(columnNames: $columnNames1, attributes: $attributes1, query:$tableDataQuery, title:"All Appointments",
            size:"largeBox", addItemPage:"addAppointment.php", deleteLink: "deleteAppointment.php",
            updateLink: "updateAppointment.php",
            viewLink: $_SERVER['PHP_SELF']);
        echo '</div>';
    }
    else if($_SESSION["accountType"] == "doctor") {
        $doctorID = $_SESSION["ID"];

        if(isset($_GET["ID"])) {
            $recId = $_GET["ID"];
            $informationPanelQuery = "SELECT 
                                    appointmentID as 'Appointment ID', 
                                    bookedDate as 'Booked date', 
                                    startTime as 'Start time', 
                                    endTime as 'End time', 
                                    description as 'Reason', 
                                    patientID as 'Patient ID', 
                                    employeeID as 'Employee ID', 
                                    appointmentStatus as 'Status' 
                                    FROM appointment WHERE appointmentID = '$recId' AND employeeID = '$doctorID' AND bookedDate >= '$currentdate';";
        }
        else {
            $informationPanelQuery = "SELECT 
                                    appointmentID as 'Appointment ID', 
                                    bookedDate as 'Booked date', startTime as 'Start time', 
                                    endTime as 'End time', 
                                    description as 'Reason', 
                                    patientID as 'Patient ID', 
                                    employeeID as 'Employee ID', 
                                    appointmentStatus as 'Status' 
                                    FROM appointment WHERE employeeID = '$doctorID' AND  bookedDate >= '$currentdate';";
        }
        //
        // Information panel
        //
        $panelRecords = handleSelectQuery($informationPanelQuery);
        if($panelRecords) {
            $panelFetched = mysqli_fetch_assoc($panelRecords);
            echo '<form id="informationPanelForm" method="POST" action="'.$_SERVER["PHP_SELF"].'">';
            addInformationPanel($panelFetched);
            echo '</form>';
        }
        //
        // Search panel
        //
        $options = [
            "ID" => "appointmentID",
            "Patient ID" => "patientID",
            "Date" => "bookedDate"
        ];
        echo '<form id="searchPanelForm" method="GET" action="'.$_SERVER["PHP_SELF"].'" autocomplete="off">';
        addSearchBar($options);
        echo '</form>';
        //
        // Table
        //
        echo '<div id="tableContainer">';
        if(isset($_GET["searchButton"])) {
            $option = $_GET['searchOption'];
            $term = $_GET['searchBar'];
            $tableDataQuery = "SELECT * FROM appointment WHERE $option = '$term' AND employeeID = '$doctorID' AND bookedDate >= '$currentdate';";
        }
        else {
            $tableDataQuery = "SELECT * FROM appointment WHERE employeeID = '$doctorID' AND bookedDate >= '$currentdate';";
        }
        $columnNames1 = ["ID", "Date", "Start time", "End time", "Patient ID", "Status"];
        $attributes1 = ["appointmentID", "bookedDate", "startTime", "endTime", "patientID", "appointmentStatus"];
        addTable(columnNames: $columnNames1, attributes: $attributes1, query:$tableDataQuery,
            title:"Today's Appointments", size:"extraLargeBox", viewLink: $_SERVER['PHP_SELF']);
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