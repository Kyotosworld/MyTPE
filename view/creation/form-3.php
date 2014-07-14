<?php
        echo '<h2>Formulaire Principal : Partie 3</h2>';

        if (isset($_SESSION['form_3']) && ($_SESSION['form_3'])) {
                echo '<form action="master.php" method="post">';
                echo '<input name="form" type="hidden" value="form-3.php"/>';

                for ($i = 1; $i <= $_SESSION['TPE_number_axe']; $i++)
                        for ($j = 0; $j <= $_SESSION['TPE_number_part_axe_'.$i]; $j++)
                                if ($j == 0)
                echo '<input name="title_'.$i.'-'.$j.'" type="text" placeholder="Titre de l\'axe '.$i.'" value="'.$_SESSION['TPE_title_'.$i.'-'.$j].'"/>';
                                else
                echo '<input name="title_'.$i.'-'.$j.'" type="text" placeholder="Titre n°'.$i.'-'.$j.'" value="'.$_SESSION['TPE_title_'.$i.'-'.$j].'"/>';

                echo '<input type="submit" value="Continuer"/>';
                echo '</form>';
        }
        elseif(isset($_SESSION['form_2']) && ($_SESSION['form_2'])) {
                echo '<form action="master.php" method="post">';
                echo '<input name="form" type="hidden" value="form-3.php"/>';

                for ($i = 1; $i <= $_SESSION['TPE_number_axe']; $i++)
                        for ($j = 0; $j <= $_SESSION['TPE_number_part_axe_'.$i]; $j++) {
                                if ($j == 0)
                        echo '<input name="title_'.$i.'-'.$j.'" type="text" placeholder="Titre de l\'axe '.$i.'" value="TITRE-N°'.$i.'-'.$j.'"/>';
                                else
                        echo '<input name="title_'.$i.'-'.$j.'" type="text" placeholder="Titre n°'.$i.'-'.$j.'" value="TITRE-N°'.$i.'-'.$j.'"/>';
                        }

                echo '<input type="submit" value="Continuer"/>';
                echo '</form>';
        }
        else {
                echo '<p style="color: red; font-size: 1.2em">Erreur, veuillez remplir le <a href="creation.php?page=2">formulaire 2</a> avant de continuer</p>
                      <p style="color: red; font-size: 1.2em">Si ce problème persiste, alors <strong>les cookies sont désactivés par votre navigateur.<br />
                      Veuillez les activer pour pouvoir continuer</strong> (nous garantissons qu\'aucune information personnelle n\'est stockée par notre site au moyen des cookies).</p>';
        }
?>
