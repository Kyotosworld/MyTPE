<?php
        session_start();
        include('HEAD.html');
        echo '<section>';

        if(isset($_GET['user'])) {
                echo '<h2>Félicitations !!</h2>';
                echo '<p>Votre site a été créé avec succès :) ,<br />';
                echo 'Vous pouvez dès à présent télécharger le fichier zip qui contient tous les fichiers de votre TPE.</p>';
                echo '<a href="user/'.$_GET['user'].'-website.zip">Télécharger</a>';
        }
        else {
                echo '<h2>Nous sommes désolés :(</h2>';
                echo '<p>Le fichier n\'a apparemment pas été créé...';
                echo 'Veuillez <a href="index.php">réessayer</a>.</p>';
        }

        echo '</section>';
        include('FOOT.html');
?>
