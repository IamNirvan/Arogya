<?php
$pageTitle = "Patients";
require('partials/header.php'); 
require('partials/navigation.php');
require('../utility/table.php');
require('../utility/searchPanel.php');
require('../utility/informationPanel.php');

if(isset($_SESSION["username"])) {
    if(isset($_GET["searchButton"])) {
        $option = $_GET['searchOption'];
        $term = $_GET['searchBar'];
        $tableDataQuery = "SELECT 
                            patient.patientID, 
                            patient.firstName, 
                            patient.lastName, 
                            patient.patientNIC 
                            FROM roomoccupancy 
                            INNER JOIN patient 
                            ON roomoccupancy.patientID = patient.patientID WHERE $option = '$term';";
    }
    else {
        $tableDataQuery = "SELECT 
                            patient.patientID, 
                            patient.firstName, 
                            patient.lastName, 
                            patient.patientNIC 
                            FROM roomoccupancy 
                            INNER JOIN patient ON roomoccupancy.patientID = patient.patientID;";
    }
    if(isset($_GET["ID"])) {
        $recId = $_GET["ID"];
        $informationPanelQuery = "SELECT 
                            patient.patientID AS 'Patient ID', 
                            patient.firstName AS 'First name', 
                            patient.lastName AS 'Last name',
                            patient.patientNIC AS 'Patient NIC',
                            patient.gender AS 'Gender',
                            patient.contactNumber AS 'Contact',
                            patient.nationality AS 'Nationality',
                            patient.address AS 'Address'
                            FROM roomoccupancy 
                            INNER JOIN patient ON roomoccupancy.patientID = patient.patientID 
                            WHERE patient.patientID = '$recId';";
    }
    else {
        $informationPanelQuery = "SELECT 
                            patient.patientID AS 'Patient ID', 
                            patient.firstName AS 'First name', 
                            patient.lastName AS 'Last name', 
                            patient.patientNIC AS 'Patient NIC',
                            patient.gender AS 'Gender',
                            patient.contactNumber AS 'Contact',
                            patient.nationality AS 'Nationality',
                            patient.address AS 'Address'
                            FROM roomoccupancy 
                            INNER JOIN patient ON roomoccupancy.patientID = patient.patientID;";
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
            "Patient ID" => "patient.patientID",
            "First name" => "patient.firstName",
            "last name" => "patient.lastName",
            "NIC" => "patient.patientNIC"
        ];
        echo '<form id="searchPanelForm" method="GET" action="'.$_SERVER["PHP_SELF"].'" autocomplete="off">';
        addSearchBar($options);
        echo '</form>';
        //
        // Table
        //
        echo '<div id="tableContainer">';
        $columnNames1 = ["ID", "First name", "Last name", "NIC"];
        $attributes1 = ["patientID", "firstName", "lastName", "patientNIC"];
        addTable(columnNames: $columnNames1, attributes: $attributes1, query:$tableDataQuery, title:"Admitted patients",
            size:"extraLargeBox", viewLink: $_SERVER['PHP_SELF']);
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