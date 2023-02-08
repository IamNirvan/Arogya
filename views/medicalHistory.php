<?php
$pageTitle = "Medical History";
require('partials/header.php'); 
require('partials/navigation.php');
require('../utility/table.php');

if(isset($_SESSION["username"])) {
    $patientID = $_SESSION["ID"];

    if(isset($_GET["error"])) {
        echo '<script>alert("'.$_GET["error"].'")</script>';
    }
?>

<main class="app-main">
<?php
    if($_SESSION["accountType"] == "patient") {
        //
        // Table
        //
        echo '<div id="tableContainerLarge">';
        $query1 = "SELECT * FROM allergies WHERE patientID = '$patientID';";
        $columnNames1 = ["ID", "Allergy"];
        $attributes1 = ["allergyID", "name"];
        addTable(columnNames: $columnNames1, attributes: $attributes1, query:$query1, title:"Allergies", size:"smallBox",
            addItemPage: "addAllergy.php", deleteLink: "deleteAllergy.php", updateLink: "updateAllergy.php");
        
        $query2 = "SELECT * FROM examinations WHERE patientID = '$patientID';";
        $columnNames2 = ["ID", "Name", "Date", "Outcome", "Appointment"];
        $attributes2 = ["examinationID", "name", "examinationDate", "outcome","appointmentID"];
        addTable(columnNames: $columnNames2, attributes: $attributes2, query:$query2, title:"Examinations", size:"smallBox",
            addItemPage: "addExamination.php", deleteLink: "deleteExamination.php", updateLink: "updateExamination.php");
        
        $query3 = "SELECT * FROM immunizations WHERE patientID = '$patientID';";
        $columnNames3 = ["ID", "Name", "Date", "Appointment"];
        $attributes3 = ["immunizationID", "name", "immunizationDate", "appointmentID"];
        addTable(columnNames: $columnNames3, attributes: $attributes3, query:$query3, title:"Immunizations", size:"smallBox",
            addItemPage: "addImmunizations.php", deleteLink: "deleteImmunization.php", updateLink: "updateImmunization.php");
        
        $query4 = "SELECT * FROM surgeries WHERE patientID = '$patientID';";
        $columnNames4 = ["ID", "Name", "Date", "Appointment", "Outcome"];
        $attributes4 = ["surgeryID", "name", "surgeryDate", "appointmentID", "outcome"];
        addTable(columnNames: $columnNames4, attributes: $attributes4, query:$query4, title:"Surgeries", size:"smallBox",
            addItemPage: "addSurgery.php", deleteLink: "deleteSurgery.php", updateLink: "updateSurgery.php");
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