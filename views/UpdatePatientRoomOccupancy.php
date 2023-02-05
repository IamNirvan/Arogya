<?php
$pageTitle = "Update patient room booking";
require('partials/header.php');
require('partials/navigation.php');

if(isset($_SESSION["username"])) {
    $currentDate = date("Y-m-d");
    $recId = $_GET["ID"];
    $records = handleSelectQuery("SELECT * FROM roomoccupancy WHERE occupancyID = '$recId';");
    $doctorID = $_SESSION["ID"];
    $currentDate = date("Y-m-d");
    $currentTime = time();

    if($records) {
        $globalFetch = mysqli_fetch_assoc($records);
    }

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
            <h3>Update a Room Booking</h3>
        </div>
        <div class="container">
            <form action="<?php echo $_SERVER['PHP_SELF']?>?ID=<?php echo $recId?>" method="POST">
                <div id="mainSection">
                    <div class="formSection">
                        <label class="inputLabel" for="startDatePicker">Start date</label>
                        <br>
                        <input type="date" id="startDatePicker" name="startDate"
                            <?php
                            if(isset( $globalFetch["startDate"])) {
                                echo 'value="'. $globalFetch["startDate"].'"';
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
                            if(isset( $globalFetch["endDate"])) {
                                echo 'value="'. $globalFetch["endDate"].'"';
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
                                echo (isset($_POST["availableRoomsButton"])) ? 'value="'. $_POST["startTime"].'"' : 'value="'. $globalFetch["startTime"].'"' ;
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
                                echo (isset($_POST["availableRoomsButton"])) ? 'value="'. $_POST["endTime"].'"' : 'value="'. $globalFetch["endTime"].'"' ;
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
                        <label class="inputLabel" for="patientTextBox">Room type</label>
                        <br>
                        <select name="roomType" required>
                            <?php
                            $query = "SELECT * FROM roomtype";
                            $rawData = handleSelectQuery($query);

                            $roomTypeQuery = "SELECT roomTypeID from room WHERE roomID = '".$globalFetch["roomID"]."'";
                            $fetchedRoomType = mysqli_fetch_assoc(handleSelectQuery($roomTypeQuery));

                            while($fetched = mysqli_fetch_assoc($rawData)) {
                                $typeID = $fetched["roomTypeID"];
                                $typeName = $fetched["typeName"];

                                if(isset($_POST["availableRoomsButton"])) {
                                    if($typeID == $fetchedRoomType["roomTypeID"]) {
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
                echo '<form action="../controllers/updatePatientRoomOccupancyHandler.php?ID='.$recId.'&startDate='.$globalFetch["startDate"].'&endDate='.$globalFetch["endDate"].'&startTime='.$globalFetch["startTime"].'&endTime='.$globalFetch["endTime"].'" method="POST" autocomplete="off">';
            }
            else {
                echo '<form action="../controllers/updatePatientRoomOccupancyHandler.php?ID='.$recId.'&" method="POST" autocomplete="off">';
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
                                    WHERE operatingroomschedule.bookedDate >= '2023-02-05' AND patientID != '".$globalFetch["patientID"]."') 
                                    AND patient.patientID NOT IN 
                                    (SELECT 
                                    roomoccupancy.patientID 
                                    FROM roomoccupancy 
                                    WHERE roomoccupancy.endDate >= '2023-02-05' AND patientID != '".$globalFetch["patientID"]."');";
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
                <button type="submit" name="confirmButton">Update</button>
            </div>
            </form>
        </div>
    </main>
    <?php

//
//    if($records) {
//        $globalFetch = mysqli_fetch_assoc($records);
//    }
//    ?>
<!--    <main class="app-main">-->
<!--        <div class="container">-->
<!--            <div class="heading">-->
<!--                <h3>Update Patient Room Booking</h3>-->
<!--            </div>-->
<!--            <form action="../controllers/addORBookingHandler.php" method="POST" autocomplete="off">-->
<!--                <div id="mainSection">-->
<!--                    <div class="formSection">-->
<!--                        <label class="inputLabel" for="startDatePicker">Start date</label>-->
<!--                        <br>-->
<!--                        <input type="date" id="startDatePicker" name="date" value="--><?php //echo $globalFetch['startDate']?><!--" required>-->
<!--                        <br>-->
<!--                        <label class="errorMessage" for="startDatePicker">--><?php
//                            if(isset($_GET["invalidDateError"])) {
//                                echo $_GET["invalidDateError"];
//                            }
//                            ?><!--</label>-->
<!--                    </div>-->
<!--                    <div class="formSection">-->
<!--                        <label class="inputLabel" for="endDatePicker">End date</label>-->
<!--                        <br>-->
<!--                        <input type="date" id="endDatePicker" name="date" value="--><?php //echo $globalFetch['endDate']?><!--" required>-->
<!--                        <br>-->
<!--                        <label class="errorMessage" for="endDatePicker">--><?php
//                            if(isset($_GET["invalidDateError"])) {
//                                echo $_GET["invalidDateError"];
//                            }
//                            ?><!--</label>-->
<!--                    </div>-->
<!--                    <div class="formSection">-->
<!--                        <label class="inputLabel" for="startTimePicker">Start time</label>-->
<!--                        <br>-->
<!--                        <input type="time" id="startTimePicker" name="startTime" value="--><?php //echo $globalFetch['startTime']?><!--" required>-->
<!--                        <br>-->
<!--                        <label class="errorMessage" for="startTimePicker">--><?php
//                            if(isset($_GET["invalidStartTimeError"])) {
//                                echo $_GET["invalidStartTimeError"];
//                            }
//                            ?><!--</label>-->
<!--                    </div>-->
<!--                    <div class="formSection">-->
<!--                        <label class="inputLabel" for="endTimePicker">End time</label>-->
<!--                        <br>-->
<!--                        <input type="time" id="endTimePicker" name="endTime" value="--><?php //echo $globalFetch['endTime']?><!--" required>-->
<!--                        <br>-->
<!--                        <label class="errorMessage" for="endTimePicker">--><?php
//                            if(isset($_GET["invalidDurationError"])) {
//                                echo $_GET["invalidDurationError"];
//                            }
//                            ?><!--</label>-->
<!--                    </div>-->
<!--                    <div class="formSection">-->
<!--                        <label class="inputLabel" for="patientTextBox">Patient</label>-->
<!--                        <br>-->
<!--                        <select name="patientIDs">-->
<!--                            --><?php
//                            $query = "SELECT
//                                        patient.patientID,
//                                        patient.firstName,
//                                        patient.lastName
//                                        FROM patient;";
//                            $rawData = handleSelectQuery($query);
//
//                            while($fetched = mysqli_fetch_assoc($rawData)) {
//                                $patientID = $fetched["patientID"];
//                                $firstName = $fetched["firstName"];
//                                $lastName = $fetched["lastName"];
//
//                                if($globalFetch["patientID"] == $patientID) {
//                                    echo "<option value=$patientID selected>[$patientID] $firstName  $lastName</option>";
//                                }
//                                else {
//                                    echo "<option value=$patientID>[$patientID] $firstName  $lastName</option>";
//                                }
//                            }
//                            ?>
<!--                        </select>-->
<!--                    </div>-->
<!--                    <div class="formSection">-->
<!--                        <label class="inputLabel" for="patientTextBox">Room</label>-->
<!--                        <br>-->
<!--                        <select name="roomIDs">-->
<!--                            --><?php
//                            $query = "SELECT
//                                        room.roomID,
//                                        room.roomNumber
//                                        FROM room WHERE room.roomID NOT IN
//                                       (SELECT
//                                            roomoccupancy.roomID
//                                            FROM roomoccupancy);";
//                            $rawData = handleSelectQuery($query);
//
//                            while($fetched = mysqli_fetch_assoc($rawData)) {
//                                $ORID = $fetched["roomID"];
//                                $roomNumber = $fetched["roomNumber"];
//                                echo "<option value=$ORID>[$ORID] room number $roomNumber </option>";
//                            }
//                            ?>
<!--                        </select>-->
<!--                    </div>-->
<!--                    <div class="radioButtonSection">-->
<!--                        <label class="inputLabel">Occupancy status</label>-->
<!--                        <div>-->
<!--                            <label class="inputLabel" for="openRadioBtn">Active</label>-->
<!--                            --><?php
//                            if($globalFetch["occupancyStatus"] == "active") {
//                                echo '<input type="radio" value="open" id="openRadioBtn" name="occupancyStatus" checked required>';
//                            }
//                            else {
//                                echo '<input type="radio" value="open" id="openRadioBtn" name="occupancyStatus" required>';
//                            }
//                            ?>
<!--                            <label class="inputLabel" for="closeRadioBtn">Inactive</label>-->
<!--                            --><?php
//                            if($globalFetch["occupancyStatus"] == "inactive") {
//                                echo '<input type="radio" value="close" id="closeRadioBtn" name="occupancyStatus" checked required>';
//                            }
//                            else {
//                                echo '<input type="radio" value="close" id="closeRadioBtn" name="occupancyStatus" required>';
//                            }
//                            ?>
<!--                        </div>-->
<!--                    </div>-->
<!--                </div>-->
<!--                <div class="buttonSection">-->
<!--                    <button type="submit">Update</button>-->
<!--                </div>-->
<!--            </form>-->
<!--        </div>-->
<!--    </main>-->
<!--    --><?php
}
else {
    header("Location: login.php");
}
?>
