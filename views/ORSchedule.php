<?php
$pageTitle = "Operating room schedule";
require('partials/header.php');
require('partials/navigation.php');
require('../utility/table.php');
require('../utility/searchPanel.php');
require('../utility/informationPanel.php');

if(isset($_SESSION["username"])) {
    //
    // Determine the initial values to display in the information panel
    //
    if(isset($_GET["ID"])) {
        $recId = $_GET["ID"];
        $informationPanelQuery = "SELECT 
                                    operatingRoomScheduleID AS 'Schedule ID', 
                                    bookedDate AS 'Booked date', 
                                    startTime AS 'Start time',
                                    endTime AS 'end time',
                                    patientID AS 'Patient ID',
                                    operatingroomID AS 'Operating room ID'
                                    FROM operatingroomschedule WHERE operatingRoomScheduleID = '$recId'; ";
    }
    else {
        $informationPanelQuery = "SELECT 
                                    operatingRoomScheduleID AS 'Schedule ID', 
                                    bookedDate AS 'Booked date', 
                                    startTime AS 'Start time',
                                    endTime AS 'end time',
                                    patientID AS 'Patient ID',
                                    operatingroomID AS 'Operating room ID'
                                    FROM operatingroomschedule; ";
    }

    if(isset($_GET["error"])) {
        echo '<script>alert("'.$_GET["error"].'")</script>';
    }
?>

<main class="app-main">
<?php
    if($_SESSION["accountType"] == "receptionist") {
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
            "Schedule ID" => "operatingRoomScheduleID",
            "Date" => "bookedDate",
            "Operating room ID" => "operatingRoomID"
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
            $tableDataQuery = "SELECT * FROM operatingroomschedule WHERE $option = '$term';";
        }
        else {
            $tableDataQuery = "SELECT * FROM operatingroomschedule;";
        }
        $columnNames1 = ["Schedule ID", "Date", "Start time", "End time", "Operating room ID"];
        $attributes1 = ["operatingRoomScheduleID", "bookedDate", "startTime", "endTime", "operatingRoomID"];
        addTable(columnNames: $columnNames1, attributes: $attributes1, query:$tableDataQuery,
            title:"Operating Room Bookings", size:"largeBox", viewLink: $_SERVER['PHP_SELF']);
        echo '</div>';
    }
    else if($_SESSION["accountType"] == "doctor") {
        $doctorID = $_SESSION["ID"];
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
            "Schedule ID" => "operatingRoomScheduleID",
            "Date" => "bookedDate",
            "Operating room ID" => "operatingRoomID"
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
            $tableDataQuery = "SELECT * FROM operatingroomschedule WHERE $option = '$term' AND employeeID = '$doctorID';";
        }
        else {
            $tableDataQuery = "SELECT * FROM operatingroomschedule WHERE employeeID = '$doctorID';";
        }


        $columnNames1 = ["Schedule ID", "Date", "Start time", "End time", "Operating room ID", "Patient ID"];
        $attributes1 = ["operatingRoomScheduleID", "bookedDate", "startTime", "endTime", "operatingRoomID", "patientID"];
        addTable(columnNames: $columnNames1, attributes: $attributes1, query:$tableDataQuery, title:"Operating Room Bookings",
            size:"largeBox", addItemPage: "addORBooking.php?ID=$doctorID", deleteLink: "deleteORBooking.php",
            updateLink: "updateORBooking.php", viewLink: $_SERVER['PHP_SELF']);
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