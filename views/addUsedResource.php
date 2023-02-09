<?php
$pageTitle = "Add used resource";
require('partials/header.php');
require('partials/navigation.php');

if(isset($_SESSION["username"])) {
    $appointmentID = $_GET["ID"];
    $records = handleSelectQuery("SELECT * FROM usedresources WHERE appointmentID = '$appointmentID'");

    if($records) {
        $globalFetched = mysqli_fetch_assoc($records);
        $query = "SELECT * FROM resources WHERE resourceID NOT IN (SELECT resourceID FROM usedresources WHERE appointmentID = '$appointmentID');";
    }
    else {
        $query = "SELECT * FROM resources;";
    }

?>
    <main class="app-main">
        <div class="heading">
            <h3>Add Used Resource</h3>
        </div>
        <div class="container">
            <form action="../controllers/addUsedResourceHandler.php?ID=<?php echo $appointmentID?>" method="POST" autocomplete="off">
                <div id="mainSection">
                    <div class="formSection">
                        <label class="inputLabel" for="resourceTextBox">Resource</label>
                        <br>
                        <select name="resourceIDs">
                            <?php
                            $rawData = handleSelectQuery($query);

                            while($fetched = mysqli_fetch_assoc($rawData)) {
                                $resourceID = $fetched["resourceID"];
                                $resourceName = $fetched["resourceName"];
                                echo "<option value=$resourceID>[$resourceID] $resourceName</option>";
                            }
                            ?>
                        </select>
                    </div>

                    <div class="formSection">
                        <label class="inputLabel" for="quantityTextBox">Quantity</label>
                        <br>
                        <input type="text" id="quantityTextBox" name="quantity" required>
                        <br>
                        <label class="errorMessage" for="quantityTextBox"><?php
                            if(isset($_GET["quantityError"])) {
                                echo $_GET["quantityError"];
                            }
                            ?></label>
                    </div>
                </div>
                <div class="buttonSection">
                    <button type="submit">Add</button>
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
