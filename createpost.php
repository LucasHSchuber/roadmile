<?php
include("includes/config.php");
?>
<?php
if (!isset($_SESSION['username'])) {
    header("location: login.php?message=Du måste vara inloggad för att få åtkomst till denna sida.");
}
?>


<!DOCTYPE html>
<html lang="sv">



<head>
    <title>Create post</title>

    <?php
    include("includes/head.php");
    ?>
</head>

<body>

    <header>
        <?php

        if (isset($_SESSION['username'])) {
            include("includes/nav_loggedin.php");
        } else {
            include("includes/nav.php");
        }

        ?>
    </header>
    <main>

        <div class="">

            <section class="createpost-wrapper container">

                <form method="POST" class="form-createpost" enctype="multipart/form-data">
                    <h1 class="title">Skapa inlägg</h1>

                    <?php

                    //instans
                    $newpost = new Newpost();

                    if ((isset($_POST['title'])) && (isset($_FILES['file'])) && ($_FILES['file']['type'] == "image/jpeg" || $_FILES['file']['type'] == "image/png" || $_FILES['file']['type'] == "image/jpg")) {


                        $title = strip_tags($_POST['title']);
                        $year = intval($_POST['year']);
                        $comment = strip_tags($_POST['comment']);
                        $media = $_POST['media'];
                        $genre = $_POST['genre'];
                        $grade = (int)$_POST['grade'];
                        $username = $_SESSION['username'];
                        $file = $_FILES['file'];

                        $succes = true; // if all posts are OK

                        if (!$newpost->setTitle($title)) {
                            $succes = false;
                            echo "<p class='error message'><i class='fa-solid fa-triangle-exclamation'></i> &nbsp; Du behöver ange en titel!</p>";
                        }
                        if (!$newpost->setComment($comment)) {
                            $succes = false;
                            echo "<p class='error message'><i class='fa-solid fa-triangle-exclamation'></i> &nbsp; Du behöver skriva en kommentar!</p>";
                        }
                        
                        if ($newpost->addPost($title, $year, $comment, $media, $genre, $grade, $username, $file)) {
                            //if true

                            //default values

                        }
                    } 


                    ?>

                    <label for="title">Titel:</label><br>
                    <input class="input-form" type="text" name="title" id="title"><br>
                    <label for="year">År:</label><br>
                    <input class="input-form year" type="number" name="year" id="year"><br>
                    <label for="comment">Kommentar</label><br>
                    <textarea class="input-form" name="comment" id="comment" rows="3" style="padding:0!important;"></textarea>
                    <div class="select-div">
                        <div>
                            <label>Media:</label>
                            <select name="media" id="media">
                                <option value="" selected>-</option>
                                <option value="Film">Film</option>
                                <option value="Serie">Serie</option>
                                <option value="Dokumentär">Dokumentär</option>
                            </select>
                        </div>
                        <div>
                            <label>Genre:</label>
                            <select name="genre" id="genre">
                                <option value="" selected>-</option>
                                <option value="Action">Action</option>
                                <option value="Drama">Drama</option>
                                <option value="Historia">Historia</option>
                                <option value="Hjärnskrynklare">Hjärnskrynklare</option>
                                <option value="Komedi">Komedi</option>
                                <option value="Kriminalare">Kriminalare</option>
                                <option value="Mystik">Mystik</option>
                                <option value="Romantik">Romantik</option>
                                <option value="Rysare">Rysare</option>
                                <option value="Sci-fi">Sci-fi</option>
                                <option value="Skräck">Skräck</option>
                                <option value="Thriller">Thriller</option>
                            </select>
                        </div>
                        <div>
                            <label>Betyg:</label>
                            <select name="grade" id="grade">
                                <option value="" selected>-</option>
                                <option value="1">1/10 </option>
                                <option value="2">2/10</option>
                                <option value="3">3/10</option>
                                <option value="4">4/10</option>
                                <option value="5">5/10</option>
                                <option value="6">6/10</option>
                                <option value="7">7/10</option>
                                <option value="8">8/10</option>
                                <option value="9">9/10</option>
                                <option value="10">10/10</option>
                            </select>
                        </div>
                    </div> <br>
                    <label for="file" style="color:white !important;">Bild</label>
                    <input class="input-form" style="color:white !important;" type="file" name="file" id="file"><br><br>
                    <button class="login-btn" type="submit"><a>Skapa inlägg &nbsp;<i class="fa-solid fa-plus"></i></a></button><br><br>
                </form>
            </section>

        </div>

    </main>
    <footer>
        <?php
        include("includes/footer.php");
        ?>
    </footer>

    <script>
        CKEDITOR.replace('comment');
    </script>

</body>

</html>