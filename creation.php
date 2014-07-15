<?php
 
        include('controller/session.php');

        $number_pages=4;

        if(isset($_GET['page']) && ($_GET['page'] != '')) {
                $page=(int) $_GET['page'];
                if(($page < 1) || ($page > $number_pages))
                        $page = 0;
        }
        else $page = 0;

/*        if(isset($_SESSION['form_1']) && !($_SESSION['form_1']))
                $error = true;
        if(isset($_SESSION['form_2']) && !($_SESSION['form_2']))
                $error = true;
        if(isset($_SESSION['form_3']) && !($_SESSION['form_3']))
                $error = true;
        if(isset($_SESSION['generate']) && !($_SESSION['generate']))
                $error = true;
*/

//        if($page_verified && isset($_SESSION['id'])) {
//              include('model/creation.php');
//        }

        include('view/creation/view.php');
?>
