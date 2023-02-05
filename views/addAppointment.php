<?php
$pageTitle = "Add appointment";
require('partials/header.php');
require('partials/navigation.php');

if(isset($_SESSION["username"])) {
    $currentDate = date('Y-m-d');
?>
    <main class="app-main">
        <div class="container">
            <div class="heading">
                <h3>Add new appointment</h3>
            </div>
            <form action="../controllers/addAppointmentHandler.php" method="POST" autocomplete="off">
                <div id="mainSection">
                    <div class="formSection">
                        <label class="inputLabel" for="datePicker">Date</label>
                        <br>
                        <input type="date" id="datePicker" name="date" required>
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
                        <input type="time" id="startTimePicker" name="startTime" required>
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
                        <input type="time" id="endTimePicker" name="endTime" required>
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
                        <select name="doctorIDs">
                            <?php
                            $query = "SELECT employeeID, firstName, lastName, specialization from employee WHERE NOT
                         specialization ='administrator' AND NOT specialization ='receptionist';";
                            $rawData = handleSelectQuery($query);

                            while($fetched = mysqli_fetch_assoc($rawData)) {
                                $employeeID = $fetched["employeeID"];
                                $firstName = $fetched["firstName"];
                                $lastName = $fetched["lastName"];
                                $specialization = $fetched["specialization"];
                                echo "<option value=$employeeID>$employeeID-$firstName  $lastName-$specialization</option>";
                            }
                            ?>
                        </select>
                    </div>

<!--                    --><?php //if($_SESSION["accountType"] == "receptionist") {
//                        ?>
<!--                        <div class="formSection">-->
<!--                            <label class="inputLabel" for="usernameTextBox">Patient ID</label>-->
<!--                            <br>-->
<!--                            <select name="patientIDs">-->
<!--                                --><?php
//                                $query = "SELECT
//                                            patientID,
//                                            firstName,
//                                            lastName
//                                            from patient WHERE patientID NOT IN
//                                            (SELECT patientID from roomoccupancy WHERE endDate >= '$currentDate');";
//                                $rawData = handleSelectQuery($query);
//
//                                while($fetched = mysqli_fetch_assoc($rawData)) {
//                                    $employeeID = $fetched["patientID"];
//                                    $firstName = $fetched["firstName"];
//                                    $lastName = $fetched["lastName"];
//                                    echo "<option value=$employeeID>[$employeeID] $firstName $lastName</option>";
//                                }
//                                ?>
<!--                            </select>-->
<!--                        </div>-->
<!---->
<!--                    --><?php
//                    }?>

                    <div class="formSection">
                        <label class="inputLabel" for="addressTextBox">Reason</label>
                        <br>
                        <textarea id="addressTextBox" name="reason" column=40 row=5 required></textarea>
                        <br>
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
