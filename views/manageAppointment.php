<?php
$pageTitle = "Manage appointment";

require('partials/header.php');
require('partials/navigation.php');
require('../utility/table.php');
require('../utility/searchPanel.php');
require('../utility/informationPanel.php');

if(isset($_SESSION["username"])) {
    $appointmentID = $_GET["ID"];

    if(isset($_GET["error"])) {
        echo '<script>alert("'.$_GET["error"].'")</script>';
    }
?>
<main class="app-main">
    <div class="heading">
        <h3>Manage Appointment</h3>
        <form action="../controllers/closeAppointmentHandler.php?appointmentID=<?php echo $appointmentID?>" method="post">
            <button type="submit">Close</button>
        </form>
    </div>
    <?php
        //
        // Table
        //
        $_SESSION["appointmentID"] = $appointmentID;
        echo '<div id="tableContainerLarge">';
        $query1 = "SELECT * FROM usedresources WHERE appointmentID = '$appointmentID';";
        $columnNames1 = ["ID", "Resource ID", "Quantity"];
        $attributes1 = ["usedResourceID", "resourceID", "quantity"];
        addTable(columnNames: $columnNames1, attributes: $attributes1, query:$query1, title:"Used Resources", size:"largeBox",
            addItemPage: "addUsedResource.php?ID=$appointmentID", deleteLink: "deleteUsedResource.php", updateLink: "updateUsedResource.php");
        echo '</div>';
    ?>
</main>
<?php
}
else {
    header("Location: login.php");
}
?><?php
