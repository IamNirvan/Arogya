<?php
$pageTitle = "Update immunization";
require('partials/header.php');
require('partials/navigation.php');

if(isset($_SESSION["username"])) {
    $patientID = $_SESSION["ID"];
    $immunizationID = $_GET["ID"];
    $records = handleSelectQuery("SELECT * FROM immunizations WHERE immunizationID = '$immunizationID';");
    $globalFetch = null;

    if($records) {
        $globalFetch = mysqli_fetch_assoc($records);
    }
?>
    <main class="app-main">
        <div class="heading">
            <h3>Update Immunization</h3>
        </div>
        <div class="container">
            <form action="../controllers/updateImmunizationHandler.php?ID=<?php echo $immunizationID;?>
                &immunizationName=<?php echo $globalFetch['name']?>
                &appointmentID=<?php echo $globalFetch['appointmentID'];?>"
                method="POST" autocomplete="off">
                <div id="mainSection">
                    <div class="formSection">
                        <label class="inputLabel" for="immunizationNameTextBox">Name</label>
                        <br>
                        <input type="text" id="immunizationNameTextBox" name="immunizationName" value="<?php
                            echo $globalFetch['name']
                        ?>" required>
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
                        <select id="appointmentSelect" name="appointmentIDs" required>
                            <?php
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
