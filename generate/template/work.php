<?php

        include('HEAD');

        if(isset($_GET['axe'], $_GET['part'])) {

                $file = file('VOS-FICHIERS-TEXTE/axe'.$_GET['axe'].'-partie'.$_GET['part'].'.txt', FILE_IGNORE_NEW_LINES);

                echo '<p>';
                foreach($file as $line) {
                        if ($line == '')
                                echo '</p><p>';
                        else
                                echo $line.'<br />';
                }
                echo '</p>';
        }

        include('FOOT');
?>
