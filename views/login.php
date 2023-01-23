<?php 
$pageTitle = "Login";
require('partials/header.php'); 
?>
    <!-- This container is for the image-->
    <div class="container">
    </div>
    <!-- This container is for the form-->
    <div class="container">
        <div id="heading">
            <h2>Login</h2>
            <p>Select one of the following account options</p>
        </div>
        <form action="../controllers/loginHandler.php" method="POST" autocomplete="off">
            <!-- This is for the account type radio buttons -->
            <div class="formSection">
                <div>
                    <label class="inputLabel" for="patientRadioBtn">Patient</label>
                    <input type="radio" value="patient" id="patientRadioBtn" name="accountOption" required>
                </div>
                <div>
                    <label class="inputLabel" for="doctorRadioBtn">Doctor</label>
                    <input type="radio" value="doctor" id="doctorRadioBtn" name="accountOption">
                </div>
                <div>
                    <label class="inputLabel" for="administratorRadioBtn">Administrator</label>
                    <input type="radio" value="administrator" id="administratorRadioBtn" name="accountOption">
                </div>
                <div>
                    <label class="inputLabel" for="receptionistRadioBtn">Receptionist</label>
                    <input type="radio" value="receptionist" id="receptionistRadioBtn" name="accountOption">
                </div>
            </div>
            <div class="formSection">
                <label class="inputLabel" for="usernameTextBox">Username</label>
                <br>
                <input type="text" id="usernameTextBox" name="username" required>
                <br>
                <label class="errorMessage" for="usernameTextBox"><?php
                    if(isset($_GET["unknownUsername"])) {
                        echo $_GET["unknownUsername"];
                    }
                ?></label>
            </div>
            <div class="formSection">
                <label class="inputLabel" for="passwordTextBox">Password</label>
                <br>
                <input type="password" id="passwordTextBox" name="password" required>
                <br>
                <label class="errorMessage" for="usernameTextBox"><?php
                    if(isset($_GET["incorrectPassword"])) {
                        echo $_GET["incorrectPassword"];
                    }
                ?></label>
            </div>
            <!-- This is for the patient registration link -->
            <div class="formSection">
                Don't have an account? <a href="patientRegistration.php">Register</a>
            </div>
            <div class="formSection">
                <button type="submit">Login</button>
            </div>
        </form>
    </div>
</body>
</html>