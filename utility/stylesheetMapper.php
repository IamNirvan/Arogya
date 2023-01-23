<?php

$data = [
    "login.php" => "<link rel=\"stylesheet\" href=\"css/loginStyle.css\">\n",
    "register.php" => "<link rel=\"stylesheet\" href=\"css/registerStyle.css\">\n",
    "appointment.php" => "<link rel=\"stylesheet\" href=\"css/appointmentStyle.css\">\n",
    "patientRegistration.php" => "<link rel=\"stylesheet\" href=\"css/patientRegistrationStyle.css\">\n",
];


function map($key) {
    global $data;
    if(array_key_exists($key, $data)) {
        return $data[$key];
    }
}
?>