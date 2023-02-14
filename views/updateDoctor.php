<?php
$pageTitle = "Update doctor";
require('partials/header.php');
require('partials/navigation.php');

if(isset($_SESSION["username"])) {
    $doctorID = $_GET["ID"];
    $records = handleSelectQuery("SELECT 
                                    employee.employeeID, 
                                    employee.firstName, 
                                    employee.middleName, 
                                    employee.lastName,
                                    employee.contactNumber,
                                    employee.gender,
                                    employee.specialization,
                                    employeeAccount.username,
                                    employeeAccount.password
                                    FROM employeeAccount INNER JOIN employee 
                                    ON employeeAccount.employeeID=employee.employeeID 
                                    AND employeeaccount.accountType = 'doctor' AND employee.employeeID = '$doctorID';");
    if($records) {
        $globalFetch = mysqli_fetch_assoc($records);
    }
?>
    <main class="app-main">
        <div class="heading">
            <h3>Update Doctor</h3>
        </div>
        <div class="container">
            <form action="../controllers/updateDoctorHandler.php?ID=<?php echo $doctorID; ?>"
                  method="POST" autocomplete="off">
                <div id="mainSection">
                    <div class="formSection">
                        <label class="inputLabel" for="usernameTextBox">Username</label>
                        <br>
                        <input type="text" id="usernameTextBox" name="username" value="<?php
                            echo $globalFetch["username"]
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
                            echo $globalFetch["password"]
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
                            echo $globalFetch["firstName"]
                        ?>" required>
                        <br>
                    </div>

                    <div class="formSection">
                        <label class="inputLabel" for="lastNameTextBox" >Middle name</label>
                        <br>
                        <input type="text" id="middleNameTextBox" name="middleName" value="<?php
                            echo $globalFetch["middleName"]
                        ?>">
                        <br>
                    </div>
                    <div class="formSection">
                        <label class="inputLabel" for="lastNameTextBox">Last name</label>
                        <br>
                        <input type="text" id="lastNameTextBox" name="lastName" value="<?php
                            echo $globalFetch["lastName"]
                        ?>" required>
                        <br>
                    </div>
                    <div class="formSection">
                        <label class="inputLabel" for="contactNumberTextBox">Contact number</label>
                        <br>
                        <input type="text" id="contactNumberTextBox" name="contactNumber" value="<?php
                            echo $globalFetch["contactNumber"]
                        ?>" required>
                        <br>
                        <label class="errorMessage" for="contactNumberTextBox"><?php
                            if(isset($_GET["contactNumberError"])) {
                                echo $_GET["contactNumberError"];
                            }
                            ?></label>
                    </div>
                    <div class="radioButtonSection">
                        <label class="inputLabel">Gender</label>
                        <div>
                            <label class="inputLabel" for="maleRadioBtn">Male</label>
                            <?php
                                if($globalFetch["gender"] == "male") {
                                    echo '<input type="radio" value="male" id="maleRadioBtn" name="genderOption" 
                                            checked required>';
                                }
                                else {
                                    echo '<input type="radio" value="male" id="maleRadioBtn" name="genderOption">';
                                }

                                 echo '<label class="inputLabel" for="genderRadioBtn">Female</label>';
                                if($globalFetch["gender"] == "female") {
                                    echo ' <input type="radio" value="female" id="femaleRadioBtn" name="genderOption" 
                                            checked required>';
                                }
                                else {
                                    echo ' <input type="radio" value="female" id="femaleRadioBtn" name="genderOption">';
                                }
                            ?>
                        </div>
                    </div>
                    <div class="formSection">
                        <label class="inputLabel" for="specializationTextBox">Specialization</label>
                        <br>
                        <textarea id="specializationTextBox" name="specialization" column=40 row=5 required><?php
                            echo $globalFetch["specialization"]
                        ?></textarea>
                        <br>
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
