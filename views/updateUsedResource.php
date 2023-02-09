<?php
$pageTitle = "Update used resource";
require('partials/header.php');
require('partials/navigation.php');

if(isset($_SESSION["username"])) {
    $resourceID = $_GET["ID"];
    $appointmentID = $_SESSION["appointmentID"];
    $records = handleSelectQuery("SELECT * FROM usedresources WHERE usedResourceID = '$resourceID';");

    if($records) {
        $globalFetched = mysqli_fetch_assoc($records);
        $resourceID = $globalFetched["resourceID"];
        $query = "SELECT * FROM resources WHERE resourceID NOT IN
                              (SELECT resourceID FROM usedresources WHERE appointmentID = '$appointmentID') OR resourceID ='$resourceID';";
    }

?>
    <main class="app-main">
        <div class="heading">
            <h3>Update Used Resource</h3>
        </div>
        <div class="container">
            <?php $usedResourceID = $globalFetched["usedResourceID"] ?>
            <form action="../controllers/updateUsedResourceHandler.php?ID=<?php echo $usedResourceID?>&appointmentID=<?php echo $appointmentID?>&oldResource=<?php echo $resourceID?>" method="POST" autocomplete="off">
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

                                if($globalFetched["resourceID"] == $resourceID) {
                                    echo "<option value=$resourceID selected>[$resourceID] $resourceName</option>";
                                }
                                else {
                                    echo "<option value=$resourceID>[$resourceID] $resourceName</option>";
                                }
                            }
                            ?>
                        </select>
                    </div>

                    <div class="formSection">
                        <label class="inputLabel" for="quantityTextBox">Quantity</label>
                        <br>
                        <input type="text" id="quantityTextBox" name="quantity" value="<?php
                            if(isset($globalFetched["quantity"])) {
                                echo $globalFetched["quantity"];
                            }
                        ?>" required>
                        <br>
                        <label class="errorMessage" for="quantityTextBox"><?php
                            if(isset($_GET["quantityError"])) {
                                echo $_GET["quantityError"];
                            }
                            ?></label>
                    </div>
                </div>
                <div class="buttonSection">
                    <button type="submit">Update</button>
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
