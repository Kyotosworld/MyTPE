<?php
        session_start();
        require_once('functions.php');

        if(var_test($_POST['form'], 'string', 'form-1.php')) {

                $_SESSION['form_1'] = true;
                $_SESSION['TPE_username'] = $_POST['username'];
                $_SESSION['TPE_address'] = $_POST['address'];
                $_SESSION['TPE_title'] = $_POST['title'];
                $_SESSION['TPE_title_extended'] = $_POST['title_extended'];
                $_SESSION['TPE_class'] = $_POST['class'];
                $_SESSION['TPE_subject'] = $_POST['subject'];
                $_SESSION['TPE_number_people'] = $_POST['number_people'];
                $_SESSION['TPE_number_axe'] = $_POST['number_axe'];

                header('Location: form-2.php');
        }
        elseif (var_test($_POST['form'], 'string', 'form-2.php')) {
                $_SESSION['form_2'] = true;
                for ($i = 1; $i <= $_SESSION['TPE_number_people']; $i++)
                        $_SESSION['TPE_people_'.$i] = $_POST['people_'.$i];
                for ($i = 1; $i <= $_SESSION['TPE_number_axe']; $i++)
                        $_SESSION['TPE_number_part_axe_'.$i] = $_POST['number_part_axe_'.$i];

                header('Location: form-3.php');
        }
        elseif (var_test($_POST['form'], 'string', 'form-3.php')) {
                $_SESSION['form_3'] = true;
                for ($i = 1; $i <= $_SESSION['TPE_number_axe']; $i++)
                        for ($j = 0; $j <= $_SESSION['TPE_number_part_axe_'.$i]; $j++) {
                                $_POST['title_'.$i.'-'.$j] = 'vOICI lE tITRE ::: aXE '.$i.'; pARTIE '.$j;       // génerer les valeurs est plus simple
                                $_SESSION['TPE_title_'.$i.'-'.$j] = $_POST['title_'.$i.'-'.$j];
                        }

                $_SESSION['download'] = true;
                header('Location: master.php');
        }
        else
                header('Location: index.php?error=');
?>
