<?php

$data = [
    "login.php" => "<link rel=\"stylesheet\" href=\"css/loginStyle.css\">\n",
    "register.php" => "<link rel=\"stylesheet\" href=\"css/registerStyle.css\">\n",
//    "appointment.php" => "<link rel=\"stylesheet\" href=\"css/appointmentStyle.css\">\n",
    "patientRegistration.php" => "<link rel=\"stylesheet\" href=\"css/patientRegistrationStyle.css\">\n",
    "addAppointment.php" => "<link rel=\"stylesheet\" href=\"css/dataManagementStyle.css\">\n",
    "updateAppointment.php" => "<link rel=\"stylesheet\" href=\"css/dataManagementStyle.css\">\n",
    "deleteAppointment.php" => "<link rel=\"stylesheet\" href=\"css/deleteRecordStyle.css\">\n",
    "addORBooking.php" => "<link rel=\"stylesheet\" href=\"css/ORBookingManagementStyle.css\">\n",
    "updateORBooking.php" => "<link rel=\"stylesheet\" href=\"css/ORBookingManagementStyle.css\">\n",
    "deleteORBooking.php" => "<link rel=\"stylesheet\" href=\"css/deleteRecordStyle.css\">\n",
    "addPatientRoomOccupancy.php" => "<link rel=\"stylesheet\" href=\"css/ORBookingManagementStyle.css\">\n",
    "updatePatientRoomOccupancy.php" => "<link rel=\"stylesheet\" href=\"css/ORBookingManagementStyle.css\">\n",
    "addReceptionist.php" => "<link rel=\"stylesheet\" href=\"css/dataManagementStyle.css\">\n",
    "updateReceptionist.php" => "<link rel=\"stylesheet\" href=\"css/dataManagementStyle.css\">\n",
    "deleteReceptionist.php" => "<link rel=\"stylesheet\" href=\"css/dataManagementStyle.css\">\n",
    "addDoctor.php" => "<link rel=\"stylesheet\" href=\"css/dataManagementStyle.css\">\n",
    "updateDoctor.php" => "<link rel=\"stylesheet\" href=\"css/dataManagementStyle.css\">\n",
    "deleteDoctor.php" => "<link rel=\"stylesheet\" href=\"css/dataManagementStyle.css\">\n",
    "addAllergy.php" => "<link rel=\"stylesheet\" href=\"css/dataManagementStyle.css\">\n",
    "updateAllergy.php" => "<link rel=\"stylesheet\" href=\"css/dataManagementStyle.css\">\n",
    "deleteAllergy.php" => "<link rel=\"stylesheet\" href=\"css/deleteRecordStyle.css\">\n",
    "addExamination.php" => "<link rel=\"stylesheet\" href=\"css/dataManagementStyle.css\">\n",
    "updateExamination.php" => "<link rel=\"stylesheet\" href=\"css/dataManagementStyle.css\">\n",
    "deleteExamination.php" => "<link rel=\"stylesheet\" href=\"css/deleteRecordStyle.css\">\n",
    "addImmunizations.php" => "<link rel=\"stylesheet\" href=\"css/dataManagementStyle.css\">\n",
    "updateImmunization.php" => "<link rel=\"stylesheet\" href=\"css/dataManagementStyle.css\">\n",
    "deleteImmunization.php" => "<link rel=\"stylesheet\" href=\"css/deleteRecordStyle.css\">\n",
    "addSurgery.php" => "<link rel=\"stylesheet\" href=\"css/dataManagementStyle.css\">\n",
    "updateSurgery.php" => "<link rel=\"stylesheet\" href=\"css/dataManagementStyle.css\">\n",
    "deleteSurgery.php" => "<link rel=\"stylesheet\" href=\"css/deleteRecordStyle.css\">\n"
];


function map($key) {
    global $data;
    if(array_key_exists($key, $data)) {
        return $data[$key];
    }
}
