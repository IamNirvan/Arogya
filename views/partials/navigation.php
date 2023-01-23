<header>
        <div>
            <div class="header-logo">
                <!-- <img src="images/icons/logo.png" alt="Logo"> -->
            </div>

            <?php 
            $file = explode("?", $_SERVER['REQUEST_URI'])[0];
            $file2 = explode("/", $file);
            $path = $file2[sizeof($file2) - 1];

            if($_SESSION["accountType"] == "patient") {
                echo '
                <nav class="navigation">
                    <ul class="navigation-ul">
                        <li class="navigation-ul-li">
                            <a ';
                            if($path == "dashboard.php") {echo "class=navigation-ul-li-a-active" ; }
                            else {echo "class=navigation-ul-li-a-inactive";};
                            echo'
                            href="dashboard.php">
                                <img src="images/icons/home.png">
                                Home
                            </a>
                        </li>
                        <li class="navigation-ul-li">
                            <a ';
                            if($path == "medicalHistory.php") {echo "class=navigation-ul-li-a-active" ; }
                            else {echo "class=navigation-ul-li-a-inactive";};
                            echo '
                            href="medicalHistory.php">
                                <img src="images/icons/history.png">
                                Medical history
                            </a>
                        </li>
                        <li class="navigation-ul-li">
                            <a ';
                            if($path == "appointment.php") {echo "class=navigation-ul-li-a-active" ; }
                            else {echo "class=navigation-ul-li-a-inactive";};
                            echo'
                            href="appointment.php">
                            <img src="images/icons/appointment.png">
                            Appointments
                        </a>
                        </li>
                    </ul>
                </nav> ';
                }
                else if($_SESSION["accountType"] == "doctor") {
                    echo '
                    <nav class="navigation">
                        <ul class="navigation-ul">
                            <li class="navigation-ul-li">
                                <a ';
                                if($path == "dashboard.php") {echo "class=navigation-ul-li-a-active" ; }
                                else {echo "class=navigation-ul-li-a-inactive";};
                                echo'
                                href="dashboard.php">
                                    <img src="images/icons/home.png">
                                    Home
                                </a>
                            </li>
                            <li class="navigation-ul-li">
                                <a ';
                                if($path == "ORSchedule.php") {echo "class=navigation-ul-li-a-active" ; }
                                else {echo "class=navigation-ul-li-a-inactive";};
                                echo '
                                href="ORSchedule.php">
                                    <img src="images/icons/booking.png">
                                    OR bookings
                                </a>
                            </li>
                            <li class="navigation-ul-li">
                                <a ';
                                if($path == "PatientRoomOccupancy.php") {echo "class=navigation-ul-li-a-active" ; }
                                else {echo "class=navigation-ul-li-a-inactive";};
                                echo '
                                href="PatientRoomOccupancy.php">
                                    <img src="images/icons/booking.png">
                                    Patient room bookings
                                </a>
                            </li>
                            <li class="navigation-ul-li">
                                <a ';
                                if($path == "appointment.php") {echo "class=navigation-ul-li-a-active" ; }
                                else {echo "class=navigation-ul-li-a-inactive";};
                                echo'
                                href="appointment.php">
                                <img src="images/icons/appointment.png">
                                Appointments
                            </a>
                            </li>
                        </ul>
                    </nav> ';
                }
                else if($_SESSION["accountType"] == "receptionist") {
                    echo '
                    <nav class="navigation">
                        <ul class="navigation-ul">
                            <li class="navigation-ul-li">
                                <a ';
                                if($path == "dashboard.php") {echo "class=navigation-ul-li-a-active" ; }
                                else {echo "class=navigation-ul-li-a-inactive";};
                                echo'
                                href="dashboard.php">
                                    <img src="images/icons/home.png">
                                    Home
                                </a>
                            </li>
                            <li class="navigation-ul-li">
                                <a ';
                                if($path == "patients.php") {echo "class=navigation-ul-li-a-active" ; }
                                else {echo "class=navigation-ul-li-a-inactive";};
                                echo '
                                href="patients.php">
                                    <img src="images/icons/patient.png">
                                    Patients
                                </a>
                            </li>
                            <li class="navigation-ul-li">
                                <a ';
                                if($path == "ORSchedule.php") {echo "class=navigation-ul-li-a-active" ; }
                                else {echo "class=navigation-ul-li-a-inactive";};
                                echo '
                                href="ORSchedule.php">
                                    <img src="images/icons/booking.png">
                                    OR bookings
                                </a>
                            </li>
                            <li class="navigation-ul-li">
                                <a ';
                                if($path == "PatientRoomOccupancy.php") {echo "class=navigation-ul-li-a-active" ; }
                                else {echo "class=navigation-ul-li-a-inactive";};
                                echo '
                                href="PatientRoomOccupancy.php">
                                    <img src="images/icons/booking.png">
                                    Patient room bookings
                                </a>
                            </li>
                            <li class="navigation-ul-li">
                                <a ';
                                if($path == "appointment.php") {echo "class=navigation-ul-li-a-active" ; }
                                else {echo "class=navigation-ul-li-a-inactive";};
                                echo'
                                href="appointment.php">
                                <img src="images/icons/appointment.png">
                                Appointments
                            </a>
                            </li>
                        </ul>
                    </nav> ';
                }
                else if($_SESSION["accountType"] == "administrator") {
                    echo '
                    <nav class="navigation">
                        <ul class="navigation-ul">
                            <li class="navigation-ul-li">
                                <a ';
                                if($path == "dashboard.php") {echo "class=navigation-ul-li-a-active" ; }
                                else {echo "class=navigation-ul-li-a-inactive";};
                                echo'
                                href="dashboard.php">
                                    <img src="images/icons/home.png">
                                    Home
                                </a>
                            </li>
                            <li class="navigation-ul-li">
                                <a ';
                                if($path == "medicalHistory.php") {echo "class=navigation-ul-li-a-active" ; }
                                else {echo "class=navigation-ul-li-a-inactive";};
                                echo '
                                href="">
                                    <img src="images/icons/history.png">
                                    Login history
                                </a>
                            </li>
                            
                            <li class="navigation-ul-li">
                                <a ';
                                if($path == "medicalHistory.php") {echo "class=navigation-ul-li-a-active" ; }
                                else {echo "class=navigation-ul-li-a-inactive";};
                                echo '
                                href="">
                                    <img src="images/icons/employees.png">
                                    Manage doctors
                                </a>
                            </li>
                            
                            <li class="navigation-ul-li">
                                <a ';
                                if($path == "medicalHistory.php") {echo "class=navigation-ul-li-a-active" ; }
                                else {echo "class=navigation-ul-li-a-inactive";};
                                echo '
                                href="">
                                    <img src="images/icons/employees.png">
                                    Manage receptionists
                                </a>
                            </li>
                            
                        </ul>
                    </nav> ';


                }



            ?>

            <!-- <nav class="navigation">
                <ul class="navigation-ul">
                    <li class="navigation-ul-li">
                        <a <?php if($path == "dashboard.php") {echo "class=navigation-ul-li-a-active" ; } ?> href="dashboard.php">
                            <img src="images/icons/home.png">
                            Home
                        </a>
                    </li>
                    <li class="navigation-ul-li">
                        <a <?php if($path == "/1_HND/HMS%20version%203/views/patient.php") {echo "class=navigation-ul-li-a-active" ; } ?> href="patient.php">
                            <img src="images/icons/patient.png">
                            Patients
                        </a>
                    </li>
                    <li class="navigation-ul-li">
                        <a <?php if($path == "/1_HND/HMS%20version%203/views/ORBookings.php") {echo "class=navigation-ul-li-a-active" ; } ?> href="ORBookings.php">
                            <img src="images/icons/booking.png">
                            OR Bookings
                        </a>
                    </li>
                    <li class="navigation-ul-li">
                        <a <?php if($path == "appointment.php") {echo "class=navigation-ul-li-a-active" ; } ?> href="appointment.php">
                        <img src="images/icons/appointment.png">
                        Appointments
                    </a>
                    </li>
                </ul>
            </nav> -->
        </div>
        <div class="header-user">
            <div>
                <h3>Hello, </h3>
                <?php 
                    echo $_SESSION["firstName"]." ". $_SESSION["lastName"];
                ?>
            </div>  
            <div>
                <a class="header-user-logout" href="../controllers/logoutHandler.php">Logout</a>
            </div>
        </div>
    </header>
