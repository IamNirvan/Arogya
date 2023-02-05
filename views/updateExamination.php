<?php
$pageTitle = "Update examination";
require('partials/header.php');
require('partials/navigation.php');

if(isset($_SESSION["username"])) {
    $patientID = $_SESSION["ID"];
    $examID = $_GET["ID"];
    $records = handleSelectQuery("SELECT * FROM examinations WHERE examinationID = '$examID';");
    if($records) {
        $globalFetch = mysqli_fetch_assoc($records);
    }
?>
    <main class="app-main">
        <div class="heading">
            <h3>Update Examination</h3>
        </div>
        <div class="container">
            <form action="../controllers/updateExaminationHandler.php?ID=<?php echo $examID;?>&examName=<?php echo $globalFetch['name']?>" method="POST" autocomplete="off">
                <div id="mainSection">
                    <div class="formSection">
                        <label class="inputLabel" for="examNameTextBox">Name</label>
                        <br>
                        <input type="text" id="examNameTextBox" name="examName" value="<?php echo $globalFetch['name']?>" required>
                        <br>
                        <label class="errorMessage" for="examNameTextBox"><?php
                            if(isset($_GET["examNameError"])) {
                                echo $_GET["examNameError"];
                            }
                            ?></label>
                    </div>

<!--                    <div class="formSection">-->
<!--                        <label class="inputLabel" for="datePicker">Date</label>-->
<!--                        <br>-->
<!--                        <input type="date" id="datePicker" name="date" value="--><?php //echo $globalFetch["examinationDate"]?><!--" required>-->
<!--                        <br>-->
<!--                        <label class="errorMessage" for="datePicker">--><?php
//                            if(isset($_GET["invalidDateError"])) {
//                                echo $_GET["invalidDateError"];
//                            }
//                            ?><!--</label>-->
<!--                    </div>-->
                    <div class="formSection">
                        <label class="inputLabel" for="examOutcomeTextBox">Outcome</label>
                        <br>
                        <input type="text" id="examOutcomeTextBox" name="examOutcome" value="<?php echo $globalFetch["outcome"]?>" required>
                        <br>
                        <label class="errorMessage" for="examOutcomeTextBox"><?php
                            if(isset($_GET["examOutcomeError"])) {
                                echo $_GET["examOutcomeError"];
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
                                        (SELECT examinations.appointmentID FROM examinations
                                       WHERE examinations.appointmentID != '$examAppointmentID')
                                        AND appointment.appointmentID NOT IN
                                        (SELECT immunizations.appointmentID FROM immunizations)
                                        AND appointment.appointmentID NOT IN  
                                        (SELECT surgeries.appointmentID FROM surgeries)
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
