<?php
        if (isset($_SESSION['form_3']) && ($_SESSION['form_3'])) {
                echo '<form action="model/master.php" method="post">';
                echo '<input name="form" type="hidden" value="form-3.php"/>';

                echo '<h2>Titres des différentes parties du TPE</h2>';
                for ($i = 1; $i <= $_SESSION['TPE_number_axe']; $i++)
                        for ($j = 0; $j <= $_SESSION['TPE_number_part_axe_'.$i]; $j++) {
                                if ($j == 0) {
                                echo '<h2 style="color: teal;margin-bottom: 5px;">Axe '.$i.'</h2>';
                                echo '<label for="a_'.$i.'_'.$j.'">Titre de l\'axe '.$i.'</label>
                                <input name="title_'.$i.'-'.$j.'" id="a_'.$i.'_'.$j.'" type="text" value="'.$_SESSION['TPE_title_'.$i.'-'.$j].'"/><br />';
                                }
                                else
                                echo '<label for="a_'.$i.'_'.$j.'">Titre de la partie '.$j.'</label>
                                <input name="title_'.$i.'-'.$j.'" id="a_'.$i.'_'.$j.'" type="text" value="'.$_SESSION['TPE_title_'.$i.'-'.$j].'"/><br />';
                        }

                echo '<input type="submit" value="Continuer"/>';
                echo '</form>';
        }
        elseif(isset($_SESSION['form_2']) && ($_SESSION['form_2'])) {
                echo '<form action="model/master.php" method="post">';
                echo '<input name="form" type="hidden" value="form-3.php"/>';

                echo '<h2>Titres des différentes parties du TPE</h2>';
                for ($i = 1; $i <= $_SESSION['TPE_number_axe']; $i++)
                        for ($j = 0; $j <= $_SESSION['TPE_number_part_axe_'.$i]; $j++) {
                                if ($j == 0) {
                                echo '<h2 style="color: teal;margin-bottom: 5px;">Axe '.$i.'</h2>';
                                echo '<label for="a_'.$i.'_'.$j.'">Titre de l\'axe '.$i.'</label>
                                <input name="title_'.$i.'-'.$j.'" id="a_'.$i.'_'.$j.'" type="text" value="DEBUG : A'.$i.' P'.$j.'"/><br />';
                                }
                                else
                                echo '<label for="a_'.$i.'_'.$j.'">Titre de la partie '.$j.'</label>
                                <input name="title_'.$i.'-'.$j.'" id="a_'.$i.'_'.$j.'" type="text" value="DEBUG : A'.$i.' P'.$j.'"/><br />';
                        }

                echo '<input type="submit" value="Continuer"/>';
                echo '</form>';
        }
        else {
                echo '<p style="color: red; font-size: 1.2em">Erreur, veuillez remplir le <a href="creation.php?page=2">formulaire 2</a> avant de continuer</p>
                      <p style="color: red; font-size: 1.2em">Si ce problème persiste, alors <strong>les cookies sont désactivés par votre navigateur.<br />
                      Veuillez les activer pour pouvoir continuer</strong> (nous garantissons que rien excepté les informations nécessaires à la création de votre dossier ne sont stockées au moyen des cookies).</p>';
        }
?>
