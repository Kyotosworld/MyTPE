<?php
        if (isset($_SESSION['form_2']) && ($_SESSION['form_2'])) {
                echo '<form action="model/master.php" method="post">';
                echo '<input name="form" type="hidden" value="form-2.php"/>';

                echo '<h2>Noms des participants du TPE :</h2>';
                for ($i = 1; $i <= $_SESSION['TPE_number_people']; $i++)
                        echo '<label for="a_'.$i.'">Participant n°'.$i.'</label>
                              <input id="a_'.$i.'" name="people_'.$i.'" type="text" value="'.$_SESSION['TPE_people_'.$i].'"/><br />';

                echo '<h2>Nombre de parties de chaque axe du TPE :</h2>';
                for ($i = 1; $i <= $_SESSION['TPE_number_axe']; $i++)
                        echo '<label for="b_'.$i.'">Nombre de partie de l\'axe n°'.$i.'</label>
                              <input id="b_'.$i.'" name="number_part_axe_'.$i.'" type="text" value="'.$_SESSION['TPE_number_part_axe_'.$i].'"/><br />';

                echo '<input type="submit" value="Continuer"/>';
                echo '</form>';
        }
        elseif(isset($_SESSION['form_1']) && ($_SESSION['form_1'])) {
                echo '<form action="model/master.php" method="post">';
                echo '<input name="form" type="hidden" value="form-2.php"/>';

                echo '<h2>Noms des participants du TPE :</h2>';
                for ($i = 1; $i <= $_SESSION['TPE_number_people']; $i++)
                        echo '<label for="a_'.$i.'">Participant n°'.$i.'</label>
                              <input id="a_'.$i.'" name="people_'.$i.'" type="text"/><br />';

                echo '<h2>Nombre de parties de chaque axe du TPE :</h2>';
                for ($i = 1; $i <= $_SESSION['TPE_number_axe']; $i++)
                        echo '<label for="b_'.$i.'">Nombre de partie de l\'axe n°'.$i.'</label>
                              <input id="b_'.$i.'" name="number_part_axe_'.$i.'" type="text"/><br />';

                echo '<input type="submit" value="Continuer"/>';
                echo '</form>';
        }
        else {
                echo '<p style="color: red; font-size: 1.2em">Erreur, veuillez remplir le <a href="creation.php?page=1">formulaire 1</a> avant de continuer</p>
                      <p style="color: red; font-size: 1.2em">Si ce problème persiste, alors <strong>les cookies sont désactivés par votre navigateur.<br />
                      Veuillez les activer pour pouvoir continuer</strong> (nous garantissons que rien excepté les informations nécessaires à la création de votre dossier ne sont stockées au moyen des cookies).</p>';
        }
?>
