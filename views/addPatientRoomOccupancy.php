<?php
$pageTitle = "Add room booking";
require('partials/header.php');
require('partials/navigation.php');
require('../utility/table.php');
require('../utility/searchPanel.php');
require('../utility/informationPanel.php');
date_default_timezone_set("Asia/Colombo");

if(isset($_SESSION["username"])) {
    $doctorID = $_SESSION["ID"];
    $currentDate = date("Y-m-d");
    $currentTime = time();

    if(isset($_POST["availableRoomsButton"])) {
        $startDate = $_POST["startDate"];
        $endDate = $_POST["endDate"];
        $startTime = $_POST["startTime"];
        $endTime = $_POST["endTime"];
        $roomType = $_POST["roomType"];

        $availableRoomsQuery = "SELECT 
                                    roomID,
                                    roomNumber
                                    FROM room 
                                    WHERE roomID NOT IN 
                                    (SELECT 
                                    roomID 
                                    FROM roomoccupancy 
                                    WHERE (startDate >= '$startDate' OR (endDate >= '$startDate' AND endDate<= '$endDate')))
                                    AND roomTypeID = '$roomType';";
    }
    else {
        $availableRoomsQuery = null;
    }

    ?>
    <main class="app-main">
        <div class="heading">
            <h3>Book a Room</h3>
        </div>
        <div class="container">
            <form action="<?php echo $_SERVER['PHP_SELF']?>" method="POST">
                <div id="mainSection">
                    <div class="formSection">
                        <label class="inputLabel" for="startDatePicker">Start date</label>
                        <br>
                        <input type="date" id="startDatePicker" name="startDate"
                            <?php
                            if(isset( $_POST["startDate"])) {
                                echo 'value="'. $_POST["startDate"].'"';
                            }
                            ?>
                               required>
                        <br>
                        <label class="errorMessage" for="startDatePicker"><?php
                            if(isset($_GET["invalidStartDateError"])) {
                                echo $_GET["invalidStartDateError"];
                            }
                            ?></label>
                    </div>
                    <div class="formSection">
                        <label class="inputLabel" for="endDatePicker">End date</label>
                        <br>
                        <input type="date" id="endDatePicker" name="endDate"
                            <?php
                            if(isset( $_POST["endDate"])) {
                                echo 'value="'. $_POST["endDate"].'"';
                            }
                            ?>
                               required>
                        <br>
                        <label class="errorMessage" for="endDatePicker"><?php
                            if(isset($_GET["invalidEndDateError"])) {
                                echo $_GET["invalidEndDateError"];
                            }
                            ?></label>
                    </div>
                    <div class="formSection">
                        <label class="inputLabel" for="startTimePicker">Start time</label>
                        <br>
                        <input type="time" id="startTimePicker" name="startTime"
                            <?php
                            if(isset( $_POST["startTime"])) {
                                echo 'value="'. $_POST["startTime"].'"';
                            }
                            ?>
                               required>
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
                        <input type="time" id="endTimePicker" name="endTime"
                            <?php
                            if(isset( $_POST["endTime"])) {
                                echo 'value="'. $_POST["endTime"].'"';
                            }
                            ?>
                               required>
                        <br>
                        <label class="errorMessage" for="endTimePicker"><?php
                            if(isset($_GET["invalidDurationError"])) {
                                echo $_GET["invalidDurationError"];
                            }
                            ?></label>
                    </div>
                    <div class="formSection">
                        <label class="inputLabel" for="roomTypeSelect">Room type</label>
                        <br>
                        <select name="roomType" required>
                            <?php
                            $query = "SELECT * FROM roomtype";
                            $rawData = handleSelectQuery($query);

                            while($fetched = mysqli_fetch_assoc($rawData)) {
                                $typeID = $fetched["roomTypeID"];
                                $typeName = $fetched["typeName"];

                                if(isset($_POST["roomType"])) {
                                    if($typeID == $_POST["roomType"]) {
                                        echo "<option value=$typeID selected>[$typeID] $typeName</option>";
                                    }
                                    else {
                                        echo "<option value=$typeID>[$typeID] $typeName</option>";
                                    }
                                }
                                else {
                                    echo "<option value=$typeID>[$typeID] $typeName</option>";
                                }
                            }
                            ?>
                        </select>
                    </div>
                </div>
                <div class="buttonSection">
                    <button type="submit" name="availableRoomsButton">get available rooms</button>
                </div>
            </form>

            <?php
            if(isset($_POST["availableRoomsButton"])) {
                echo '<form action="../controllers/addPatientRoomOccupancyHandler.php?startDate='.$_POST["startDate"].'&endDate='.$_POST["endDate"].'&startTime='.$_POST["startTime"].'&endTime='.$_POST["endTime"].'" method="POST" autocomplete="off">';
            }
            else {
                echo '<form action="../controllers/addPatientRoomOccupancyHandler.php" method="POST" autocomplete="off">';
            }
            ?>

            <div id="mainSection">
                <div class="formSection">
                    <label class="inputLabel" for="patientTextBox">Patient</label>
                    <br>
                    <select name="patientIDs" required>
                        <?php
                        $query = "SELECT 
                                    patient.patientID, 
                                    patient.firstName, 
                                    patient.lastName 
                                    FROM patient 
                                    WHERE patient.patientID NOT IN 
                                    (SELECT 
                                    operatingroomschedule.patientID 
                                    FROM operatingroomschedule 
                                    WHERE operatingroomschedule.bookedDate >= '2023-02-05') 
                                    AND patient.patientID NOT IN 
                                    (SELECT 
                                    roomoccupancy.patientID 
                                    FROM roomoccupancy 
                                    WHERE roomoccupancy.endDate >= '2023-02-05');";
                        $rawData = handleSelectQuery($query);

                        while($fetched = mysqli_fetch_assoc($rawData)) {
                            $patientID = $fetched["patientID"];
                            $firstName = $fetched["firstName"];
                            $lastName = $fetched["lastName"];
                            echo "<option value=$patientID>[$patientID] $firstName  $lastName</option>";
                        }

                        ?>
                    </select>
                </div>
                <div class="formSection">
                    <label class="inputLabel" for="roomSelect">Room number</label>
                    <br>
                    <select name="roomIDs" id="roomSelect" required>
                        <?php
                        if($availableRoomsQuery != null) {
                            $rawData = handleSelectQuery($availableRoomsQuery);

                            while($fetched = mysqli_fetch_assoc($rawData)) {
                                $roomID = $fetched["roomID"];
                                $roomNumber = $fetched["roomNumber"];
                                echo "<option value=$roomID>[$roomID] room number $roomNumber </option>";
                            }
                        }
                        ?>
                    </select>
                </div>
            </div>
            <div class="buttonSection">
                <button type="submit" name="confirmButton">Confirm booking</button>
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
