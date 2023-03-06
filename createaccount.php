<?php
include("includes/config.php");
?>
<!DOCTYPE html>
<html lang="sv">

<?php
include("includes/head.php");
?>

<head>
    <title>login</title>
</head>

<body>
    <header>
        <?php
        include("includes/nav.php");
        ?>
    </header>
    <main>

        <div class="">

            <section class="login-wrapper container">

                <form method="POST" class="form">
                    <h1 class="title">Skapa konto</h1>

                    <?php

                    $newuser = new Newuser();

                    //default values
                    $username = "";
                    $password = "";
                    $repeatpassword = "";
                    $firstname = "";
                    $lastname = "";
                    $memory = "";
                    $email = "";

                    if (isset($_POST['username']) && isset($_POST['password'])) {

                        $username = strip_tags($_POST['username']);
                        $password = $_POST['password'];
                        $repeatpassword = $_POST['repeatpassword'];
                        $firstname = $_POST['firstname'];
                        $lastname = $_POST['lastname'];
                        $memory = $_POST['memory'];
                        $email = $_POST['email'];

                        $succes = true; // if all posts are OK


                        if (!$newuser->setFirstname($firstname)) {
                            $succes = false;
                            echo "<p class='error message'><i class='fa-solid fa-triangle-exclamation'></i> &nbsp; Du behöver ange ditt förnamn!</p>";
                        }

                        if (!$newuser->setLastname($lastname)) {
                            $succes = false;
                            echo "<p class='error message'> <i class='fa-solid fa-triangle-exclamation'></i> &nbsp; Du behöver ange ditt efternamn!</p>";
                        }

                        if (!$newuser->validEmail($email)) {
                            $succes = false;
                            echo "<p class='error message'><i class='fa-solid fa-triangle-exclamation'></i> &nbsp; Skriv in en giltig email-adress! </p>";
                        }

                        if (!$newuser->emailTaken($email)) {
                            $succes = false;
                            echo "<p class='error message'><i class='fa-solid fa-triangle-exclamation'></i> &nbsp; Email-adressen är redan upptagen! <a href='resetpassword.php' class='link'>Återställ lösenordet?</a></p>";
                            $email = "";
                        }

                        // if (!$newuser->setEmail($email)) {
                        //     $succes = false;
                        //     echo "<p class='error message'><i class='fa-solid fa-triangle-exclamation'></i> &nbsp; Du behöver ange din email!</p>";
                        // }
                        if (!$newuser->setUsername($username)) {
                            $succes = false;
                            echo "<p class='error message'><i class='fa-solid fa-triangle-exclamation'></i> &nbsp; Du behöver ange ett användarnamn!</p>";
                        }

                        if (!$newuser->setPassword($password)) {
                            $succes = false;
                            echo "<p class='error message'><i class='fa-solid fa-triangle-exclamation'></i> &nbsp; Du behöver ange lösenord som är minst 4 tecken långt, och som innehåller siffror och bokstäver!</p>";
                        }
                        if (!$newuser->repeatPassword($repeatpassword, $password)) {
                            $succes = false;
                            echo "<p class='error message'><i class='fa-solid fa-triangle-exclamation'></i> &nbsp; Lösenorden matchar inte!</p>";
                        }

                        if ($newuser->addUser($firstname, $lastname, $email, $username, $password, $memory, $repeatpassword)) {
                            //if true

                            //default values
                            $username = "";
                            $password = "";
                            $repeatpassword = "";
                            $firstname = "";
                            $lastname = "";
                            $memory = "";
                            $email = "";
                        }
                    }

                    ?>


                    <label for="firstname">Förnamn: *</label><br>
                    <input class="input-form" type="text" name="firstname" id="firstname" value="<?= $firstname; ?>"><br>
                    <label for="lastname">Efternamn: *</label><br>
                    <input class="input-form" type="text" name="lastname" id="lastname" value="<?= $lastname; ?>"><br>
                    <label for="email">Email: *</label><br>
                    <input class="input-form" type="text" name="email" id="email" value="<?= $email; ?>"><br>
                    <label for="memory">Namnet på ditt första husdjur (för återställning av lösenord):</label><br>
                    <input class="input-form" type="text" name="memory" id="memory" value="<?= $memory; ?>"><br>
                    <label for="username">Användarnamn: *</label><br>
                    <input class="input-form" type="text" name="username" id="username" value="<?= $username; ?>"><br>
                    <label for="password">Lösenord: *</label><br>
                    <input class="input-form" type="password" name="password" id="password"><br>
                    <label for="repeatpassword">Upprepa lösenord: *</label><br>
                    <input class="input-form" type="password" name="repeatpassword" id="repeatpassword"><br><br><br>
                    <button class="login-btn" type="submit">Skapa konto &nbsp;<i class="fa-solid fa-user-plus"></i></button><br><br>
                    <p class="message">Har du redan ett konto? <a href="login.php" style="text-decoration:underline;">Logga in här.</a><br>
                </form>
            </section>


        </div>


    </main>
    <footer>
        <?php
        include("includes/footer.php");
        ?>
    </footer>
</body>

</html>