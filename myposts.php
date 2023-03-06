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
    <title>My posts</title>

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

        <div class="wrapper">

            <section class="info-post">

                <?php

                $newpost = new Newpost();

                // raderar post
                if (isset($_GET['delete'])) {
                    $id = $_GET['delete'];

                    if ($newpost->deletePost($id)) {
                    }
                }


                if (isset($_SESSION['username'])) {
                    $username = $_SESSION['username'];

                    if ($newpost->printMyPosts($username)) {
                    }
                }

                $list = $newpost->printMyPosts($username);

                foreach ($list as $index => $post) {
                    echo "
                <div class='box-my-posts' id='$index'> 
                    <img class='post-image' src='postsimages/" . $post['filename'] . "' alt='Bild " . $post['id'] . ", uppladdat av " . $post['username'] . "'>
                    <h1 class='post-title'>" . $post['title'] . " <span class='post-span'>(" . $post['year'] . ")</span> </h1> 
                    <p class='post-media'>" . $post['media'] . " &nbsp; &#x2022; &nbsp; " . $post['genre'] . " &nbsp; &#x2022; &nbsp; " . $post['grade'] . "/10 <img src='images/symbols/star.png' width='18px' height='18px' style='margin-bottom:0.3em;'> </p>
                    <p class='post-username'>" . "<a class='link' style='color:white;text-decoration:underline; 'href='user.php?username=" . $post['username'] . "'>" . $post['username'] . "</a>" . "&nbsp; &#x2022; &nbsp; " . $post['created'] . "</p> 
                    <p class='post-comment'>" . $post['comment'] . "</p> 
                    <div class='post-btn'>
                        <a class='delete-btn' href='myposts.php?delete=" . $post['id'] . "'>Ta bort &nbsp; <i class='fa-regular fa-trash-can'></i></a>
                        <a class='edit-btn' href='edit.php?id=" . $post['id']. "'>Redigera &nbsp; <i class='fa-solid fa-pencil'></i></a>
                    </div>
                </div>";
                }
                ?>


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