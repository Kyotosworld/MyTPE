<?php
        require('model/functions.php');


                        /* récupération des variables de connection au compte sql */

        if(isset($_POST['username'], $_POST['password'])) {
               if(var_test($_POST['username'], 'string') && var_test($_POST['password'], 'string')) {
                       $username = $_POST['username'];
                       $password = $_POST['password'];
               }
        }
        elseif(isset($_POST['create_username'], $_POST['create_password'], $_POST['create_confirm_password'], $_POST['create_email'])) {
               if(var_test($_POST['create_username'], 'string') && 
                  var_test($_POST['create_password'], 'string') &&
                  var_test($_POST['create_confirm_password'], 'string') &&
                  var_test($_POST['create_email'], 'string')) {
                       $create_username = $_POST['create_username'];
                       if($_POST['create_password'] == $_POST['create_confirm_password'])
                               $create_password = $_POST['create_password'];
                       $create_email = $_POST['create_email'];
               }
        }

        if(isset($_GET['session_disconnect']))
                $session_disconnect = true;


                        /* récupération des variables de session */
        session_start();


                        /* connection à la base de données */

        try {
                $DATABASE = new PDO('mysql:host=localhost;dbname=mytpe;', 'root', '',
                                     array( PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
                                            PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8'));
        }
        catch (Exception $e) {
                die('Erreur : '.$e->getMessage());
        }


                        /* exécution selon les variables reçues plus haut */

                        /* déconnexion */
        if(isset($_SESSION['id']) && isset($session_disconnect)) {
                $_SESSION = array();
                session_destroy();
        }

                        /* connexion */
        elseif(isset($username, $password)) {
                $query = $DATABASE->prepare('SELECT id FROM users WHERE username = :username AND password = :password');
                $query->execute( array('username' => $username, 'password' => $password) );
                $answer = $query->fetch();

                if($answer)
                        $sql_connected = true;
                else
                        $sql_connected = false;
                $query->closeCursor();

                if($sql_connected)
                        require('model/session.php');
        }

                        /* création d'un compte */
        elseif(isset($create_username, $create_password, $create_email)) {
                $query = $DATABASE->prepare('SELECT id FROM users WHERE username = :username OR password = :password OR email = :email');
                $query->execute( array('username' => $create_username, 'password' => $create_password, 'email' => $create_email) );
                $answer = $query->fetch();

                if($answer)
                        $sql_already_taken = true;
                else {
                        $query = $DATABASE->prepare('INSERT INTO users(username, password, email) VALUES(:username, :password, :email)');
                        $query->execute( array('username' => $create_username, 'password' => $create_password, 'email' => $create_email) );
                        $sql_created = true;
                }
        }
?>
