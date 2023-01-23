<?php

require('partials/header.php');
require('../utility/searchPanel.php');

$options = [
    "ID" => "patientID", 
    "Date" => "startDate", 
    "Time" => "startTime"];

echo'<div class="app-main">';
addSearchBar("cdfvd.php", $options);

echo '</div>';
// parse_url($_SERVER['REQUEST_URI'])['path']
// require 'utility/printer.php';

// dump_and_die($_SERVER['REQUEST_URI']);
?>