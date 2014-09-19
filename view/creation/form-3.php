<?php
        if (isset($_SESSION['form_3']) && ($_SESSION['form_3'])) {
                echo '<form action="model/master.php" method="post">';
                echo '<input name="form" type="hidden" value="form-3.php"/>';

                echo '<h2>Titres des différentes parties du TPE</h2>';
                $debut = $_SESSION['TPE_structure_intro'] + 1;
                $fin = $_SESSION['TPE_number_axe'] - $_SESSION['TPE_structure_conclu'] - $_SESSION['TPE_structure_synth'];
                $k = 1;
                if($_SESSION['TPE_structure_intro'] == 1) {
                                echo '<h2 style="color: teal;margin-bottom: 5px;">Introduction</h2>';
                                echo '<label for="a_'.$k.'_0">Titre de l\'introduction (optionnel) : </label>
                                <input name="title_1-0" id="a_'.$k.'_0" type="text" value="'.$_SESSION['TPE_title_1-0'].'"/><br />';
                                $k++;
                }
                for ($i = $debut; $i <= $fin; $i++) {
                        for ($j = 0; $j <= $_SESSION['TPE_number_part_axe_'.$i]; $j++) {
                                if ($j == 0) {
                                echo '<h2 style="color: teal;margin-bottom: 5px;">Axe '.$k.'</h2>';
                                echo '<label for="a_'.$k.'_'.$j.'">Titre de l\'axe '.$k.' : </label>
                                <input name="title_'.$i.'-'.$j.'" id="a_'.$k.'_'.$j.'" type="text" value="'.$_SESSION['TPE_title_'.$i.'-'.$j].'"/><br />';
                                }
                                else
                                echo '<label for="a_'.$k.'_'.$j.'">Titre de la partie '.$j.' : </label>
                                <input name="title_'.$i.'-'.$j.'" id="a_'.$k.'_'.$j.'" type="text" value="'.$_SESSION['TPE_title_'.$i.'-'.$j].'"/><br />';
                        }
                        $k++;
                }
                if(($_SESSION['TPE_structure_conclu']) && ($_SESSION['TPE_structure_synth'])) $l = 1;
                else $l = 0;
                if($_SESSION['TPE_structure_conclu'] == 1) {
                                echo '<h2 style="color: teal;margin-bottom: 5px;">Conclusion</h2>';
                                echo '<label for="a_'.$k.'_0">Titre de la conclusion (optionnel) : </label>
                                <input name="title_'.($_SESSION['TPE_number_axe']-$l).'-0" id="a_'.$k.'_0" type="text" 
                                value="'.$_SESSION['TPE_title_'.($_SESSION['TPE_number_axe']-$l).'-0'].'"  /><br />';
                                $k++;
                }

                echo '<input type="submit" value="Continuer"/>';
                echo '</form>';
        }
        elseif(isset($_SESSION['form_2']) && ($_SESSION['form_2'])) {
                echo '<form action="model/master.php" method="post">';
                echo '<input name="form" type="hidden" value="form-3.php"/>';

                echo '<h2>Titres des différentes parties du TPE</h2>';
                $debut = $_SESSION['TPE_structure_intro'] + 1;
                $fin = $_SESSION['TPE_number_axe'] - $_SESSION['TPE_structure_conclu'] - $_SESSION['TPE_structure_synth'];
                $k = 1;
                if($_SESSION['TPE_structure_intro'] == 1) {
                                echo '<h2 style="color: teal;margin-bottom: 5px;">Introduction</h2>';
                                echo '<label for="a_'.$k.'_0">Titre de l\'introduction (optionnel) : </label>
                                <input name="title_1-0" id="a_'.$k.'_0" type="text" /><br />';
                                $k++;
                }
                for ($i = $debut; $i <= $fin; $i++) {
                        for ($j = 0; $j <= $_SESSION['TPE_number_part_axe_'.$i]; $j++) {
                                if ($j == 0) {
                                echo '<h2 style="color: teal;margin-bottom: 5px;">Axe '.$k.'</h2>';
                                echo '<label for="a_'.$k.'_'.$j.'">Titre de l\'axe '.$k.' : </label>
                                <input name="title_'.$i.'-'.$j.'" id="a_'.$k.'_'.$j.'" type="text" value="DEBUG : A'.$k.' P'.$j.'"/><br />';
                                }
                                else
                                echo '<label for="a_'.$k.'_'.$j.'">Titre de la partie '.$j.' : </label>
                                <input name="title_'.$i.'-'.$j.'" id="a_'.$k.'_'.$j.'" type="text" value="DEBUG : A'.$k.' P'.$j.'"/><br />';
                        }
                        $k++;
                }
                if(($_SESSION['TPE_structure_conclu']) && ($_SESSION['TPE_structure_synth']))
                        $l = 1;
                else
                        $l = 0;
                if($_SESSION['TPE_structure_conclu'] == 1) {
                                echo '<h2 style="color: teal;margin-bottom: 5px;">Conclusion</h2>';
                                echo '<label for="a_'.$k.'_0">Titre de la conclusion (optionnel) : </label>
                                <input name="title_'.($_SESSION['TPE_number_axe']-$l).'-0" id="a_'.$k.'_0" type="text" /><br />';
                                $k++;
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
