<?php

// The function will return a query that can be used by the
// caller to display the correct records in the table
function addSearchBar($assoc) {
    echo'
        <div id="searchInputPanel">
            <input type="text" id="searchBar" name="searchBar" placeholder="Search for record" required>
            <button type="submit" name="searchButton">Search</button>
        </div>
        <div id="searchOptionPanel">';
            foreach($assoc as $displayText => $value) {
                echo '<div class="optionPanelSection">';
                    echo '<label class="searchPanelInputLabel" for="'.$value.'">'.$displayText.'</label>';
                    echo '<input type="radio" id="'.$value.'" value="'.$value.'" name="searchOption" required>';
                echo '</div>';
            }
        echo '
        </div>
    ';
}

?>