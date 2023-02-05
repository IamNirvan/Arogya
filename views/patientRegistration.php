<?php 
$pageTitle = "Registration";
require('partials/header.php'); 
?>
    <!-- This container is for the background color and text -->
    <div class="container">
        <div>
            <p>Arogya HMS</p>
        </div>
        <div>
            <h1>Appointment<br>management<br>made easy</h1>
        </div>
    </div>
    <!-- This container is for the form -->
    <div class="container">
        <form action="../controllers/patientRegistrationHandler.php" method="POST" autocomplete="off">
            <div id="mainSection">
                <div class="formSection">
                    <label class="inputLabel" for="usernameTextBox">Username</label>
                    <br>
                    <input type="text" id="usernameTextBox" name="username" required>
                    <br>
                    <label class="errorMessage" for="usernameTextBox"><?php
                        if(isset($_GET["usernameError"])) {
                            echo $_GET["usernameError"];
                        }
                ?></label>
                </div>
                <div class="formSection">
                    <label class="inputLabel" for="lastNameTextBox">Last name</label>
                    <br>
                    <input type="text" id="lastNameTextBox" name="lastName" required>
                    <br>
                </div>
                <div class="formSection">
                    <label class="inputLabel" for="passwordTextBox">Password</label>
                    <br>
                    <input type="password" id="passwordTextBox" name="password" required>
                    <br>
                    <label class="errorMessage" for="passwordTextBox"><?php
                        if(isset($_GET["passwordError"])) {
                            echo $_GET["passwordError"];
                        }
                ?></label>
                </div>
                <div class="formSection">
                    <label class="inputLabel">Gender</label>
                    <div>
                        <label class="inputLabel" for="maleRadioBtn">Male</label>
                        <input type="radio" value="male" id="maleRadioBtn" name="genderOption" required>
                        <label class="inputLabel" for="doctorRadioBtn">Female</label>
                        <input type="radio" value="female" id="femaleRadioBtn" name="genderOption">
                    </div>
                </div>
                <div class="formSection">
                    <label class="inputLabel" for="NICTextBox">NIC</label>
                    <br>
                    <input type="text" id="NICTextBox" name="NIC" required>
                    <br>
                    <label class="errorMessage" for="NICTextBox"><?php
                        if(isset($_GET["NICerror"])) {
                            echo $_GET["NICerror"];
                        } else {
                            echo " ";
                        }
                ?></label>
                </div>
                <div class="formSection">
                    <label class="inputLabel" for="nationalityextBox">Nationality</label>
                    <br>
                    <input type="text" id="nationalityTextBox" name="nationality" required>
                    <br>
                    <label class="errorMessage" for="nationalityTextBox"><?php
                        if(isset($_GET["incorrectPassword"])) {
                            echo $_GET["incorrectPassword"];
                        }
                    ?></label>
                </div>
                <div class="formSection">
                    <label class="inputLabel" for="firstNameTextBox">First name</label>
                    <br>
                    <input type="text" id="firstNameTextBox" name="firstName" required>
                    <br>
                </div>
                <div class="formSection">
                    <label class="inputLabel" for="contactNumberTextBox">Contact number</label>
                    <br>
                    <input type="text" id="contactNumberTextBox" name="contactNumber" required>
                    <br>
                    <label class="errorMessage" for="contactNumberTextBox"><?php
                        if(isset($_GET["contactNumberError"])) {
                            echo $_GET["contactNumberError"];
                        }
                    ?></label>
                </div>
                <div class="formSection">
                    <label class="inputLabel" for="middleNameTextBox">Middle name</label>
                    <br>
                    <input type="text" id="middleNameTextBox" name="middleName">
                    <br>
                </div>
                <div class="formSection">
                    <label class="inputLabel" for="addressTextBox">Address</label>
                    <br>
                    <textarea id="addressTextBox" name="address" column=40 row=5 required></textarea>
                    <br>
                </div>
            </div>
            <div class="formSection">
                <button type="submit">Sign up</button>
            </div>
        </form>
    </div>
</body>
</html>