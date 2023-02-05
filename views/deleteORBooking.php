<?php
$pageTitle = "Delete doctor";
require('partials/header.php');
require('partials/navigation.php');
require('../utility/table.php');
require('../utility/searchPanel.php');

if(isset($_SESSION["username"])) {
    $recId = $_GET["ID"];
?>
    <main class="app-main">
        <div class="container">
            <div class="heading">
                <h3>Delete Operating Booking [<?php echo $recId?>]?</h3>
            </div>
            <!-- This allows the record ID to be passed into the delete control handler.-->
            <form action="../controllers/deleteORBookingHandler.php?ID=<?php echo $recId?>" method="POST"
                  autocomplete="off">
                <div class="deleteOptions">
                    <button id="yesButton" name="yesButton" type="submit">Yes</button>
                    <button id="noButton" name="noButton" type="submit">No</button>
                </div>
            </form>
        </div>
    </main>
<?php
}
else {
    header("Location: login.php");
}
?>
