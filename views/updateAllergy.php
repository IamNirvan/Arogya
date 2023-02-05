<?php
$pageTitle = "Update allergy";
require('partials/header.php');
require('partials/navigation.php');

if(isset($_SESSION["username"])) {
    $allergyID = $_GET["ID"];
    $records = handleSelectQuery("SELECT * FROM allergies WHERE allergyID = '$allergyID';");
    if($records) {
        $globalFetch = mysqli_fetch_assoc($records);
    }
?>
    <main class="app-main">
        <div class="heading">
            <h3>Update Allergy</h3>
        </div>
        <div class="container">
            <form action="../controllers/updateAllergyHandler.php?ID=<?php echo $allergyID; ?>&allergyName=<?php echo $globalFetch["name"]?>" method="POST" autocomplete="off">
                <div id="mainSection">
                    <div class="formSection">
                        <label class="inputLabel" for="allergyTextBox">Allergy</label>
                        <br>
                        <input type="text" id="allergyTextBox" name="allergyName" value="<?php echo $globalFetch["name"]?>" required>
                        <br>
                        <label class="errorMessage" for="allergyTextBox"><?php
                            if(isset($_GET["allergyNameError"])) {
                                echo $_GET["allergyNameError"];
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
