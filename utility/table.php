<?php
// Every table must be contained within a class called tableContainer
// This class allows can handle the layout of all the tables that are within it

// The size parameter accepts 3 arguments:
// 1. extraLargeBox
// 2. largeBox
// 3. smallBox
function addTable($columnNames, $attributes, $query, $title, $size, $openLink = null, $addLink = null, $deleteLink = null) {
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
            if($openLink != null) {
                echo '<a id="openButton" href="'.$openLink.'">Open</a>';
            }
            if($addLink != null) {
                echo '<a id="addButton" href="'.$addLink.'">Add</a>';
            }
            if($deleteLink != null) {
                echo '<a id="deleteButton" href="'.$addLink.'">Add</a>';
            }
        echo'
        </div>
        <div class="content">';
                renderTable(columnNames: $columnNames, attributes: $attributes, query: $query);
        echo '
        </div>
    </div>';
}

function renderTable($columnNames, $attributes, $query) {
    // Display the table headings
    echo '
    <form method="post" action="'.$_SERVER["PHP_SELF"].'" class="table">
        <div class="header">';
            for($i = 0; $i < count($columnNames); $i++) {
                echo "<div>".$columnNames[$i]."</div>";
            }
        echo '</div>';

    $result = handleSelectQuery($query);
    
    // Display the records
    if($result != false) {

        while($fetched = mysqli_fetch_assoc($result)) {
            echo '<div class="record">';
    
                for($x = 0; $x < count($attributes); $x++) {
                    echo '<div>'.$fetched[$attributes[$x]].' </div>';
                }
            echo '</div> ';  
        }
        echo '</form>';
    }
}
?>