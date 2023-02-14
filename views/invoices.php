<?php
$pageTitle = "Appointments";
require('partials/header.php');
require('partials/navigation.php');
require('../utility/table.php');
require('../utility/searchPanel.php');
require('../utility/informationPanel.php');

if(isset($_SESSION["username"])) {
    $currentDate = date('Y-m-d');

    if(isset($_GET["error"])) {
        echo '<script>alert("'.$_GET["error"].'")</script>';
    }
?>

<main class="app-main">
    <?php
        if($_SESSION["accountType"] == "patient") {
            $patientID = $_SESSION["ID"];
            if(isset($_GET["ID"])) {
                $recId = $_GET["ID"];
                header("location: invoice.php?ID=$recId");
            }
            //
            // Table
            //
            echo '<div id="tableContainer">';
            $tableDataQuery = "SELECT * FROM appointment WHERE patientID = '$patientID' AND appointmentStatus = 'close';";
            $columnNames1 = ["ID", "Date", "Start time", "End time"];
            $attributes1 = ["appointmentID", "bookedDate", "startTime", "endTime"];
            addTable(columnNames: $columnNames1, attributes: $attributes1, query:$tableDataQuery,
                title:"Closed Appointments", size:"extraLargeBox",
                viewLink: $_SERVER['PHP_SELF']);
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