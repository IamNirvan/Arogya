<?php
// Every card must be contained within a clss called cardContainer
// This class allows can handle the layout of all the cards that are within it
function addCard($heading, $data, $imageSrc = null) {
    echo '
    <div class="cardItem">
        <div class="cardItemContainer">
            <div class="boxHeading">
                <p>'.$heading.'</p>
            </div>    
            <div class="value">
                '.$data.'
            </div>    
        </div>';

        if($imageSrc == null) {
            echo '
            <div class="cardItemImageContainer">
            </div>';
        }
        else {
            echo '
            <div class="cardItemImageContainer">
                <img src="'.$imageSrc.'" alt="image">
            </div>';
        }
    echo '</div>';
}
?>

