<?php
require $_SERVER["DOCUMENT_ROOT"]."/1_HND/HMS_V2/includes/database/databaseConnection.php";
require $_SERVER["DOCUMENT_ROOT"]."/1_HND/HMS_V2/includes/utility/errorPrinter.php";

function handleSelectQuery($query) {
    $connection = getConnection();

    // Check the connection
    if($connection) {
        // Execute the query
        $result = mysqli_query($connection, $query);
        mysqli_close($connection);

        // Return a valid result set, otherwise false
        if(mysqli_num_rows($result) > 0) {
            // return mysqli_fetch_assoc($result);
            return $result;
        }
        return false;
    }
    else {
        // Connection failed
        printError("CONNECTION FAILED", mysqli_connect_error());
        die();
    }
}

function handleInsertQuery($query) {
    $connection = getConnection();

    // Check connection
    if($connection) {
        if(!mysqli_query($connection, $query)) {
            // Display error message
            printError("ERROR WHEN INSERTING", mysqli_error($connection));
            mysqli_close($connection);
            return false;
        }
        return true;
    }
    else {
        // Connection failed
        printError("CONNECTION FAILED", mysqli_connect_error());
        die();
    }
}

function handleUpdateQuery($query) {
    $connection = getConnection();

    // Check connection
    if($connection) {
        if(!mysqli_query($connection, $query)) {
            // Display error message
            printError("ERROR WHEN UPDATING", mysqli_error($connection));
            mysqli_close($connection);
            return false;
        }
        return true;
    }
    else {
        // Connection failed
        printError("CONNECTION FAILED", mysqli_connect_error());
        die();
    }
}

function handleDeleteQuery($query) {
    $connection = getConnection();

    // Check connection
    if($connection) {
        if(!mysqli_query($connection, $query)) {
            // Display error message
            printError("ERROR WHEN DELETING", mysqli_error($connection));
            mysqli_close($connection);
            return false;
        }
        return true;
    }
    else {
        // Connection failed
        printError("CONNECTION FAILED", mysqli_connect_error());
        die();
    }
}