<?php
$pageTitle = "Add examination";
require('partials/header.php');
require('partials/navigation.php');

if(isset($_SESSION["username"])) {
    $patientID = $_SESSION["ID"];
?>
<main class="app-main">
    <div class="heading">
        <h3>Add Examination</h3>
    </div>
    <div class="container">
        <form action="../controllers/addExaminationHandler.php" method="POST" autocomplete="off">
            <div id="mainSection">
                <div class="formSection">
                    <label class="inputLabel" for="examNameTextBox">Name</label>
                    <br>
                    <input type="text" id="examNameTextBox" name="examName" required>
                    <br>
                    <label class="errorMessage" for="examNameTextBox"><?php
                        if(isset($_GET["examNameError"])) {
                            echo $_GET["examNameError"];
                        }
                        ?></label>
                </div>
                <div class="formSection">
                    <label class="inputLabel" for="examOutcomeTextBox">Outcome</label>
                    <br>
                    <input type="text" id="examOutcomeTextBox" name="examOutcome" required>
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
                    <select id="appointmentSelect" name="appointmentIDs">
                        <?php
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
