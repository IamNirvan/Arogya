<?php

function addInformationPanel($assoc, $updateBtn = false, $deleteBtn = false) {
    echo '    
    <div id="informationPanel">
        <div class="section">';
        foreach($assoc as $key => $value) {
            echo '<div class="box">';
            echo '<p class="label">'.$key.'</p>';
            echo '<p class="value">'.$value.'</p>';
            echo '</div>';
        }
    echo '
        </div>
        <div class="section">';
            if($updateBtn) {
                echo '<button id="infoUpdateButton" name="updateButton" value="update" type="submit">
                    Update</button>';
            }
            if($deleteBtn) {
                echo '<button id="infoDeleteButton" name="deleteButton" value="delete" type="submit">
                    Delete</button>';
            }
    echo'        
        </div>
    </div>
    ';
}
?>