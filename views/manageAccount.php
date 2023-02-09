<?php
$pageTitle = "Manage doctors";

require('partials/header.php');
require('partials/navigation.php');
require('../utility/table.php');
require('../utility/searchPanel.php');
require('../utility/informationPanel.php');

if(isset($_SESSION["username"])) {
    $patientID = $_SESSION["ID"];
    $patientDetails = handleSelectQuery("SELECT * FROM patient WHERE patientID = '$patientID';");
    $accountDetails = handleSelectQuery("SELECT * FROM patientaccount WHERE patientID = '$patientID';");

    if($patientDetails) {
        $globalFetchPatient = mysqli_fetch_assoc($patientDetails);
    }

    if($accountDetails) {
        $globalFetchAccount = mysqli_fetch_assoc($accountDetails);
    }

    if(isset($_GET["error"])) {
        echo '<script>alert("'.$_GET["error"].'")</script>';
    }
?>
<main class="app-main">
    <div class="heading">
        <h3>Update Account Details</h3>
        <form action="deletePatientAccount.php" method="get">
            <button type="submit">Delete</button>
        </form>
    </div>
        <!-- This container is for the form -->
        <div class="container">
            <form action="../controllers/updatePatientHandler.php" method="POST" autocomplete="off">
                <div id="mainSection">
                    <div class="formSection">
                        <label class="inputLabel" for="usernameTextBox">Username</label>
                        <br>
                        <input type="text" id="usernameTextBox" name="username" value="<?php
                                if(isset($globalFetchAccount["username"])) {
                                    echo $globalFetchAccount["username"];
                                }
                            ?>" required>
                        <br>
                        <label class="errorMessage" for="usernameTextBox"><?php
                            if(isset($_GET["usernameError"])) {
                                echo $_GET["usernameError"];
                            }
                            ?></label>
                    </div>
                    <div class="formSection">
                        <label class="inputLabel" for="passwordTextBox">Password</label>
                        <br>
                        <input type="password" id="passwordTextBox" name="password" value="<?php
                        if(isset($globalFetchAccount["password"])) {
                            echo $globalFetchAccount["password"];
                        }
                        ?>" required>
                        <br>
                        <label class="errorMessage" for="passwordTextBox"><?php
                            if(isset($_GET["passwordError"])) {
                                echo $_GET["passwordError"];
                            }
                            ?></label>
                    </div>
                    <div class="formSection">
                        <label class="inputLabel" for="firstNameTextBox">First name</label>
                        <br>
                        <input type="text" id="firstNameTextBox" name="firstName" value="<?php
                        if(isset($globalFetchPatient["firstName"])) {
                            echo $globalFetchPatient["firstName"];
                        }
                        ?>" required>
                        <br>
                        <label class="errorMessage" for="firstNameTextBox"><?php
                            if(isset($_GET["firstNameError"])) {
                                echo $_GET["firstNameError"];
                            }
                            ?></label>
                    </div>
                    <div class="formSection">
                        <label class="inputLabel" for="middleNameTextBox">Middle name</label>
                        <br>
                        <input type="text" id="middleNameTextBox" name="middleName" value="<?php
                        if(isset($globalFetchPatient["middleName"])) {
                            echo $globalFetchPatient["middleName"];
                        }
                        ?>">
                        <br>
                        <label class="errorMessage" for="middleNameTextBox"><?php
                            if(isset($_GET["middleNameError"])) {
                                echo $_GET["middleNameError"];
                            }
                            ?></label>
                    </div>
                    <div class="formSection">
                        <label class="inputLabel" for="lastNameTextBox">Last name</label>
                        <br>
                        <input type="text" id="lastNameTextBox" name="lastName" value="<?php
                        if(isset($globalFetchPatient["lastName"])) {
                            echo $globalFetchPatient["lastName"];
                        }
                        ?>" required>
                        <br>
                        <label class="errorMessage" for="lastNameTextBox"><?php
                            if(isset($_GET["lastNameError"])) {
                                echo $_GET["lastNameError"];
                            }
                            ?></label>
                    </div>
                    <div class="radioButtonSection">
                        <label class="inputLabel">Gender</label>
                        <div>
                            <label class="inputLabel" for="maleRadioBtn">Male</label>
                            <?php
                                if(isset($globalFetchPatient["gender"])) {
                                    if ($globalFetchPatient["gender"] == "male") {
                                        echo '<input type="radio" value="male" id="maleRadioBtn" name="genderOption" checked required>';
                                    }
                                    else {
                                        echo '<input type="radio" value="male" id="maleRadioBtn" name="genderOption">';
                                    }
                                }
                            ?>
                            <label class="inputLabel" for="doctorRadioBtn">Female</label>
                            <?php
                                if(isset($globalFetchPatient["gender"])) {
                                    if($globalFetchPatient["gender"] == "female") {
                                        echo '<input type="radio" value="female" id="femaleRadioBtn" name="genderOption" checked required>';
                                    }
                                    else {
                                        echo '<input type="radio" value="female" id="femaleRadioBtn" name="genderOption">';
                                    }
                                }
                            ?>
                        </div>
                    </div>
                    <div class="formSection">
                        <label class="inputLabel" for="NICTextBox">NIC</label>
                        <br>
                        <input type="text" id="NICTextBox" name="NIC" value="<?php
                        if(isset($globalFetchPatient["patientNIC"])) {
                            echo $globalFetchPatient["patientNIC"];
                        }
                        ?>" required>
                        <br>
                        <label class="errorMessage" for="NICTextBox"><?php
                            if(isset($_GET["NICError"])) {
                                echo $_GET["NICError"];
                            } else {
                                echo " ";
                            }
                            ?></label>
                    </div>
                    <div class="formSection">
                        <label class="inputLabel" for="nationalityextBox">Nationality</label>
                        <br>
                        <input type="text" id="nationalityTextBox" name="nationality" value="<?php
                        if(isset($globalFetchPatient["nationality"])) {
                            echo $globalFetchPatient["nationality"];
                        }
                        ?>" required>
                        <br>
                        <label class="errorMessage" for="nationalityTextBox"><?php
                            if(isset($_GET["nationalityError"])) {
                                echo $_GET["nationalityError"];
                            }
                            ?></label>
                    </div>
                    <div class="formSection">
                        <label class="inputLabel" for="contactNumberTextBox">Contact number</label>
                        <br>
                        <input type="text" id="contactNumberTextBox" name="contactNumber" value="<?php
                        if(isset($globalFetchPatient["contactNumber"])) {
                            echo $globalFetchPatient["contactNumber"];
                        }
                        ?>" required>
                        <br>
                        <label class="errorMessage" for="contactNumberTextBox"><?php
                            if(isset($_GET["contactNumberError"])) {
                                echo $_GET["contactNumberError"];
                            }
                            ?></label>
                    </div>
                    <div class="formSection">
                        <label class="inputLabel" for="addressTextBox">Address</label>
                        <br>
                        <textarea id="addressTextBox" name="address" column=40 row=5 required><?php
                            if(isset($globalFetchPatient["address"])) {
                                echo $globalFetchPatient["address"];
                            }
                            ?></textarea>
                        <br>
                        <label class="errorMessage" for="addressTextBox"><?php
                            if(isset($_GET["addressError"])) {
                                echo $_GET["addressError"];
                            }
                            ?></label>
                    </div>
                </div>
                <div class="buttonSection">
                    <button type="submit" name="updateButton">Update</button>
                </div>
            </form>
        </div>
</main>
<?php
}
else {
    header("Location: login.php");
}
?><?php
