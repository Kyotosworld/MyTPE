<?php
        session_start();
        include('HEAD.html');
        echo '<section>';

        echo '<h2>Formulaire Principal : Partie 3</h2>';


//      Formulaire

        if (isset($_SESSION['form_3']) && $_SESSION['form_3'] == true) {
                echo '<form action="execute.php" method="post">';
                echo '<input name="form" type="hidden" value="form-3.php"/>';

                for ($i = 1; $i <= $_SESSION['TPE_number_axe']; $i++)
                        for ($j = 0; $j <= $_SESSION['TPE_number_part_axe_'.$i]; $j++)
                                echo '<input name="title_'.$i.'-'.$j.'" type="text" placeholder="Titre n°'.$i.'-'.$j.'" value="'.$_SESSION['TPE_title_'.$i.'-'.$j].'"/>';

                echo '<input type="submit" value="Continuer"/>';
                echo '</form>';
        }
        elseif(isset($_SESSION['TPE_number_axe'])) {
                $axe = 'form-3.php : missing axes = ';

                for ($i = 1; $i <= $_SESSION['TPE_number_axe']; $i++)
                        if (!(isset($_SESSION['TPE_number_part_axe_'.$i])))
                                $axe = $axe.'missing n° '.$i.'; ';

                if ($axe == 'form-3.php : missing axes = ') {
                        echo '<form action="execute.php" method="post">';
                        echo '<input name="form" type="hidden" value="form-3.php"/>';

                        for ($i = 1; $i <= $_SESSION['TPE_number_axe']; $i++)
                                for ($j = 0; $j <= $_SESSION['TPE_number_part_axe_'.$i]; $j++) {
                                        if ($j == 0)
                                                echo '<input name="title_'.$i.'-'.$j.'" type="text" placeholder="Titre de l\'axe '.$i.'"/>';
                                        else
                                                echo '<input name="title_'.$i.'-'.$j.'" type="text" placeholder="Titre n°'.$i.'-'.$j.'"/>';
                                }

                        echo '<input type="submit" value="Continuer"/>';
                        echo '</form>';
                }
        }
        else {
                echo '<p style="color: red; font-size: 1.2em">Erreur, veuillez remplir le <a href="form-2.php">formulaire 2</a> avant de continuer</p>
                      <p style="color: red; font-size: 1.2em">Si ce problème persiste, alors <strong>les cookies sont désactivés par votre navigateur.<br />
                      Veuillez les activer pour pouvoir continuer</strong> (nous garantissons qu\'aucune information personnelle n\'est stockée par notre site au moyen des cookies).</p>';
        }


        echo'</section>';
        include('FOOT.html');
?>
