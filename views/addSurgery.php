<?php
$pageTitle = "Add surgery";
require('partials/header.php');
require('partials/navigation.php');

if(isset($_SESSION["username"])) {
    $patientID = $_SESSION["ID"];
?>
    <main class="app-main">
        <div class="container">
            <div class="heading">
                <h3>Add Surgery</h3>
            </div>
            <form action="../controllers/addSurgeryHandler.php" method="POST" autocomplete="off">
                <div id="mainSection">
                    <div class="formSection">
                        <label class="inputLabel" for="surgeryNameTextBox">Name</label>
                        <br>
                        <input type="text" id="surgeryNameTextBox" name="surgeryName" required>
                        <br>
                        <label class="errorMessage" for="surgeryNameTextBox"><?php
                            if(isset($_GET["surgeryNameError"])) {
                                echo $_GET["surgeryNameError"];
                            }
                            ?></label>
                    </div>
                    <div class="formSection">
                        <label class="inputLabel" for="surgeryOutcomeTextBox">Outcome</label>
                        <br>
                        <input type="text" id="surgeryOutcomeTextBox" name="surgeryOutcome" required>
                        <br>
                        <label class="errorMessage" for="surgeryOutcomeTextBox"><?php
                            if(isset($_GET["surgeryOutcomeError"])) {
                                echo $_GET["surgeryOutcomeError"];
                            }
                            ?></label>
                    </div>
                    <div class="formSection">
                        <label class="inputLabel" for="appointmentSelect">Appointment</label>
                        <br>
                        <select id="appointmentSelect" name="appointmentIDs">
                            <?php
                            //
                            // the query makes sure that examinations that have an
                            // appointment ID are not shown
                            //
                            $query = "SELECT 
                                        appointment.appointmentID, 
                                        appointment.bookedDate 
                                        FROM appointment 
                                        WHERE appointment.appointmentID NOT IN 
                                        (SELECT examinations.appointmentID FROM examinations)
                                        AND appointment.appointmentID NOT IN
                                        (SELECT immunizations.appointmentID FROM immunizations)
                                        AND appointment.appointmentID NOT IN  
                                        (SELECT surgeries.appointmentID FROM surgeries)
                                        AND patientID = '$patientID';";
                            $rawData = handleSelectQuery($query);

                            while($fetched = mysqli_fetch_assoc($rawData)) {
                                $appointmentID = $fetched["appointmentID"];
                                $date = $fetched["bookedDate"];
                                echo "<option value=$appointmentID>[$appointmentID] $date</option>";
                            }
                            ?>
                        </select>
                    </div>
                </div>
                <div class="buttonSection">
                    <button type="submit">Add</button>
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
