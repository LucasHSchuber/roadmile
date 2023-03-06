<?php
include("includes/config.php");
?>

<!DOCTYPE html>
<html lang="sv">



<head>
    <title>login</title>

    <?php
    include("includes/head.php");
    ?>
</head>

<body>

    <header>
        <?php

        if (isset($_SESSION['username'])) {
            header("location: start.php");
        } else {
            include("includes/nav.php");
        }
        ?>
    </header>
    <main>

        <div class="">

            <section class="login-wrapper container">

                <form method="POST" class="form">
                    <h1 class="title">Logga in</h1>

                    <?php

                    //checks if account i just created and then echo message
                    if (isset($_SESSION['accountcreated'])) {
                        echo "<p class='success message'>" . "<i class='fa-solid fa-check'></i>" . "&nbsp;" . $_SESSION['accountcreated'] . "</p>";
                    }
                    unset($_SESSION['accountcreated']);

                    //om användaren inte är inloggad men försöker nå sidan
                    if (isset($_GET['message'])) { 
                        echo "<p class='error message'><i class='fa-solid fa-triangle-exclamation'></i> &nbsp; Du behöver vara inloggad för att få åtkomst till denna sida! </p>" ;
                    }

                    //instans
                    $newuser = new Newuser();

                    if (isset($_POST['username']) && isset($_POST['password'])) {

                        $username = $_POST['username'];
                        $password = $_POST['password'];

                        if ($newuser->getUser($username, $password)) {
                            //if true
                        }
                    }

                    ?>

                    <label for="username">Användarnamn:</label><br>
                    <input class="input-form" type="text" name="username" id="username"><br>
                    <label for="password">Lösenord</label><br>
                    <input class="input-form" type="password" name="password" id="password"><br><br><br>
                    <button class="login-btn" type="submit">Logga in &nbsp; <i class="fa-solid fa-arrow-right-long"></i></button><br><br>
                    <p class="message">Har du inget konto? <a href="createaccount.php">Skapa ett nytt konto här.</a><br>
                    <p class="message"><a href="createaccount.php">Glömt lösenord?</a>
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