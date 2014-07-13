<?php
        session_start();

        if(isset($_SESSION['download']) && $_SESSION['download'] = true) {
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
                        header('Location: index.php?error=');
                else
                        header('Location: download.php?user='.$_SESSION['TPE_username']);
        }
        else
                header('Location: index.php?error=');
?>
