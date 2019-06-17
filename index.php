<?php
    include_once 'Controller/connexion.php';
    include_once 'Controller/users.php';
?>

<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <title>C.A.M.A.G.R.U</title>
    </head>
    <body>
        <?php
            //$object = new Database;
            //$object->connect();
           // $object = new User;
            //echo $object->getAllUsers();
            //echo $object->getUsersWithCountCheck();

            if (isset($_POST['register'])) {

                //Create
                $username = !empty($_POST['username']) ? trim($_POST['username']) : null;
                $pass = !empty($_POST['password']) ? trim($_POST['password']) : null;
                $email = !empty($_POST['email']) ? trim($_POST['email']) : null;

                //Protect
                $pass = password_hash( $pass, PASSWORD_ARGON2I);

                //Check similarity
                $sql = "SELECT id, username, password, email FROM users WHERE username = :username"
                $stmt = $pdo->prepare($sql);
                $stmt->bindValue(':username', $username);

                //Execute
                $stmt->execute();

                //Fetch a result row as an associative array
                $user = $stmt->fetch(PDO::FETCH_ASSOC);

                if (user === false) {
                    //usernames don't match
                    die('Nom d\'utilisateur incorrecte');
                } else {
                    //Check password
                    $validPassword = password_verify($passwordAttempt, $user['password']);

                    if ($validPassword) {

                        //Start session
                        $_SESSION['user_id'] = $user['id'];
                        $_SESSION['logged_id'] = time();

                        //Redirection
                        header('Location : index.php')
                        exit;

                    } else {
                        die('Mot de passe incorrecte'); 
                    }
                }
            }

        ?>
        <h1>Login</h1>
        <form action="login.php" method="post">
            <label for="username">Username</label>
            <input type="text" id="username" name="username"><br>
            <label for="password">Password</label>
            <input type="text" id="password" name="password"><br>
            <input type="submit" name="login" value="Login">
        </form>
    </body>
</html>