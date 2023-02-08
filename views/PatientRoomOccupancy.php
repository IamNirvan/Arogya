<?php
$pageTitle = "Patient room occupancy";
require('partials/header.php'); 
require('partials/navigation.php');
require('../utility/table.php');
require('../utility/searchPanel.php');
require('../utility/informationPanel.php');

if(isset($_SESSION["username"])) {
    if(isset($_GET["searchButton"])) {
        $option = $_GET['searchOption'];
        $term = $_GET['searchBar'];
        $tableDataQuery = "SELECT * FROM roomoccupancy WHERE $option = '$term';";
    }
    else {
        $tableDataQuery = "SELECT * FROM roomoccupancy;";
    }
    if(isset($_GET["ID"])) {
        $recId = $_GET["ID"];
        $informationPanelQuery = "SELECT 
                                    occupancyID AS 'Occupancy ID', 
                                    startDate AS 'Start date', 
                                    endDate AS 'End date', 
                                    startTime AS 'Start time',
                                    endTime AS 'End time',
                                    roomID AS 'Room ID',
                                    patientID AS 'Patient ID',
                                    occupancyStatus AS 'Occupancy status'
                                    FROM roomoccupancy WHERE occupancyID = '$recId'; ";
    }
    else {
        $informationPanelQuery = "SELECT 
                                    occupancyID AS 'Occupancy ID', 
                                    startDate AS 'Start date', 
                                    endDate AS 'End date', 
                                    startTime AS 'Start time',
                                    endTime AS 'End time',
                                    roomID AS 'Room ID',
                                    patientID AS 'Patient ID',
                                    occupancyStatus AS 'Occupancy status'
                                    FROM roomoccupancy;";
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
            "Occupancy ID" => "occupancyID",
            "Start date" => "startDate",
            "End date" => "endDate",
            "Room ID" => "roomID",
            "Patient ID" => "patientID",
            "Status" => "occupancyStatus"
        ];
        echo '<form id="searchPanelForm" method="GET" action="'.$_SERVER["PHP_SELF"].'" autocomplete="off">';
        addSearchBar($options);
        echo '</form>';
        //
        // Table
        //
        echo '<div id="tableContainer">';
        $columnNames1 = ["ID", "Start date", "End date", "Start time", "End time", "Room ID", "Patient ID", "Status"];
        $attributes1 = ["occupancyID", "startDate", "endDate", "startTime", "endTime", "roomID", "patientID", "occupancyStatus"];
        addTable(columnNames: $columnNames1, attributes: $attributes1, query:$tableDataQuery, title:"Patient Room Bookings",
            size:"largeBox", viewLink: $_SERVER['PHP_SELF'], addItemPage: "addPatientRoomOccupancy.php",
            updateLink: "updatePatientRoomOccupancy.php", deleteLink: "deletePatientRoomOccupancy.php");
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
            "Occupancy ID" => "occupancyID",
            "Start date" => "startDate",
            "End date" => "endDate",
            "Room ID" => "roomID",
            "Patient ID" => "patientID",
            "Status" => "occupancyStatus"
        ];
        echo '<form id="searchPanelForm" method="GET" action="'.$_SERVER["PHP_SELF"].'" autocomplete="off">';
        addSearchBar($options);
        echo '</form>';
        //
        // Table
        //
        echo '<div id="tableContainer">';
        $columnNames1 = ["ID", "Start date", "End date", "Start time", "End time", "Room ID", "Patient ID", "Status"];
        $attributes1 = ["occupancyID", "startDate", "endDate", "startTime", "endTime", "roomID", "patientID", "occupancyStatus"];
        addTable(columnNames: $columnNames1, attributes: $attributes1, query:$tableDataQuery, title:"Patient Room Bookings",
            size:"largeBox", addItemPage: "addPatientRoomOccupancy.php", deleteLink: "deleteRoomOccupancy.php",
            updateLink: "updatePatientRoomOccupancy.php", viewLink: $_SERVER['PHP_SELF']);
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