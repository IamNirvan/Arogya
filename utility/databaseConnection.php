<?php

function getConnection() {
    $serverName = "localhost";
    $username = "root";
    $password = "";
    $dbName = "arogyahms";

    return mysqli_connect($serverName, $username, $password, $dbName);
}