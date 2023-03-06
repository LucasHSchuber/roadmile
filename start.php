<?php
include("includes/config.php");
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

        <div class="hero-wrapper">
            <picture class="hero-image">
                <source srcset="images/hero.jpg" media="(min-width: 1521px)">
                <source srcset="images/test2.jpg" media="(min-width: 801px)">
                <img src="images/test2.jpg" alt="bild på en person på ett fjäll" />
            </picture>
        </div>

        <div class="wrapper">

            <section class="box-one">
                <p class="grid-box-one">flim &#x2022; blog.</p>
                <h1 class="grid-box-one">Filmer. Serier. <br> Tips. Tipsa.</h1>
                <ol class="grid-box-one">
                    <li>Blog1</li>
                    <li>Blog2</li>
                    <li>Blog3</li>
                    <li>Blog4</li>
                    <li>Blog5</li>
                </ol>
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