<?php
        include ('view/HEAD.html');
        include ('view/NAV.php');

//                      section, corps de la page
        echo '<section>';
        echo '<h1>TODO :</h1>';
        echo '<p>';
        echo '* Créer classe .error et .success avec texte en rouge et en vert<br />';
        echo '* Refaire toutes les règles des feuilles de style avec des id<br />';
        echo '* Permettre le choix de mettre ou non une intro avec une checkbox qui pourrait affecter "unset" à [title_2-0] si elle est décochée<br />';
        echo '* Refaire remplissage automatique des champs car lors de la création de champs, un nombre entre en conflit avec celui d\'avant (form-3 line 18)';
        echo '</p>';
        echo '</section>';

        include ('view/FOOT.html');
?>
