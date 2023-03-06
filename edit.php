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
    <title>Edit</title>

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
                    <h1 class="title">Redigera inlägg</h1>

                    <?php

                    //instans
                    $newpost = new Newpost();

                    //default values
                    $title = "";

                    if (isset($_GET['id'])) {
                        $id = $_GET['id'];

                        if ($newpost->getEditPost($id)) {
                        }
                    }

                    $list = $newpost->getEditPost($id);

                    // foreach ($list as $post) {
                    //     $title = $post['title'];
                    //     $comment = $post['comment'];
                    //     $year = $post['year'];
                    //     $media = $post['media'];

                    // }

                    if ((isset($_POST['title'])) && (isset($_FILES['file'])) && ($_FILES['file']['type'] == "image/jpeg" || $_FILES['file']['type'] == "image/png" || $_FILES['file']['type'] == "image/jpg")) {


                        $title = strip_tags($_POST['title']);
                        $id = (int)$_GET['id'];
                        $year = intval($_POST['year']);
                        $comment = strip_tags($_POST['comment']);
                        $media = $_POST['media'];
                        $genre = $_POST['genre'];
                        $grade = (int)$_POST['grade'];
                        // $username = $_SESSION['username'];
                        $file = $_FILES['file'];

                        if ($newpost->addEditPost($title, $id, $year, $comment, $media, $genre, $grade, $file)) {

                        }
                    }




                    ?>

                    <label for="title">Titel:</label><br>
                    <input class="input-form" type="text" name="title" id="title" value="<?= $list['title']; ?>"><br>
                    <label for="year">År:</label><br>
                    <input class="input-form year" type="number" name="year" id="year" value="<?= $list['year']; ?>"><br>
                    <label for="comment">Kommentar</label><br>
                    <textarea class="input-form" name="comment" id="comment" rows="3"><?= $list['comment']; ?></textarea>
                    <div class="select-div">
                        <div>
                            <label>Media:</label>
                            <select name="media" id="media">
                                <option value="Film" <?php if($list['media'] == 'Film'){echo 'selected';} ?> >Film</option>
                                <option value="Serie" <?php if($list['media'] == 'Serie'){echo 'selected';} ?> >Serie</option>
                                <option value="Dokumentär" <?php if($list['media'] == 'Dokumentär'){echo 'selected';} ?> >Dokumentär</option>
                            </select>
                        </div>
                        <div>
                            <label>Genre:</label>
                            <select name="genre" id="genre">
                                <option value="Action" <?php if($list['genre'] == 'Action'){echo 'selected';} ?>  >Action</option>
                                <option value="Drama" <?php if($list['genre'] == 'Drama'){echo 'selected';} ?>>Drama</option>
                                <option value="Historia" <?php if($list['genre'] == 'Historia'){echo 'selected';} ?>>Historia</option>
                                <option value="Hjärnskrynklare" <?php if($list['genre'] == 'Hjärnskrynklare'){echo 'selected';} ?>>Hjärnskrynklare</option>
                                <option value="Komedi" <?php if($list['genre'] == 'Komedi'){echo 'selected';} ?>>Komedi</option>
                                <option value="Kriminalare" <?php if($list['genre'] == 'Kriminalare'){echo 'selected';} ?>>Kriminalare</option>
                                <option value="Mystik" <?php if($list['genre'] == 'Mystik'){echo 'selected';} ?>>Mystik</option>
                                <option value="Romantik" <?php if($list['genre'] == 'Romantik'){echo 'selected';} ?>>Romantik</option>
                                <option value="Rysare" <?php if($list['genre'] == 'Rysare'){echo 'selected';} ?>>Rysare</option>
                                <option value="Sci-fi" <?php if($list['genre'] == 'Sci-fi'){echo 'selected';} ?>>Sci-fi</option>
                                <option value="Skräck" <?php if($list['genre'] == 'Skräck'){echo 'selected';} ?>>Skräck</option>
                                <option value="Thriller" <?php if($list['genre'] == 'Thriller'){echo 'selected';} ?>>Thriller</option>
                            </select>
                        </div>
                        <div>
                            <label>Betyg:</label>
                            <select name="grade" id="grade">
                                <option value="1"  <?php if($list['grade'] == '1'){echo 'selected';} ?> >1/10 </option>
                                <option value="2" <?php if($list['grade'] == '2'){echo 'selected';} ?>>2/10</option>
                                <option value="3" <?php if($list['grade'] == '3'){echo 'selected';} ?>>3/10</option>
                                <option value="4" <?php if($list['grade'] == '4'){echo 'selected';} ?>>4/10</option>
                                <option value="5" <?php if($list['grade'] == '5'){echo 'selected';} ?>>5/10</option>
                                <option value="6" <?php if($list['grade'] == '6'){echo 'selected';} ?>>6/10</option>
                                <option value="7" <?php if($list['grade'] == '7'){echo 'selected';} ?>>7/10</option>
                                <option value="8" <?php if($list['grade'] == '8'){echo 'selected';} ?>>8/10</option>
                                <option value="9" <?php if($list['grade'] == '9'){echo 'selected';} ?>>9/10</option>
                                <option value="10" <?php if($list['grade'] == '10'){echo 'selected';} ?>>10/10</option>
                            </select>
                        </div>
                    </div> <br>
                    <label for="file" style="color:white !important;">Bild</label>
                    <input class="input-form" style="color:white !important;" type="file" name="file" id="file" ><br><br>
                    <button class="login-btn" type="submit"><a>Klar &nbsp;<i class="fa-solid fa-check"></i></a></button><br><br>
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