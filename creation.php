<?php
 
        include('controller/session.php');

        if(isset($_GET['page']) && ($_GET['page'] != '')) {
                $page=(int) $_GET['page'];
                if(($page < 1) || ($page > 3))
                        $page = 0;
        }

        include('view/creation/view.php');
?>
