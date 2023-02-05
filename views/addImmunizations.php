<?php
$pageTitle = "Add immunization";
require('partials/header.php');
require('partials/navigation.php');

if(isset($_SESSION["username"])) {
    $patientID = $_SESSION["ID"];
?>
    <main class="app-main">
        <div class="heading">
            <h3>Add Immunization</h3>
        </div>
        <div class="container">
            <form action="../controllers/addImmunizationHandler.php" method="POST" autocomplete="off">
                <div id="mainSection">
                    <div class="formSection">
                        <label class="inputLabel" for="immunizationNameTextBox">Name</label>
                        <br>
                        <input type="text" id="immunizationNameTextBox" name="immunizationName" required>
                        <br>
                        <label class="errorMessage" for="immunizationNameTextBox"><?php
                            if(isset($_GET["immunizationNameError"])) {
                                echo $_GET["immunizationNameError"];
                            }
                            ?></label>
                    </div>

                    <div class="formSection">
                        <label class="inputLabel" for="appointmentSelect">Appointment</label>
                        <br>
                        <select id="appointmentSelect" name="appointmentIDs">
                            <?php
                            // Show appointment IDs for other immunizations,
                            // but not for examinations and surgeries
                            // Prevents the user from selecting an appointment that was used
                            // for a surgery or examination
                            //
                            $query = "SELECT 
                                appointment.appointmentID,
                                appointment.bookedDate
                                FROM appointment WHERE appointment.appointmentID NOT IN
                                (SELECT surgeries.appointmentID FROM surgeries) 
                                AND appointment.appointmentID NOT IN 
                                (SELECT examinations.appointmentID FROM examinations) 
                                AND appointment.patientID = '$patientID';";
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
