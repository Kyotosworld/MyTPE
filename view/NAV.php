<?php
        echo '<nav>';

        if(isset($_SESSION['id'])) {
                if(isset($sql_connected) && ($sql_connected)) {
                        echo '<p style="color:green;margin-bottom: 0;">Félicitations, vous êtes connecté</p>';
                        echo '<p style="margin-top: 0;">___________________________________</p>';
                }

                echo '<a href="creation.php"><h1>'.$_SESSION['username'].'</h1></a>';
                echo '<ul>';
                echo '<li>Email : '.$_SESSION['email'].'</li>';
                echo '</ul>';
                echo '<a href="index.php?session_disconnect=">Deconnection</a>';
                echo '<p style="margin-top: 0;">___________________________________</p>';
        } else {
                if(isset($sql_connected) && !($sql_connected) && (!isset($session_disconnect))) {
                        echo'<p style="color:red;margin-bottom: 0;">Erreur ! Les identifiants entrés sont incorrects</p>';
                        echo '<p style="margin-top: 0;">___________________________________</p>';
                }
                if(isset($sql_created) && ($sql_created)) {
                        echo '<p style="color:green;margin-bottom: 0;">Félicitations, votre compte a bien été créé</p>';
                        echo '<p style="margin-top: 0;">___________________________________</p>';
                }
                if(isset($sql_already_taken) && ($sql_already_taken)) {
                        echo '<p style="color:red;margin-bottom: 0;">Erreur ! Les identifiants entrés sont déjà pris</p>';
                        echo '<p style="margin-top: 0;">___________________________________</p>';
                }
?>
        <form method="post" action="index.php">
                <h1>Connect</h1>
                <label for="a"></label>User :<input type="text" name="username" id="a" /><br />
                <label for="b"></label>Pass :<input type="password" name="password" id="b" /><br />
                <input type="submit" value="Connect" />
        </form>
        <form method="post" action="index.php">
                <h1>Create</h1>
                <label for="a"></label>User :<input type="text" name="create_username" id="a" /><br />
                <label for="b"></label>Email :<input type="text" name="create_email" id="b" /><br />
                <label for="c"></label>Pass :<input type="password" name="create_password" id="c" /><br />
                <label for="d"></label>Confirm :<input type="password" name="create_confirm_password" id="d" /><br />
                <input type="submit" value="Create" />
        </form>
<?php
        }


                        /* DEBUG */

                echo '<h1>Variables</h1>';

                echo '<h1 style="font-size:1.5em;text-align: left; color: black;">$_GET</h1>';
                echo '<pre>';
                print_r($_GET);
                echo'</pre>';

                echo '<h1 style="font-size:1.5em;text-align: left; color: black;">$_POST</h1>';
                echo '<pre>';
                print_r($_POST);
                echo'</pre>';

                echo '<h1 style="font-size:1.5em;text-align: left; color: black;">$_SESSION</h1>';
                echo '<pre>';
                print_r($_SESSION);
                echo'</pre>';

                echo '<h1 style="font-size:1.5em;text-align: left; color: black;">Others</h1>';
                echo '<p>$username : ';if(isset($username)) echo $username; else echo '<em style="color:red;">UNSET</em>';echo '</p>';
                echo '<p>$password : ';if(isset($password)) echo $password; else echo '<em style="color:red;">UNSET</em>';echo '</p>';
                echo '<p>$create_username : ';if(isset($create_username)) echo $create_username; else echo '<em style="color:red;">UNSET</em>';echo '</p>';
                echo '<p>$create_password : ';if(isset($create_password)) echo $create_password; else echo '<em style="color:red;">UNSET</em>';echo '</p>';
                echo '<p>$create_email : ';if(isset($create_email)) echo $create_email; else echo '<em style="color:red;">UNSET</em>';echo '</p>';
           echo '<p>$session_disconnect : ';if(isset($session_disconnect)) echo $session_disconnect; else echo '<em style="color:red;">UNSET</em>';echo '</p>';
                echo '<p>$sql_connected : ';if(isset($sql_connected)) echo $sql_connected; else echo '<em style="color:red;">UNSET</em>';echo '</p>';
                echo '<p>$sql_created : ';if(isset($sql_created)) echo $sql_created; else echo '<em style="color:red;">UNSET</em>';echo '</p>';
                echo '<p>$page : ';if(isset($page)) echo $page; else echo '<em style="color:red;">UNSET</em>';echo '</p>';
                echo '<p>$number_pages : ';if(isset($number_pages)) echo $number_pages; else echo '<em style="color:red;">UNSET</em>';echo '</p>';
                echo '<p>$number_pages -1 : ';if(isset($number_pages)) echo ($number_pages-1); else echo '<em style="color:red;">UNSET</em>';echo '</p>';
                echo '<p>$error : ';if(isset($error)) echo $error; else echo '<em style="color:red;">UNSET</em>';echo '</p>';
                echo '<p>$download : ';if(isset($download)) echo $download; else echo '<em style="color:red;">UNSET</em>';echo '</p>';

        echo '</nav>';
?>
