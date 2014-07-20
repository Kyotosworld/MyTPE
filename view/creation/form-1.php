<?php
        echo '<h2>Informations de base :</h2>';

        if (isset($_SESSION['form_1']) && $_SESSION['form_1'] == true) {
                echo '<form action="model/master.php" method="post">';
                echo '<input name="form" type="hidden" value="form-1.php"/>';
                echo '<label for="a">Nom d\'utilisateur :</label>
                      <input name="username" type="text" size="15" id="a" value="'.$_SESSION['TPE_username'].'"/><br />';
                echo '<label for="b">Adresse du site :</label>
                      <input name="address" type="text" size="15" id="b" value="'.$_SESSION['TPE_address'].'"/><br />';
                echo '<label for="c">Titre des travaux :</label>
                      <input name="title" type="text" size="15" id="c" value="'.$_SESSION['TPE_title'].'"/><br />';
                echo '<label for="d">Extension, titre secondaire :</label>
                      <input name="title_extended" type="text" size="40" id="d" value="'.$_SESSION['TPE_title_extended'].'"/><br />';
                echo '<label for="e">Classe :</label>
                      <input name="class" type="text" size="10" id="e" value="'.$_SESSION['TPE_class'].'"/><br />';
                echo '<label for="f">Matières concernées :</label>
                      <input name="subject" type="text" size="40" id="f" value="'.$_SESSION['TPE_subject'].'"/><br />';
                echo '<label for="g">Nombre de personnes :</label>
                      <input name="number_people" type="text" id="g" value="'.$_SESSION['TPE_number_people'].'"/><br />';

                echo '<h2>Structure du TPE (seul ce qui est coché sera créé) :</h2>';
                if($_SESSION['TPE_structure_intro'] == 1)
                        echo '<input type="checkbox" name="structure_intro" id="h" checked /><label for="h">Introduction</label><br />';
                else    echo '<input type="checkbox" name="structure_intro" id="h" /><label for="h">Introduction</label><br />';
                echo '<label for="i">Nombre d\'axes d\'étude :</label>
                      <input name="structure_axe" type="text" id="i" value="'.$_SESSION['TPE_structure_axe'].'"/><br />';
                if($_SESSION['TPE_structure_conclu'] == 1)
                        echo '<input type="checkbox" name="structure_conclu" id="j" checked /><label for="j">Conclusion</label><br />';
                else    echo '<input type="checkbox" name="structure_conclu" id="j" /><label for="j">Conclusion</label><br />';
                if($_SESSION['TPE_structure_synth'] == 1)
                        echo '<input type="checkbox" name="structure_synth" id="k" checked /><label for="k">Fiches de synthèse</label><br />';
                else    echo '<input type="checkbox" name="structure_synth" id="k" /><label for="k">Fiches de synthèse</label><br />';

                echo '<input type="submit" value="Continuer"/>';
                echo '</form>';
        }
        else {
?>
                <form action="model/master.php" method="post">
                        <input name="form" type="hidden" value="form-1.php"/>

                        <label for="a">Nom d'utilisateur :</label>             <input name="username" type="text" size="15" id="a"/><br />
                        <label for="b">Adresse du site :</label>                <input name="address" type="text" size="15" id="b"/><br />
                        <label for="c">Titre des travaux :</label>              <input name="title" type="text" size="15" id="c"/><br />
                        <label for="d">Extension, titre secondaire :</label>    <input name="title_extended" type="text" size="40" id="d"/><br />
                        <label for="e">Classe :</label>                         <input name="class" type="text" size="10" id="e"/><br />
                        <label for="f">Matières concernées :</label>            <input name="subject" type="text" size="40" id="f"/><br />
                        <label for="g">Nombre de personnes :</label>            <input name="number_people" type="text" id="g"/><br />

                        <h2>Structure du TPE (seul ce qui est coché sera créé) :</h2>
                        <input type="checkbox" name="structure_intro" id="h" checked /><label for="h">Introduction</label><br />
                        <label for="i">Nombre d'axes d'étude :</label> <input name="structure_axe" type="text" id="i"/><br />
                        <input type="checkbox" name="structure_conclu" id="j" checked /><label for="j">Conclusion</label><br />
                        <input type="checkbox" name="structure_synth" id="k" checked /><label for="k">Fiches de synthèse</label><br />

                        <input type="submit" value="Continuer"/>
                </form>
<?php
        }
?>
