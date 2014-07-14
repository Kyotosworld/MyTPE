<?php

        echo '<h2>Formulaire Principal - Partie 2</h2>';

        if (isset($_SESSION['form_2']) && ($_SESSION['form_2'])) {
                echo '<form action="master.php" method="post">';
                echo '<input name="form" type="hidden" value="form-2.php"/>';

                for ($i = 1; $i <= $_SESSION['TPE_number_people']; $i++)
                        echo '<input name="people_'.$i.'" type="text" placeholder="Personne n°'.$i.'" value="'.$_SESSION['TPE_people_'.$i].'"/>';

                for ($i = 1; $i <= $_SESSION['TPE_number_axe']; $i++)
                        echo '<input name="number_part_axe_'.$i.'" type="text" placeholder="Nombre de partie de l\'axe n°'.$i.'" value="'.$_SESSION['TPE_number_part_axe_'.$i].'"/>';

                echo '<input type="submit" value="Continuer"/>';
                echo '</form>';
        }
        elseif(isset($_SESSION['form_1']) && ($_SESSION['form_1'])) {
                echo '<form action="master.php" method="post">';
                echo '<input name="form" type="hidden" value="form-2.php"/>';

                echo '<h3>Noms des participants du TPE :</h3>';
                for ($i = 1; $i <= $_SESSION['TPE_number_people']; $i++)
                        echo '<input name="people_'.$i.'" type="text" placeholder="Personne n°'.$i.'"/>';

                echo '<h3>Nombre de parties de chaque axe du TPE :</h3>';
                for ($i = 1; $i <= $_SESSION['TPE_number_axe']; $i++)
                        echo '<input name="number_part_axe_'.$i.'" type="text" placeholder="Nombre de partie de l\'axe n°'.$i.'"/>';

                echo '<input type="submit" value="Continuer"/>';
                echo '</form>';
        }
        else {
                echo '<p style="color: red; font-size: 1.2em">Erreur, veuillez remplir le <a href="creation.php?page=1">formulaire 1</a> avant de continuer</p>
                      <p style="color: red; font-size: 1.2em">Si ce problème persiste, alors <strong>les cookies sont désactivés par votre navigateur.<br />
                      Veuillez les activer pour pouvoir continuer</strong> (nous garantissons qu\'aucune information personnelle n\'est stockée par notre site au moyen des cookies).</p>';
        }
?>
