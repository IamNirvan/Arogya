<!-- FIX QUERIES -->
<?php
$pageTitle = "Add OR booking";
require('partials/header.php');
require('partials/navigation.php');
date_default_timezone_set("Asia/Colombo");

if(isset($_SESSION["username"])) {
    $doctorID = $_SESSION["ID"];
    $currentDate = date("Y-m-d");
    $currentTime = time();

    if(isset($_POST["availableRoomsButton"])) {
        $bookedDate = $_POST["date"];
        $startTime = $_POST["startTime"];
        $endTime = $_POST["endTime"];

        $availableRoomsQuery = "SELECT operatingRoomID, roomNumber from operatingroom WHERE operatingroomID NOT IN
                                    (SELECT operatingroomID FROM operatingroomschedule 
                                    WHERE bookedDate >= $currentDate AND (startTime >= '$startTime' 
                                    OR (endTime >= '$startTime' AND endTime <= '$endTime')));";
    }
    else {
        $availableRoomsQuery = null;
    }
    ?>
    <main class="app-main">
        <div class="heading">
            <h3>Book an Operating Room</h3>
        </div>
        <div class="container">
            <form action="<?php echo $_SERVER['PHP_SELF']?>" method="POST">
                <div id="mainSection">
                    <div class="formSection">
                        <label class="inputLabel" for="datePicker">Booked date</label>
                        <br>
                        <input type="date" id="datePicker" name="date"
                           <?php
                                if(isset( $_POST["date"])) {
                                    echo 'value="'. $_POST["date"].'"';
                                }
                           ?>
                           required>
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
                </div>
                <div class="buttonSection">
                    <button type="submit" name="availableRoomsButton">get available rooms</button>
                </div>
            </form>

            <?php
                if(isset($_POST["availableRoomsButton"])) {
                    echo '<form action="../controllers/addORBookingHandler.php?date='.$_POST["date"].'&startTime='.$_POST["startTime"].'&endTime='.$_POST["endTime"].'" method="POST" autocomplete="off">';
                }
                else {
                    echo '<form action="../controllers/addORBookingHandler.php" method="POST" autocomplete="off">';
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
                                       (SELECT operatingroomschedule.patientID FROM operatingroomschedule );";
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
