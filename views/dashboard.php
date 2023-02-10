<?php
$pageTitle = "Home";
require('partials/header.php');
require('partials/navigation.php');
require('../utility/table.php');
require('../utility/card.php');

if(isset($_SESSION["username"])) {
    $currentDate = date("Y-m-d");
?>

<main class="app-main">
<?php

    if($_SESSION["accountType"] == "receptionist") {
        //
        // Cards section
        //
        echo '<div class="cardContainer">';
            //
            // Get the number of available patient rooms
            //
            $data1 = handleSelectQuery("SELECT
                                                COUNT(roomID) AS roomID
                                                FROM room WHERE roomID NOT IN
                                                (SELECT roomID from roomoccupancy WHERE occupancyStatus = 'active');");

            if($data1) {
                $data1Fetched = mysqli_fetch_assoc($data1);
                addCard("Available patient rooms", $data1Fetched["roomID"], "images/icons/bed-black.png");
            }
            else {
                addCard("Available patient rooms", "Failed to load data", "images/icons/bed-black.png");
            }
            //
            // To get the number of today's appointments.
            //
            $data2 = handleSelectQuery("SELECT 
                                                COUNT(appointmentID) AS appointmentID 
                                                FROM appointment WHERE appointmentStatus = 'open' AND bookedDate = '$currentDate'");
            if($data2) {
                $data2Fetched = mysqli_fetch_assoc($data2);
                addCard("Today's appointments", $data2Fetched["appointmentID"], "images/icons/appointment-black.png");
            }
            else {
                addCard("Today's appointments", "Unable to load data", "images/icons/appointment-black.png");
            }
            //
            // To get the number available ORs.
            //
            $data3 = handleSelectQuery("SELECT 
                                                COUNT(operatingRoomID) AS roomID 
                                                FROM operatingroom WHERE operatingRoomID NOT IN
                                                (SELECT operatingRoomID from operatingroomschedule);");
//            $data3 = handleSelectQuery("SELECT
//                                                COUNT(operatingroomschedule.operatingRoomID) AS roomID
//                                                FROM operatingroomschedule INNER JOIN operatingroom
//                                                WHERE operatingroomschedule.operatingRoomID != operatingroom.operatingRoomID;");
            if($data3) {
                $data3Fetched = mysqli_fetch_assoc($data3);
                addCard("Available Operating Rooms", $data3Fetched["roomID"], "images/icons/OR-black.png");
            }
            else {
                addCard("Available Operating Rooms", "Unable to load data", "images/icons/OR-black.png");
            }
        echo '</div>';
        //
        // Table
        //
        echo '<div id="tableContainerMedium">';
        //
        // To get all the open appointments for the day
        //
        $query1 = "SELECT 
                    appointmentID, 
                    startTime, 
                    endTime, 
                    patientID, 
                    employeeID 
                    FROM appointment 
                    WHERE appointmentStatus = 'open' AND bookedDate = '$currentDate'";
        $columnNames1 = ["ID", "Start", "End", "Patient ID", "Employee ID"];
        $attributes1 = ["appointmentID", "startTime", "endTime", "patientID", "employeeID"];
        addTable(columnNames: $columnNames1, attributes: $attributes1, query:$query1, title:"Today's Appointments",
            size:"smallBox", openItemPage:"appointment.php");
        //
        // To get the room occupancy list
        //
        $query2 = "SELECT 
                    roomID, 
                    startDate, 
                    endDate, 
                    startTime, 
                    endTime, 
                    patientID FROM roomoccupancy 
                    WHERE occupancyStatus = 'active'";
        $columnNames2 = ["ID", "Start date", "End date", "Start time", "End time", "Patient ID"];
        $attributes2 = ["roomID", "startDate", "endDate", "startTime", "endTime", "patientID"];
        addTable(columnNames: $columnNames2, attributes: $attributes2, query:$query2, title:"Room Occupancy",
            size:"smallBox", openItemPage:"PatientRoomOccupancy.php");
        //
        // To get the list of admitted patients
        //
        $query3 = "SELECT 
                    roomoccupancy.occupancyID, 
                    roomoccupancy.startDate, 
                    roomoccupancy.endDate, 
                    patient.firstName, 
                    patient.lastName 
                    FROM roomoccupancy INNER JOIN patient 
                    ON roomoccupancy.patientID = patient.patientID;";
        $columnNames3 = ["ID", "Start date", "End date", "First name", "Last name"];
        $attributes3 = ["occupancyID", "startDate", "endDate", "firstName", "lastName"];
        addTable(columnNames: $columnNames3, attributes: $attributes3, query:$query3, title:"Admitted Patients",
            size:"largeBox", openItemPage:"patients.php");
        echo '</div>';
    }
    else if($_SESSION["accountType"] == "patient") {
        $patientID = $_SESSION["ID"];
        //
        // Tables
        //
        echo '<div id="tableContainerLarge">';
        //
        // Get the open appointments
        //
        $query1 = "SELECT appointmentID, startTime, endTime, patientID, employeeID FROM appointment WHERE appointmentStatus = 'open' AND patientID = '$patientID';";
        $columnNames1 = ["ID", "Start", "End", "Patient ID", "Employee ID"];
        $attributes1 = ["appointmentID", "startTime", "endTime", "patientID", "employeeID"];
        addTable(columnNames: $columnNames1, attributes: $attributes1, query:$query1, title:"Open Appointments", size:"largeBox", openItemPage:"appointment.php");
        //
        // Get the closed appointments
        //
        $query2 = "SELECT appointmentID, startTime, endTime, patientID, employeeID FROM appointment WHERE appointmentStatus = 'close' AND patientID = '$patientID';";
        $columnNames2 = ["ID", "Start", "End", "Patient ID", "Employee ID"];
        $attributes2 = ["appointmentID", "startTime", "endTime", "patientID", "employeeID"];
        addTable(columnNames: $columnNames2, attributes: $attributes2, query:$query2, title:"Closed Appointments", size:"largeBox", openItemPage:"appointment.php");
        echo '</div>';
    }
    else if($_SESSION["accountType"] == "doctor") {
        $doctorID = $_SESSION["ID"];
        //
        // Cards section
        //
        echo '<div class="cardContainer">';
        //
        // Get the number of available patient rooms
        //
        $data1 = handleSelectQuery("SELECT 
                                            COUNT(roomoccupancy.roomID) AS roomID 
                                            FROM roomoccupancy INNER JOIN room 
                                            WHERE roomoccupancy.roomID != room.roomID;");
        if($data1) {
            $data1Fetched = mysqli_fetch_assoc($data1);
            addCard("Available patient rooms", $data1Fetched["roomID"], "images/icons/bed-black.png");
        }
        else {
            addCard("Available patient rooms", "Failed to load data", "images/icons/bed-black.png");
        }
        //
        // To get the number of today's appointments.
        //
        $data2 = handleSelectQuery("SELECT 
                                            COUNT(appointmentID) AS appointmentID 
                                            FROM appointment WHERE appointmentStatus = 'open' 
                                            AND bookedDate = '$currentDate' AND employeeID = '$doctorID'");
        if($data2) {
            $data2Fetched = mysqli_fetch_assoc($data2);
            addCard("Today's appointments", $data2Fetched["appointmentID"], "images/icons/appointment-black.png");
        }
        else {
            addCard("Today's appointments", "Unable to load data", "images/icons/appointment-black.png");
        }
        echo '</div>';
        //
        // Table
        //
        echo '<div id="tableContainerMedium">';
        //
        // To get all the open appointments for the day
        //
        $doctorOpenAppointments = "SELECT 
                                    appointmentID, 
                                    startTime, 
                                    endTime, 
                                    patientID, 
                                    employeeID 
                                    FROM appointment 
                                    WHERE appointmentStatus = 'open' AND bookedDate = '$currentDate' 
                                    AND employeeID = '$doctorID'";
        $doctorOpenAppointmentsColumns = ["ID", "Start", "End", "Patient ID"];
        $doctorOpenAppointmentsAttributes = ["appointmentID", "startTime", "endTime", "patientID"];
        addTable(columnNames: $doctorOpenAppointmentsColumns, attributes: $doctorOpenAppointmentsAttributes, query:$doctorOpenAppointments, title:"Today's Appointments",
            size:"smallBox", openItemPage:"appointment.php");
        //
        // To get the room occupancy list
        //
        $query2 = "SELECT 
                    roomID, 
                    startDate, 
                    endDate, 
                    startTime, 
                    endTime, 
                    patientID FROM roomoccupancy 
                    WHERE occupancyStatus = 'active'";
        $columnNames2 = ["ID", "Start date", "End date", "Start time", "End time", "Patient ID"];
        $attributes2 = ["roomID", "startDate", "endDate", "startTime", "endTime", "patientID"];
        addTable(columnNames: $columnNames2, attributes: $attributes2, query:$query2, title:"Room Occupancy",
            size:"smallBox", openItemPage:"PatientRoomOccupancy.php");
        //
        // To get OR bookings
        //
        $query3 = "SELECT 
                    operatingRoomScheduleID,
                    bookedDate,
                    startTime,
                    endTime,
                    operatingRoomID
                    FROM operatingroomschedule";
        $columnNames3 = ["ID", "Booked date", "Start time", "End time"];
        $attributes3 = ["operatingRoomID", "bookedDate", "startTime", "endTime"];
        addTable(columnNames: $columnNames3, attributes: $attributes3, query:$query3, title:"Operating room bookings",
            size:"largeBox", openItemPage:"ORSchedule.php");
        echo '</div>';
    }
    else if($_SESSION["accountType"] == "administrator") {
        //
        // Cards section
        //
        echo '<div class="cardContainer">';
        //
        // Get the number of employees
        //
        $data1 = handleSelectQuery("SELECT 
                                            COUNT(employeeID) AS employeeID
                                            FROM employee WHERE employeeID IN
                                            (SELECT employeeID FROM employeeAccount WHERE accountType != 'administrator');");
        if($data1) {
            $data1Fetched = mysqli_fetch_assoc($data1);
            addCard("Employees", $data1Fetched["employeeID"], "images/icons/employees-black.png");
        }
        else {
            addCard("Employees", "Failed to load data", "images/icons/employees-black.png");
        }
        //
        // To get the number of doctors.
        //
        $data2 = handleSelectQuery("SELECT 
                                            COUNT(employeeID) AS employeeID
                                            FROM employeeAccount WHERE accountType = 'doctor'");
        if($data2) {
            $data2Fetched = mysqli_fetch_assoc($data2);
            addCard("Doctors", $data2Fetched["employeeID"], "images/icons/doctor.png");
        }
        else {
            addCard("Doctors", "Unable to load data", "images/icons/doctor.png");
        }
        //
        // To get the number of receptionists
        //
        $data2 = handleSelectQuery("SELECT 
                                            COUNT(employeeID) as employeeID
                                            FROM employeeAccount WHERE accountType = 'receptionist'");
        if($data2) {
            $data2Fetched = mysqli_fetch_assoc($data2);
            addCard("Receptionists", $data2Fetched["employeeID"], "images/icons/receptionist.png");
        }
        else {
            addCard("Receptionists", "Unable to load data", "images/icons/receptionist.png");
        }
        echo '</div>';
        //
        // Table
        //
        echo '<div id="tableContainer">';
        //
        // To get all the doctors
        //
        $doctorsQuery = "SELECT 
                            employee.employeeID, 
                            employee.firstName, 
                            employee.lastName 
                            FROM employeeAccount INNER JOIN employee 
                            ON employeeAccount.employeeID=employee.employeeID 
                            AND employeeaccount.accountType = 'doctor';";
        $doctorsColumns = ["Employee ID", "First name", "Last name"];
        $doctorsAttributes = ["employeeID", "firstName", "lastName"];
        addTable(columnNames: $doctorsColumns, attributes: $doctorsAttributes, query:$doctorsQuery, title:"Doctors",
            size:"smallBox", openItemPage:"manageDoctor.php");
        //
        // To get all the receptionists
        //
        $receptionistsQuery = "SELECT 
                                    employee.employeeID, 
                                    employee.firstName, 
                                    employee.lastName 
                                    FROM employeeAccount INNER JOIN employee 
                                    ON employeeAccount.employeeID=employee.employeeID 
                                    AND employeeaccount.accountType = 'receptionist';";
        $receptionistsColumns = ["Employee ID", "First name", "Last name"];
        $receptionistsAttributes = ["employeeID", "firstName", "lastName"];
        addTable(columnNames: $receptionistsColumns, attributes: $receptionistsAttributes,
            query:$receptionistsQuery, title:"Receptionists", size:"smallBox", openItemPage:"manageReceptionist.php");
    }
?>
</main>

<?php
}
else {
    header("Location: login.php");
}
