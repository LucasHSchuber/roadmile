<?php
include("includes/config.php");
?>
<!DOCTYPE html>
<html lang="sv">

<head>
    <title>Routes</title>

    <?php
    include("includes/head.php");
    ?>

</head>

<body>
    <header>
        <?php
        include("includes/nav_loggedin.php");
        ?>
    </header>
    <main>
        <div class="form-createpost">
            <?php
            //instans av klassen
            $newroute = new Newroute();

            // raderar post
            if (isset($_GET['delete'])) {
                $id = $_GET['delete'];

                if ($newroute->deleteRoute($id)) {
                }
            }

            $list = $newroute->printKilometers();

            ?>
        </div>

        <table class="form-createpost">
            <tr>
                <th>Date:</th>
                <th>Location:</th>
                <th>Kilometers:</th>
                <th>Parking:</th>
                <th>Toll:</th>
                <th>Delete:</th>
            </tr>

            <?php

            //instans av klassen
            $newroute = new Newroute();

            $list = $newroute->printAll();

            foreach ($list as $route) {
                echo "
                    <tr>
                        <td>" . $route['datetime'] . "</td>
                        <td>" . $route['location'] . "</td>
                        <td>" . $route['kilometers'] . "</td>
                        <td>" . $route['parking'] . "</td>
                        <td>" . $route['toll'] . "</td>
                        <td> <a href='routes.php?delete=" . $route['id'] . "'> <i class='fa-solid fa-minus'></i></a> </td>
                    </tr>
                ";
            }
            ?>

        </table>

        <!-- <form method="POST" class="form-createpost">
            <button class="" type="submit" value="Submit" name="sendmail"><a>Send</a></button><br><br>
        </form> -->

        <?php

        // if (isset($_POST['sendmail'])) {
        //     $to      = 'lucas.hammarstrand@hotmail.com';
        //     $subject = 'Mil och Parkering - HT23';
        //     $message = 'hello';
        //     $headers = 'From: lucas.hammarstrand@hotmail.com' . "\r\n" .
        //         'X-Mailer: PHP/' . phpversion();

        //     mail($to, $subject, $message, $headers);

        //     echo 'Email Sent.';
        // }

        ?>

    </main>

    <footer>
        <?php
        include("includes/footer.php");
        ?>
    </footer>

</body>

</html>