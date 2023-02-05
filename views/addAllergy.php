<?php
$pageTitle = "Add allergy";
require('partials/header.php');
require('partials/navigation.php');

if(isset($_SESSION["username"])) {
?>
    <main class="app-main">
        <div class="container">
            <div class="heading">
                <h3>Add Allergy</h3>
            </div>
            <form action="../controllers/addAllergyHandler.php" method="POST" autocomplete="off">
                <div id="mainSection">
                    <div class="formSection">
                        <label class="inputLabel" for="allergyTextBox">Allergy</label>
                        <br>
                        <input type="text" id="allergyTextBox" name="allergyName" required>
                        <br>
                        <label class="errorMessage" for="allergyTextBox"><?php
                            if(isset($_GET["allergyNameError"])) {
                                echo $_GET["allergyNameError"];
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
