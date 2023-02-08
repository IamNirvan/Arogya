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
                            FROM patient WHERE $option = '$term';";
    }
    else {
        $tableDataQuery = "SELECT 
                            patient.patientID, 
                            patient.firstName, 
                            patient.lastName, 
                            patient.patientNIC 
                            FROM patient;";
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
                            FROM patient
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
                            FROM patient;";
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
            size:"largeBox", viewLink: $_SERVER['PHP_SELF']);
        echo '</div>';
    }
    else if($_SESSION["accountType"] == "doctor") {
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
        addTable(columnNames: $columnNames1, attributes: $attributes1, query:$tableDataQuery, title:"Patients",
            size:"largeBox", viewLink: $_SERVER['PHP_SELF']);

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
                            FROM patient
                            WHERE patient.patientID = '$recId';";

            $query1 = "SELECT * FROM allergies WHERE patientID = '$recId';";
            $columnNames1 = ["ID", "Allergy"];
            $attributes1 = ["allergyID", "name"];
            addTable(columnNames: $columnNames1, attributes: $attributes1, query:$query1, title:"Allergies", size:"smallBox");

            $query2 = "SELECT * FROM examinations WHERE patientID = '$recId';";
            $columnNames2 = ["ID", "Name", "Date", "Outcome", "Appointment"];
            $attributes2 = ["examinationID", "name", "examinationDate", "outcome","appointmentID"];
            addTable(columnNames: $columnNames2, attributes: $attributes2, query:$query2, title:"Examinations", size:"smallBox");

            $query3 = "SELECT * FROM immunizations WHERE patientID = '$recId';";
            $columnNames3 = ["ID", "Name", "Date", "Appointment"];
            $attributes3 = ["immunizationID", "name", "immunizationDate", "appointmentID"];
            addTable(columnNames: $columnNames3, attributes: $attributes3, query:$query3, title:"Immunizations", size:"smallBox");

            $query4 = "SELECT * FROM surgeries WHERE patientID = '$recId';";
            $columnNames4 = ["ID", "Name", "Date", "Appointment", "Outcome"];
            $attributes4 = ["surgeryID", "name", "surgeryDate", "appointmentID", "outcome"];
            addTable(columnNames: $columnNames4, attributes: $attributes4, query:$query4, title:"Surgeries", size:"smallBox");
        }
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