<?php
// Every table must be contained within a class called tableContainer
// This class allows can handle the layout of all the tables that are within it

// The size parameter accepts 3 arguments:
// 1. extraLargeBox
// 2. largeBox
// 3. smallBox
function addTable($columnNames, $attributes, $query, $title, $size, $openItemPage = false, $addItemPage = false,
                  $deleteLink = null, $updateLink = null, $viewLink = null, $manageLink = null) {
    //
    // Determine the size of the table's container
    //
    if($size == "extraLargeBox") {
        echo '<div class="informationBoxItemExtraLargeBox">';
    }
    else if($size == "largeBox") {
        echo '<div class="informationBoxItemlargeBox">';
    }
    else {
        echo '<div class="informationBoxItemSmallBox">';
    }

    echo'<div class="titleSection">
            <h3>'.$title.'</h3>';
            if($openItemPage) {
                echo '<a id="tableOpenButton" href="'.$openItemPage.'">Open</a>';
            }
            if($addItemPage) {
                echo '<a id="tableAddButton" href="'.$addItemPage.'">Add</a>';
            }
        echo'
        </div>
        <div class="content">';
                renderTable(columnNames: $columnNames, attributes: $attributes, query: $query, deleteLink: $deleteLink,
                    updateLink: $updateLink, viewLink: $viewLink, manageLink: $manageLink);
        echo '
        </div>
    </div>';
}
//
//function renderTable($columnNames, $attributes, $query, $deleteLink = false, $updateLink = false, $viewLink = false) {
//    // Display the table headings
//    echo '
//    <form method="post" action="'.$_SERVER["PHP_SELF"].'" class="table">
//        <div class="header">';
//            for($i = 0; $i < count($columnNames); $i++) {
//                echo "<div>".$columnNames[$i]."</div>";
//            }
//            if($deleteLink) {
//                echo '<div>Delete</div>';
//            }
//            if($updateLink) {
//                echo '<div>Update</div>';
//            }
//            if($viewLink) {
//                echo '<div>View</div>';
//            }
//        echo '</div>';
//
//    $result = handleSelectQuery($query);
//
//    // Display the records
//    if($result != false) {
//        while($fetched = mysqli_fetch_assoc($result)) {
//            echo '<div class="record">';
//
//                for($x = 0; $x < count($attributes); $x++) {
//                    echo '<div>'.$fetched[$attributes[$x]].' </div>';
//                }
//                if($deleteLink) {
//                    echo '<div><button id="tableDeleteButton" name="deleteButton" value="' .$fetched[$attributes[0]].'" type="submit"">Delete</button></div>';
//                }
//                if($updateLink) {
//                    echo '<div><button id="tableUpdateButton" name="updateButton" value="' .$fetched[$attributes[0]].'" type="submit"">Update</button></div>';
//                }
//                if($viewLink) {
//                    echo '<div><button id="tableViewButton" name="viewButton" value="'.$fetched[$attributes[0]].'" type="submit"">View</button></div>';
//                }
//            echo '</div> ';
//        }
//        echo '</form>';
//    }
//}
function renderTable($columnNames, $attributes, $query, $deleteLink = null, $updateLink = null, $viewLink = null, $manageLink = null) {
    //
    // Display the table headings
    //
    echo '
    <form method="post" action="'.$_SERVER["PHP_SELF"].'" class="table">
        <div class="header">';
            for($i = 0; $i < count($columnNames); $i++) {
                echo "<div>".$columnNames[$i]."</div>";
            }
            if($deleteLink != null) {
                echo '<div>Delete</div>';
            }
            if($updateLink != null) {
                echo '<div>Update</div>';
            }
            if($viewLink != null) {
                echo '<div>View</div>';
            }
            if($manageLink != null) {
                echo '<div>Manage</div>';
            }
        echo '</div>';

    $result = handleSelectQuery($query);
    //
    // Display the records
    //
    if($result) {
        while($fetched = mysqli_fetch_assoc($result)) {
            echo '<div class="record">';
                for($x = 0; $x < count($attributes); $x++) {
                    echo '<div>'.$fetched[$attributes[$x]].' </div>';
                }
                if($deleteLink != null) {
                    echo '<div><a id="tableDeleteButton" href="'.$deleteLink.'?ID='.$fetched[$attributes[0]].'">Delete</a></div>';
                }
                if($updateLink != null) {
                    echo '<div><a id="tableUpdateButton" href="'.$updateLink.'?ID='.$fetched[$attributes[0]].'">Update</a></div>';
                }
                if($viewLink != null) {
                    echo '<div><a id="tableViewButton" href="'.$viewLink.'?ID='.$fetched[$attributes[0]].'">View</a></div>';
                }
                if($manageLink != null) {
                    echo '<div><a id="tableManageButton" href="'.$manageLink.'?ID='.$fetched[$attributes[0]].'">Manage</a></div>';
                }
            echo '</div> ';
        }
        echo '</form>';
    }
}
?>