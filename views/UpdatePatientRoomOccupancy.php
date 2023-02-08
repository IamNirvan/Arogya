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
//        var_dump($globalFetch);
//        die();
    }

    if(isset($_POST["availableRoomsButton"])) {
        $startDate = $_POST["startDate"];
        $endDate = $_POST["endDate"];
        $startTime = $_POST["startTime"];
        $endTime = $_POST["endTime"];
        $roomType = $_POST["roomType"];
        $roomID = $globalFetch["roomID"];

        $availableRoomsQuery = "SELECT * from room WHERE roomID NOT IN
                                    (SELECT
                                    roomID
                                    FROM roomoccupancy
                                    WHERE (startDate >= '$startDate' OR (endDate >= '$startDate' AND endDate<= '$endDate')))
                                    AND roomTypeID = '$roomType';";
    }
    else {
        $availableRoomsQuery = "SELECT * from room WHERE roomID;";
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
                            //
                            // Get the room type using the roomID
                            //
                            $roomID = $globalFetch["roomID"];
                            $roomTypeQuery = "SELECT roomTypeID FROM room WHERE roomID = '$roomID'";
                            $rawData2 = handleSelectQuery($roomTypeQuery);
                            $fetched2 = mysqli_fetch_assoc($rawData2);

                            while($fetched = mysqli_fetch_assoc($rawData)) {
                                $typeID = $fetched["roomTypeID"];
                                $typeName = $fetched["typeName"];


                                if(isset($_POST["availableRoomsButton"])) {
                                    if($typeID == $roomType) {
                                        echo "<option value=$typeID selected>[$typeID] $typeName</option>";
                                    }
                                    else {
                                        echo "<option value=$typeID>[$typeID] $typeName</option>";
                                    }

                                }
                                else {

                                    if($typeID == $fetched2["roomTypeID"]) {
                                        echo "<option value=$typeID selected>[$typeID] $typeName</option>";
                                    }
                                    else {
                                        echo "<option value=$typeID>[$typeID] $typeName</option>";
                                    }


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

                                if(isset($_POST["availableRoomsButton"])) {
                                    echo "<option value=$roomID>[$roomID] room number $roomNumber </option>";
                                }
                                else {
                                    if($roomID == $globalFetch["roomID"]) {
                                        echo "<option value=$roomID selected>[$roomID] room number $roomNumber </option>";
                                    }
                                    else {
                                        echo "<option value=$roomID>[$roomID] room number $roomNumber </option>";
                                    }
                                }
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
}
else {
    header("Location: login.php");
}
?>
