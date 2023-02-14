<?php
    $pageTitle = "Invoice";
    require ("partials/header.php");
    require ("partials/navigation.php");

    if(!isset($_SESSION["username"])) {
        header("location: login.php");
    }

    if(isset($_GET["ID"])) {
        $prices = null;
        $quantities = null;
        $appointmentID = $_GET["ID"];

        $patientIDQuery = "SELECT patientID FROM appointment WHERE appointmentID = '$appointmentID';";
        $patientID = mysqli_fetch_assoc(handleSelectQuery($patientIDQuery))["patientID"];

        $patientDetailsQuery = "SELECT * FROM patient WHERE patientID = '$patientID'";
        $patientDetails = mysqli_fetch_assoc(handleSelectQuery($patientDetailsQuery));

        $usedResourcesQuery = "SELECT resourceID, quantity from usedResources WHERE appointmentID = '$appointmentID'";
        $usedResources = handleSelectQuery($usedResourcesQuery);

        $i = 0;
        while($fetchedUsedResources = mysqli_fetch_assoc($usedResources)) {
            $quantities[$i] = $fetchedUsedResources["quantity"];
            $i += 1;
        }
    }
    else {
        die();
    }
?>

<main class="app-main">
    <div class="invoice-box">
        <table cellpadding="0" cellspacing="0">
            <tr class="top">
                <td colspan="2">
                    <table>
                        <tr>
                            <td class="title">
                                <img src="images/icons/logo2v2.png" style="width: 100%; max-width: 300px" />
                            </td>
                        </tr>
                    </table>
                </td>
            </tr>
            <tr class="information">
                <td colspan="2">
                    <table>
                        <tr>
                            <td>
                                Arogya Health Care<br />
                                3 Alfred Pl,<br />
                                Colombo 00300
                            </td>
                            <td>
                                <?php echo $patientDetails["firstName"].' '.$patientDetails["lastName"] ?><br />
                                <?php echo $patientDetails["contactNumber"]?><br />
                                <?php echo $patientDetails["address"] ?><br />
                            </td>
                        </tr>
                    </table>
                </td>
            </tr>
            <tr class="heading">
                <td>Item</td>
                <td>Unit price</td>
            </tr>

            <?php
                $usedResources = handleSelectQuery($usedResourcesQuery);

                $i = 0;
                while($fetched = mysqli_fetch_assoc($usedResources)) {
                    $resourceID = $fetched["resourceID"];

                    $resourceNameQuery = "SELECT resourceName, unitPrice FROM resources WHERE resourceID = '$resourceID'";
                    $fetchedResources = mysqli_fetch_assoc(handleSelectQuery($resourceNameQuery));

                    $resourceName = $fetchedResources["resourceName"];
                    $resourcePrice = $fetchedResources["unitPrice"];
                    $prices[$i] = $resourcePrice;


                    echo '
                        <tr class="item">
                            <td>'.$resourceName.' x '.$quantities[$i].'</td>
                            <td>'.$resourcePrice.'</td>
                        </tr>
                    ';

                $i += 1;
                }
            ?>
            <tr class="total">
                <td></td>
                <td><?php
                        $total = 0;
                        for($i = 0; $i < count($quantities); $i++) {
                            $total += ($quantities[$i] * $prices[$i]);
                        }
                        echo 'Total: Rs. '.$total;
                ?></td>
            </tr>
        </table>
    </div>
</main>