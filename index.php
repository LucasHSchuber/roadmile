<?php
include("includes/config.php");
?>
<?php

//checks if post is created 
if (isset($_SESSION['paymentcreated'])) {
    $_SESSION['paymentcreated'] = "<h4 class='success'>Utgiften har registrerats!</h4>";
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
        $newpayment = new Newpayment();

        if (isset($_POST['submit']))

            if ($newpayment->deleteAll()) {
                //if true
            }
        ?>

        <form method="POST" class="form-createpost">
            <h1 class="title">Skapa betalning</h1>
            <?php

            // print all error messeges if success not true
            if (isset($_SESSION['paymentcreated'])) {
                echo $_SESSION['paymentcreated'];
                unset($_SESSION['paymentcreated']);
            }

            // raderar ALLT
            if (isset($_GET['deleteAll'])) {

                if ($newpayment->deleteAll()) {
                }
            }

            //instans av klassen
            $newpayment = new Newpayment();

            if (isset($_POST['price']) && !empty($_POST['price'])) {

                $name = $_POST['name'];
                $price = (int)$_POST['price'];
                $comment = $_POST['comment'];

                if ($newpayment->addPayment($name, $price, $comment)) {
                    //if true

                }
            }


            ?>
            <div class="select-div">
                <div>
                    <label for="name">Betalades av:</label>
                    <select name="name" id="name">
                        <option value="Lucas">Lucas</option>
                        <option value="Kajsa">Kajsa</option>
                    </select>
                </div>
            </div>
            <label for="price">Utgift:</label><br>
            <input class="input-form year" type="number" name="price" id="price"><br>
            <label for="comment">Kommentar:</label><br>
            <textarea class="input-form" name="comment" id="comment" rows="3" style="padding:0!important;"></textarea><br><br>
            <button class="add-btn" type="submit"><a>Lägg till &nbsp;<i class="fa-solid fa-plus"></i></a></button><br><br>
            <hr>
            <?php

            //instans av klassen
            $newpayment = new Newpayment();

            $list = $newpayment->printPayments();

            // echo "<pre>";
            // print_r(count($list));
            // echo "</pre>";

            if (count($list) == 1) {
                if ($list['0']['name'] === "Kajsa") {
                    $kajsa_sum = $list['0']['SUM(price)'];
                    $lucas_sum = (int)0;
                    $sum = $kajsa_sum - $lucas_sum;
                    echo "<h4> Lucas är skyldig: </h4>" . "<h1>" . $sum/(int)2 . ":- </h1>";
                } else {
                    $kajsa_sum = (int)0;
                    $lucas_sum = $list['0']['SUM(price)'];
                    $sum = $lucas_sum - $kajsa_sum;
                    echo "<h4> Kajsa är skyldig: </h4>" . "<h1>" . $sum/(int)2 . ":- </h1>";
                }
            } else if (count($list) == 2) {
                $kajsa_sum = $list['0']['SUM(price)'];
                $lucas_sum = $list['1']['SUM(price)'];

                if ($kajsa_sum > $lucas_sum) {

                    $sum = $kajsa_sum - $lucas_sum;
                    echo "<h4> Lucas är skyldig: </h4>" . "<h1>" . $sum/(int)2 . ":- </h1>";
                } else if ($lucas_sum > $kajsa_sum) {
                    $sum = $lucas_sum - $kajsa_sum;
                    echo "<h4> Kajsa är skyldig: </h4>" . "<h1>" . $sum/(int)2 . ":- </h1>";
                } else {
                    echo "<h4> Ni är kvitt!</h4>";
                }
            } else {
                echo "<h4> Inga registrerade utgifter</h4>";
            }


            // if ((empty($list['0'])) && (!empty($list['1']))) {

            //     $kajsa_sum = 0;
            //     $lucas_sum = $list['1']['SUM(price)'];

            //     $sum = $lucas_sum - $kajsa_sum;
            //     echo "<h4> Kajsa är skyldig: </h4>" . "<h1>" . $sum . ":- </h1>";
            // } else if ((!empty($list['0'])) && (empty($list['1']))) {

            //     $kajsa_sum = $list['0']['SUM(price)'];
            //     $lucas_sum = 0;

            //     $sum = $kajsa_sum - $lucas_sum;
            //     echo "<h4> Lucas är skyldig: </h4>" . "<h1>" . $sum . ":- </h1>";
            // } else if ((empty($list['0'])) && (empty($list['1']))) {

            //     echo "<h4> Inga registrerade utgifter </h4>";
            // } else if ((!empty($list['0'])) && (!empty($list['1']))) {

            //     $kajsa_sum = $list['0']['SUM(price)'];
            //     $lucas_sum = $list['1']['SUM(price)'];

            //     if ($kajsa_sum > $lucas_sum) {

            //         $sum = $kajsa_sum - $lucas_sum;
            //         echo "<h4> Lucas är skyldig: </h4>" . "<h1>" . $sum . ":- </h1>";
            //     } else if ($kajsa_sum < $lucas_sum) {
            //         $sum = $lucas_sum - $kajsa_sum;
            //         echo "<h4> Kajsa är skyldig: </h4>" . "<h1>" . $sum . ":- </h1>";
            //     } else {
            //         echo "<h4> Ni är kvitt!</h4>";
            //     }
            // }

            ?>

        </form>

        <form method="POST" class="form-createpost">
            <button class="bomb-btn" type="submit" value="Submit" name="submit"><a><i class="fa-solid fa-bomb"></i></a></button><br><br>
        </form>
    </main>

    <footer>
        <?php
        include("includes/footer.php");
        ?>
    </footer>
</body>

</html>