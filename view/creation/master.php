<?php
        session_start();
        require_once('functions.php');


                        /* stockage des valeurs renvoyées par les formulaires */
        if(isset($_POST['form']) && var_test($_POST['form'], 'string') && ($_POST['form'] == 'form-1.php')) {
                if(var_test($_POST['username'], 'string') &&
                   var_test($_POST['address'], 'string') &&
                   var_test($_POST['title'], 'string') &&
                   var_test($_POST['title_extended'], 'string') &&
                   var_test($_POST['class'], 'string') &&
                   var_test($_POST['subject'], 'string') &&
                   var_test($_POST['number_people'], 'int') &&
                   var_test($_POST['number_axe'], 'int')) {

                        $_SESSION['form_1'] = true;
                        $_SESSION['TPE_username'] = $_POST['username'];
                        $_SESSION['TPE_address'] = $_POST['address'];
                        $_SESSION['TPE_title'] = $_POST['title'];
                        $_SESSION['TPE_title_extended'] = $_POST['title_extended'];
                        $_SESSION['TPE_class'] = $_POST['class'];
                        $_SESSION['TPE_subject'] = $_POST['subject'];
                        $_SESSION['TPE_number_people'] = $_POST['number_people'];
                        $_SESSION['TPE_number_axe'] = $_POST['number_axe'];
                        header('Location: creation.php?page=2');
                } else {
                        $_SESSION['form_1'] = false;
                        header('Location: creation.php?page=1');
                }
        }
        elseif(isset($_POST['form']) && var_test($_POST['form'], 'string') && ($_POST['form'] == 'form-2.php') &&
               isset($_SESSION['form-1']) && ($_SESSION['form-1'])) {
                for ($i = 1; $i <= $_SESSION['TPE_number_people']; $i++) {
                        if(isset($_POST['people_'.$i]) && var_test($_POST['people_'.$i], 'string'))
                                $_SESSION['TPE_people_'.$i] = $_POST['people_'.$i];
                        else
                                $_SESSION['form_2'] = false;
                }

                for ($i = 1; $i <= $_SESSION['TPE_number_axe']; $i++) {
                        if(isset($_POST['number_part_axe_'.$i]) && var_test($_POST['number_part_axe_'.$i], 'int'))
                                $_SESSION['TPE_number_part_axe_'.$i] = $_POST['number_part_axe_'.$i];
                        else
                                $_SESSION['form_2'] = false;
                }

                if(!(isset($_SESSION['form_2'])) || ($_SESSION['form_2'])) {
                        $_SESSION['form_2'] = true;
                        header('Location: creation.php?page=3');
                } else
                        header('Location: creation.php?page=2');
        }
        elseif(isset($_POST['form']) && var_test($_POST['form'], 'string') && ($_POST['form'] == 'form-3.php') &&
                isset($_SESSION['form-2']) && ($_SESSION['form-2'])) {
                for ($i = 1; $i <= $_SESSION['TPE_number_axe']; $i++) {
                        for ($j = 0; $j <= $_SESSION['TPE_number_part_axe_'.$i]; $j++) {
                                if(isset($_POST['title_'.$i.'-'.$j]) && var_test($_POST['title_'.$i.'-'.$j], 'string'))
                                        $_SESSION['TPE_title_'.$i.'-'.$j] = $_POST['title_'.$i.'-'.$j];
                                else
                                        $_SESSION['form_3'] = false;
                        }
                }
                if(!(isset($_SESSION['form_3'])) || ($_SESSION['form_3'])) {
                        $_SESSION['form_3'] = true;
                        $download = true;
                } else
                        header('Location: creation.php?page=3');
        }
        else
                header('Location: creation.php');



                /* appel du script master.sh qui génèrera le dossier */
                /* uniquement si le troisième formulaire est rempli et conforme */

        if(isset($download) && ($download)) {
                $command = './generate/master.sh';

                $command = $command.' '.escapeshellarg($_SESSION['TPE_username']);
                $command = $command.' '.escapeshellarg($_SESSION['TPE_address']);
                $command = $command.' '.escapeshellarg($_SESSION['TPE_title']);
                $command = $command.' '.escapeshellarg($_SESSION['TPE_title_extended']);
                $command = $command.' '.escapeshellarg($_SESSION['TPE_class']);
                $command = $command.' '.escapeshellarg($_SESSION['TPE_subject']);

                $command = $command.' '.escapeshellarg($_SESSION['TPE_number_people']);
                for ($i = 1; $i <= $_SESSION['TPE_number_people']; $i++)
                        $command = $command.' '.escapeshellarg($_SESSION['TPE_people_'.$i]);


                $command = $command.' '.escapeshellarg($_SESSION['TPE_number_axe']);

                for ($i = 1; $i <= $_SESSION['TPE_number_axe']; $i++)
                        $command = $command.' '.escapeshellarg($_SESSION['TPE_number_part_axe_'.$i]);

                for ($i = 1; $i <= $_SESSION['TPE_number_axe']; $i++)
                        for ($j = 0; $j <= $_SESSION['TPE_number_part_axe_'.$i]; $j++)
                                $command = $command.' '.escapeshellarg($_SESSION['TPE_title_'.$i.'-'.$j]);

                exec($command, $shell_return);

                foreach($shell_return as $key)
                        if($shell_return[$key] != '')
                                $error = true;
                if($error)
                        $_SESSION['generate'] = false;
                        header('Location: creation.php?');
                else
                        $_SESSION['generate'] = true;
 
                       /* WARNING : PAGE=4 A LA MAIN !! PAGE doit être égal à $number_pages de creation.php */
                        header('Location: creation.php?page=4&user='.$_SESSION['TPE_username']);
        }
?>
