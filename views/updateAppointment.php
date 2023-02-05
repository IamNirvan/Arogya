<?php
$pageTitle = "Update appointment";
require('partials/header.php');
require('partials/navigation.php');
require('../utility/table.php');
require('../utility/searchPanel.php');

if(isset($_SESSION["username"])) {
    $recId = $_GET["ID"];
    $records = handleSelectQuery("SELECT * FROM appointment WHERE appointmentID = '$recId'");

    if($records) {
        $globalFetch = mysqli_fetch_assoc($records);
    }
?>
    <main class="app-main">
        <div class="heading">
            <h3>Update Appointment</h3>
        </div>
        <div class="container">
            <form action="../controllers/updateAppointmentHandler.php?ID=<?php echo $recId;?>" method="POST" autocomplete="off">
                <div id="mainSection">
                    <div class="formSection">
                        <label class="inputLabel" for="datePicker">Date</label>
                        <br>
                        <input type="date" id="datePicker" name="date" value="<?php echo $globalFetch["bookedDate"];?>" required>
                        <br>
                        <label class="errorMessage" for="datePicker"><?php
                            if(isset($_GET["invalidDateError"])) {
                                echo $_GET["invalidDateError"];
                            }
                            ?></label>
                    </div>
                    <div class="formSection">
                        <label class="inputLabel" for="startTimePicker">Start time</label>
                        <br>
                        <input type="time" id="startTimePicker" name="startTime" value="<?php echo $globalFetch["startTime"];?>" required>
                        <br>
                        <label class="errorMessage" for="startTimePicker"><?php
                            if(isset($_GET["invalidStartTimeError"])) {
                                echo $_GET["invalidStartTimeError"];
                            }
                            ?></label>
                    </div>
                    <div class="formSection">
                        <label class="inputLabel" for="endTimePicker">End time</label>
                        <br>
                        <input type="time" id="endTimePicker" name="endTime" value="<?php echo $globalFetch["endTime"];?>" required>
                        <br>
                        <label class="errorMessage" for="endTimePicker"><?php
                            if(isset($_GET["invalidDurationError"])) {
                                echo $_GET["invalidDurationError"];
                            }
                            ?></label>
                    </div>

                    <div class="formSection">
                        <label class="inputLabel" for="usernameTextBox">Doctor ID</label>
                        <br>
                        <select name="doctorIDs" value="<?php echo $globalFetch["employeeID"];?>">
                            <?php
                            $query = "SELECT employeeID, firstName, lastName, specialization from employee WHERE NOT
                         specialization ='administrator' AND NOT specialization ='receptionist';";
                            $rawData = handleSelectQuery($query);

                            while($fetched = mysqli_fetch_assoc($rawData)) {
                                $employeeID = $fetched["employeeID"];
                                $firstName = $fetched["firstName"];
                                $lastName = $fetched["lastName"];
                                $specialization = $fetched["specialization"];

                                if($employeeID == $globalFetch["employeeID"]) {
                                    echo "<option value=$employeeID selected>$employeeID-$firstName  $lastName-$specialization</option>";
                                }
                                else {
                                    echo "<option value=$employeeID>$employeeID-$firstName  $lastName-$specialization</option>";
                                }
                            }
                            ?>
                        </select>
                    </div>
                    <div class="formSection">
                        <label class="inputLabel" for="reasonTextBox">Reason</label>
                        <br>
                        <textarea id="reasonTextBox" name="reason" column=40 row=5 required><?php echo $globalFetch["description"];?></textarea>
                        <br>
                    </div>
                    <div class="radioButtonSection">
                        <label class="inputLabel">Appointment status</label>
                        <div>
                            <label class="inputLabel" for="openRadioBtn">Open</label>
                            <?php
                                if($globalFetch["appointmentStatus"] == "open") {
                                    echo '<input type="radio" value="open" id="openRadioBtn" name="appointmentStatus" checked required>';
                                }
                                else {
                                    echo '<input type="radio" value="open" id="openRadioBtn" name="appointmentStatus" required>';
                                }
                            ?>
                            <label class="inputLabel" for="closeRadioBtn">Closed</label>
                            <?php
                                if($globalFetch["appointmentStatus"] == "close") {
                                    echo '<input type="radio" value="close" id="closeRadioBtn" name="appointmentStatus" checked required>';
                                }
                                else {
                                    echo '<input type="radio" value="close" id="closeRadioBtn" name="appointmentStatus" required>';
                                }
                            ?>
                        </div>
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
