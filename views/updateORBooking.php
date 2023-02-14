<?php
$pageTitle = "Add OR booking";
require('partials/header.php');
require('partials/navigation.php');
date_default_timezone_set("Asia/Colombo");

if(isset($_SESSION["username"])) {
    $ORBookingID = $_GET["ID"];
    $doctorID = $_SESSION["ID"];
    $currentDate = date("Y-m-d");
    $records = handleSelectQuery("SELECT * FROM operatingroomschedule 
                                            WHERE operatingRoomScheduleID = '$ORBookingID';");
    $currentTime = time();
    $globalFetch = null;

    if($records) {
        $globalFetch = mysqli_fetch_assoc($records);
    }

    if(isset($_POST["availableRoomsButton"])) {
        $bookedDate = $_POST["date"];
        $startTime = $_POST["startTime"];
        $endTime = $_POST["endTime"];

        $availableRoomsQuery = "SELECT operatingRoomID, roomNumber from operatingroom WHERE operatingroomID NOT IN
                                    (SELECT operatingroomID FROM operatingroomschedule
                                    WHERE bookedDate >= '$currentDate' AND (startTime >= '$startTime'
                                    OR (endTime >= '$startTime' AND endTime <= '$endTime')));";
    }
    else {
        $availableRoomsQuery = null;
    }
?>
    <main class="app-main">
        <div class="heading">
            <h3>Update an Operating Room Booking</h3>
        </div>
        <div class="container">
            <form action="<?php echo $_SERVER['PHP_SELF']?>?ID=<?php echo $ORBookingID?>" method="POST">
                <div id="mainSection">
                    <div class="formSection">
                        <label class="inputLabel" for="datePicker">Booked date</label>
                        <br>
                        <input type="date" id="datePicker" name="date"
                            <?php
                                if(isset($_POST["availableRoomsButton"])) {
                                    echo 'value="'.$bookedDate.'"';
                                }
                                else if(isset($globalFetch["bookedDate"])) {
                                    echo 'value="'. $globalFetch["bookedDate"].'"';
                                }
                            ?> required>
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
                        <input type="time" id="startTimePicker" name="startTime"
                            <?php
                                if(isset($_POST["availableRoomsButton"])) {
                                    echo 'value="'.$startTime.'"';
                                }
                                else if(isset( $globalFetch["startTime"])) {
                                    echo 'value="'. $globalFetch["startTime"].'"';
                                }
                            ?> required>
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
                                if(isset($_POST["availableRoomsButton"])) {
                                    echo 'value="'.$endTime.'"';
                                }
                                else if(isset( $globalFetch["endTime"])) {
                                    echo 'value="'. $globalFetch["endTime"].'"';
                                }
                            ?> required>
                        <br>
                        <label class="errorMessage" for="endTimePicker"><?php
                            if(isset($_GET["invalidDurationError"])) {
                                echo $_GET["invalidDurationError"];
                            }
                            ?></label>
                    </div>
                </div>
                <div class="buttonSection">
                    <button type="submit" name="availableRoomsButton">get available rooms</button>
                </div>
            </form>

            <?php
            if(isset($_POST["availableRoomsButton"])) {
                echo '<form action="../controllers/updateORBookingHandler.php?ID='.$ORBookingID.'&date='.$_POST["date"].
                    '&startTime='.$_POST["startTime"].'&endTime='.$_POST["endTime"].
                    '" method="POST" autocomplete="off">';
            }
            else {
                echo '<form action="../controllers/updateORBookingHandler.php?ID='.$ORBookingID.
                    '" method="POST" autocomplete="off">';
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
                                    FROM patient WHERE patient.patientID NOT IN
                                    (SELECT operatingroomschedule.patientID 
                                    FROM operatingroomschedule 
                                    WHERE `operatingRoomScheduleID` != '$ORBookingID');";
                        $rawData = handleSelectQuery($query);

                        while($fetched = mysqli_fetch_assoc($rawData)) {
                            $patientID = $fetched["patientID"];
                            $firstName = $fetched["firstName"];
                            $lastName = $fetched["lastName"];

                            if($globalFetch["patientID"] == $patientID) {
                                echo "<option value=$patientID selected>[$patientID] $firstName  $lastName</option>";
                            }
                            else {
                                echo "<option value=$patientID>[$patientID] $firstName  $lastName</option>";
                            }
                        }
                        ?>
                    </select>
                </div>
                <div class="formSection">
                    <label class="inputLabel" for="operatingRoomTextBox">Operating room</label>
                    <br>
                    <select name="operatingRoomIDs" required>
                        <?php
                        if($availableRoomsQuery != null) {
                            $rawData = handleSelectQuery($availableRoomsQuery);

                            while($fetched = mysqli_fetch_assoc($rawData)) {
                                $ORID = $fetched["operatingRoomID"];
                                $roomNumber = $fetched["roomNumber"];
                                echo "<option value=$ORID>[$ORID] room number $roomNumber </option>";
                            }
                        }
                        ?>
                    </select>
                </div>
            </div>
            <div class="buttonSection">
                <button type="submit" name="updateButton">Update</button>
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
