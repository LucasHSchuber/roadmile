<?php
include("includes/config.php");
?>
<?php

//checks if post is created 
if (isset($_SESSION['routecreated'])) {
    $_SESSION['routecreated'] = "<h4 class='success'>The route has been registred!</h4>";
}

?>
<!DOCTYPE html>
<html lang="sv">

<head>
    <title>Index</title>

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

        <?php

        //instans av klassen
        $newroute = new Newroute();

        if (isset($_POST['submit']))

            if ($newroute->deleteAll()) {
                //if true
            }
        ?>

        <form method="POST" class="form-createpost">
            <h1 class="title">Add route</h1>
            <?php

            // print all error messeges if success not true
            if (isset($_SESSION['routecreated'])) {
                echo $_SESSION['routecreated'];
                unset($_SESSION['routecreated']);
            }

            // raderar ALLT
            if (isset($_GET['deleteAll'])) {

                if ($newroute->deleteAll()) {
                }
            }

            //instans av klassen
            $newroute = new Newroute();

            if (isset($_POST['location']) && !empty($_POST['kilometers']) && !empty($_POST['date'])) {

                $location = $_POST['location'];
                $kilometers = (int)$_POST['kilometers'];
                $parking = $_POST['parking'];
                $date = $_POST['date'];

                if ($newroute->addRoute($location, $kilometers, $parking, $date)) {
                    //if true

                }
            }


            ?>

            <label for="location">Location (inc return):</label><br>
            <input class="input-form year" type="text" name="location" id="location"><br>
            <label for="kilometers">Kilometers driven (inc return):</label><br>
            <input class="input-form year" type="number" name="kilometers" id="kilometers" min="0" value="0" step=".1"><br>
            <label for="parking">Parking:</label><br>
            <input class="input-form year" type="number" name="parking" id="parking" min="0" value="0" step=".1"><br>
            <label for="date">Date:</label><br>
            <input class="input-form year" type="date" name="date" id="date"><br>
            <button class="add-btn" type="submit"><a>Add route &nbsp;<i class="fa-solid fa-plus"></i></a></button><br><br>
            <hr>

            <?php

            //instans av klassen
            $newroute = new Newroute();

            $km = $newroute->printKilometers();
            $park = $newroute->printParking();

            $sumkilometers =  $km['0']['SUM(kilometers)'] * 1;
            $cash =  $km['0']['SUM(kilometers)'] * 2.5;
            $parking =  $park['0']['SUM(parking)'];

            echo "<h4> Kilometers driven: </h4>" .  "<h1>" . $sumkilometers . " km </h1>";

            echo "<h4> Gas compensation: </h4>" .  "<h1>" . $cash . " kr </h1>";

            echo "<h4> Parking total: </h4>" .  "<h1>" . $parking . " kr </h1>";

            ?>

        </form>


    </main>

    <footer>
        <?php
        include("includes/footer.php");
        ?>
    </footer>
</body>

</html>