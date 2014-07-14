<?php
        include ('view/HEAD.html');
        include ('view/NAV.php');
        echo '<section>';


                        /* header de la <section>, qui donne des liens vers toutes les parties du formulaire */
        echo '<header>';
        echo '<ul>';
        if($page == 0)
                echo '<li><a href="creation.php?" style="color:green">Général</a></li>';
        else
                echo '<li><a href="creation.php?">Général</a></li>';
        for ($i = 1; $i <= ($number_pages-1); $i++)
                if(isset($page) && ($page == $i))
                        echo '<li><a href="creation.php?page='.$i.'" style="color:green">Partie '.$i.'</a></li>';
                else
                        echo '<li><a href="creation.php?page='.$i.'">Partie '.$i.'</a></li>';
        if(isset($page) && ($page == $i))
                echo '<li><a href="creation.php?page='.$i.'" style="color:green">Télécharger</a></li>';
        else
                echo '<li><a href="creation.php?page='.$i.'">Télécharger</a></li>';
        echo '</ul>';
        echo '</header>';


                        /* corps de la page */
        echo '<h1>Mon TPE :</h1>';
        if(isset($_SESSION['id']))
                if($page == 0)
                        echo '<h2>Informations sur mon TPE</h2>';
                else
                        include('view/creation/form-'.$page.'.php');
        else
                echo '<p style="color: red; font-size: 1.5em">Veuillez vous connecter pour accéder à ces informations</p>';


        echo '</section>';
        include ('view/FOOT.html');
?>
