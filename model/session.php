<?php

//              la connection avec la base de données s'est faite correctement
//              on récupère donc toutes les informations d'utilisateur pour les placer dans $_SESSION

                $query = $DATABASE->prepare('SELECT id, username, email FROM users WHERE username = :username AND password = :password');
                $query->execute( array ('username' => $username, 'password' => $password) );

                $answer = $query->fetch();

                $_SESSION['id'] = $answer[0];
                $_SESSION['username'] = $answer[1];
                $_SESSION['email'] = $answer[2];
?>
