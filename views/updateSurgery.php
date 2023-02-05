<?php
$pageTitle = "Update surgery";
require('partials/header.php');
require('partials/navigation.php');

if(isset($_SESSION["username"])) {
    $patientID = $_SESSION["ID"];
    $surgeryID = $_GET["ID"];
    $records = handleSelectQuery("SELECT * FROM surgeries WHERE surgeryID = '$surgeryID';");
    if($records) {
        $globalFetch = mysqli_fetch_assoc($records);
    }
?>
    <main class="app-main">
        <div class="heading">
            <h3>Update Surgery</h3>
        </div>
        <div class="container">
            <form action="../controllers/updateSurgeryHandler.php?ID=<?php echo $surgeryID;?>" method="POST" autocomplete="off">
                <div id="mainSection">
                    <div class="formSection">
                        <label class="inputLabel" for="surgeryNameTextBox">Name</label>
                        <br>
                        <input type="text" id="surgeryNameTextBox" name="surgeryName" value="<?php echo $globalFetch['name']?>" required>
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
                        <input type="text" id="surgeryOutcomeTextBox" name="surgeryOutcome" value="<?php echo $globalFetch["outcome"]?>" required>
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
                        <select id="appointmentSelect" name="appointmentIDs" required>
                            <?php
                            $examAppointmentID = $globalFetch["appointmentID"];
                            //
                            // the query makes sure that examinations that have an
                            // appointment ID are for surgeries, immunizations and
                            // other examinations are not shown except for the
                            // appointment ID of the examination being updated
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
                                        (SELECT surgeries.appointmentID FROM surgeries
                                        WHERE surgeries.appointmentID != '$examAppointmentID')
                                        AND patientID = '$patientID';";
                            $rawData = handleSelectQuery($query);

                            while($fetched = mysqli_fetch_assoc($rawData)) {
                                $appointmentID = $fetched["appointmentID"];
                                $date = $fetched["bookedDate"];

                                if($globalFetch["appointmentID"] == $appointmentID) {
                                    echo "<option value=$appointmentID selected>[$appointmentID] $date</option>";
                                }
                                else {
                                    echo "<option value=$appointmentID>[$appointmentID] $date</option>";
                                }
                            }
                            ?>
                        </select>
                    </div>
                </div>
                <div class="buttonSection">
                    <button type="submit">Update</button>
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
