<?php
        include ('view/HEAD.html');
        include ('view/NAV.php');

//                      section, corps de la page
        echo '<section>';

        if(isset($_SESSION['id'])) {
                echo '<h1>Mon TPE :</h1>';



        } else {
                echo '<h1>Mon TPE :</h1>';
                echo '<p style="color: red; font-size: 1.5em">Veuillez vous connecter pour accéder à ces informations</p>';
        }
        echo '</section>';

        include ('view/FOOT.html');
?>
