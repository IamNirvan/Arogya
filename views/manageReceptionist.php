<?php
$pageTitle = "Manage receptionists";

require('partials/header.php');
require('partials/navigation.php');
require('../utility/table.php');
require('../utility/searchPanel.php');
require('../utility/informationPanel.php');

if(isset($_SESSION["username"])) {
    $currentdate = date('Y-m-d');

    if(isset($_GET["error"])) {
        echo '<script>alert("'.$_GET["error"].'")</script>';
    }
?>
<main class="app-main">
    <?php
        if(isset($_GET["ID"])) {
            $recId = $_GET["ID"];
            $informationPanelQuery = "SELECT 
                                employee.employeeID AS 'Employee ID', 
                                employee.firstName AS 'First name', 
                                employee.middleName AS 'Middle name',
                                employee.lastName AS 'Last name',
                                employee.gender AS 'Gender',
                                employee.contactNumber AS 'Contact number'
                                FROM employeeAccount INNER JOIN employee 
                                ON employeeAccount.employeeID=employee.employeeID 
                                AND employeeaccount.accountType = 'receptionist' 
                               AND employee.employeeID = '$recId';";
        }
        else {
            $informationPanelQuery = "SELECT 
                                employee.employeeID AS 'Employee ID', 
                                employee.firstName AS 'First name',
                                employee.middleName AS 'Middle name',
                                employee.lastName AS 'Last name',
                                employee.gender AS 'Gender',
                                employee.contactNumber AS 'Contact number'
                                FROM employeeAccount INNER JOIN employee 
                                ON employeeAccount.employeeID=employee.employeeID 
                                AND employeeaccount.accountType = 'receptionist';";
        }
        //
        // Information panel
        //
        $panelRecords = handleSelectQuery($informationPanelQuery);
        if($panelRecords) {
            $panelFetched = mysqli_fetch_assoc($panelRecords);
            echo '<form id="informationPanelForm" method="POST" action="'.$_SERVER["PHP_SELF"].'">';
            addInformationPanel($panelFetched);
            echo '</form>';
        }
        //
        // Search panel
        //
        $options = [
            "ID" => "employeeID",
            "First name" => "firstName",
            "Middle name" => "middleName",
            "Last name" => "lastName",
            "Contact number" => "contact",
            "Gender" => "gender"
        ];
        echo '<form id="searchPanelForm" method="GET" action="'.$_SERVER["PHP_SELF"].'" autocomplete="off">';
        addSearchBar($options);
        echo '</form>';
        //
        // Table
        //
        echo '<div id="tableContainer">';
        if(isset($_GET["searchButton"])) {
            $option = $_GET['searchOption'];
            $term = $_GET['searchBar'];
            $tableDataQuery = "SELECT 
                                employee.employeeID, 
                                employee.firstName, 
                                employee.lastName
                                FROM employeeAccount INNER JOIN employee 
                                ON employeeAccount.employeeID=employee.employeeID 
                                AND employeeaccount.accountType = 'receptionist' AND employee.$option = '$term'";
        }
        else {
            $tableDataQuery = "SELECT 
                                employee.employeeID, 
                                employee.firstName, 
                                employee.lastName
                                FROM employeeAccount INNER JOIN employee 
                                ON employeeAccount.employeeID=employee.employeeID 
                                AND employeeaccount.accountType = 'receptionist';";
        }
        $columnNames1 = ["ID", "First name", "Last name"];
        $attributes1 = ["employeeID", "firstName", "lastName"];
        addTable(columnNames: $columnNames1, attributes: $attributes1, query:$tableDataQuery,
            title:"Receptionist", size:"largeBox", addItemPage: "addReceptionist.php", deleteLink: "deleteReceptionist.php",
            updateLink: "updateReceptionist.php", viewLink: $_SERVER['PHP_SELF']);
        echo '</div>';
    ?>
</main>
<?php
}
else {
    header("Location: login.php");
}
?><?php
