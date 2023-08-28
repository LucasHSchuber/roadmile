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
                <th>Nr:</th>
                <th>Location:</th>
                <th>Kilometers:</th>
                <th>parking:</th>
                <th>Date:</th>
                <th>Delete:</th>
            </tr>

            <?php

            //instans av klassen
            $newroute = new Newroute();

            $list = $newroute->printAll();

            foreach ($list as $route) {
                echo "
                    <tr>
                        <td>" . $route['id'] . "</td>
                        <td>" . $route['location'] . "</td>
                        <td>" . $route['kilometers'] . "</td>
                        <td>" . $route['parking'] . "</td>
                        <td>" . $route['datetime'] . "</td>
                        <td> <a href='routes.php?delete=" . $route['id'] . "'> <i class='fa-solid fa-minus'></i></a> </td>
                    </tr>
                ";
            }
            ?>

        </table>

    </main>

    <footer>
        <?php
        include("includes/footer.php");
        ?>
    </footer>
</body>

</html>