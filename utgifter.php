<?php
include("includes/config.php");
?>
<!DOCTYPE html>
<html lang="sv">

<head>
    <title>Utgifter</title>

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
            $newpayment = new Newpayment();

            // raderar post
            if (isset($_GET['delete'])) {
                $id_payment = $_GET['delete'];

                if ($newpayment->deletePayment($id_payment)) {
                }
            }

            $list = $newpayment->printPayments();

            // echo "<pre>";
            // print_r($list['1']);
            // echo "</pre>";

            if (count($list) == 1) {
                if ($list['0']['name'] === "Kajsa") {
                    $kajsa_sum = $list['0']['SUM(price)'];
                    $lucas_sum = (int)0;
                    echo "<h4> Kajsa - utgifter totalt: " . "<span style='font-weight:900;'>" . $kajsa_sum . "</span>" . ":- </h4>";
                    echo "<h4> Lucas - utgifter totalt: " . "<span style='font-weight:900;'>" . $lucas_sum . "</span>" . ":- </h4>";
                } else {
                    $kajsa_sum = (int)0;
                    $lucas_sum = $list['0']['SUM(price)'];
                    echo "<h4> Kajsa - utgifter totalt: " . "<span style='font-weight:900;'>" . $kajsa_sum . "</span>" . ":- </h4>";
                    echo "<h4> Lucas - utgifter totalt: " . "<span style='font-weight:900;'>" . $lucas_sum . "</span>" . ":- </h4>";
                }
            } else if (count($list) == 2) {
                $kajsa_sum = $list['0']['SUM(price)'];
                $lucas_sum = $list['1']['SUM(price)'];
                echo "<h4> Kajsa - utgifter totalt: " . "<span style='font-weight:900;'>" . $kajsa_sum . "</span>" . ":- </h4>";
                echo "<h4> Lucas - utgifter totalt: " . "<span style='font-weight:900;'>" . $lucas_sum . "</span>" . ":- </h4>";
            } else {
                $kajsa_sum = (int)0;
                $lucas_sum = (int)0;
                echo "<h4> Kajsa - utgifter totalt: " . "<span style='font-weight:900;'>" . $kajsa_sum . "</span>" . ":- </h4>";
                echo "<h4> Lucas - utgifter totalt: " . "<span style='font-weight:900;'>" . $lucas_sum . "</span>" . ":- </h4>";
            }

            ?>
        </div>

        <table class="form-createpost">
            <tr>
                <th>Nr:</th>
                <th>Namn:</th>
                <th>Summa:</th>
                <th>Kommentar:</th>
                <th>Tid:</th>
                <th>Del:</th>
            </tr>

            <?php

            //instans av klassen
            $newpayment = new Newpayment();

            $list = $newpayment->printAll();

            foreach ($list as $payment) {
                echo "
                    <tr>
                        <td>" . $payment['id'] . "</td>
                        <td>" . $payment['name'] . "</td>
                        <td>" . $payment['price'] . ":- </td>
                        <td>" . $payment['comment'] . "</td>
                        <td>" . $payment['created'] . "</td>
                        <td> <a href='utgifter.php?delete=" . $payment['id'] . "'> <i class='fa-solid fa-minus'></i></a> </td>
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