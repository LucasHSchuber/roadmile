<?php

class Newpost
{

    //properties
    private $db;
    private $title;
    private $year;
    private $comment;
    private $file;

    //constructor
    function __construct()
    {
        $this->db = new mysqli('localhost', 'root', 'root', 'blogsdb');
        if ($this->db->connect_errno > 0) {
            die('fel vid anslutning till databasen: ' . $this->db->connect_error);
        }
    }




    // add post
    public function addPost(string $title, int $year, string $comment, string $media, string $genre, int $grade, string $username, $file): bool
    {

        if (!$this->setTitle($title)) return false;
        if (!$this->setComment($comment)) return false;

        if ($_FILES['file']['type']) {
            if (file_exists("postsimages/" . $_FILES['file']['name'])) {
                return "Filen " . $_FILES['file']['name'] . " finns redan, välj annat namn.";
            } else {
                //flyttar filen till rätt katalog
                move_uploaded_file($_FILES['file']['tmp_name'], "postsimages/" . $_FILES['file']['name']);
                $file = $_FILES['file']['name'];

                //sanitera med real_escape_string
                $title = $this->db->real_escape_string($title);
                $year = $this->db->real_escape_string($year);
                $comment = $this->db->real_escape_string($comment);

                //SQL fråga
                $sql = "INSERT INTO posts(title, year, comment, media, genre, grade, username, filename)VALUES('$title', '$year', '$comment', '$media', '$genre', '$grade', '$username', '$file');";
                $this->db->query($sql);
                header("location: index.php");
                return true;
            }
        } else {
            return true;
        }
    }

    public function setTitle(string $title): bool
    {
        if ($title != "") {
            $this->title = $title;
            return true;
        } else {
            return false;
        }
    }
    public function setComment(string $comment): bool
    {
        if ($comment != "") {
            $this->comment = $comment;
            return true;
        } else {
            return false;
        }
    }














    // get post
    // public function getPost(string $title, string $comment): bool
    // {
    //     $sql = "SELECT * FROM posts;";
    //     $this->db->query($sql);
    //     return true;
    // }

    //get all stored post
    public function printPostsAll(): array
    {
        $sql = "SELECT * FROM posts ORDER BY created DESC LIMIT 5;";
        $result = $this->db->query($sql); //lagrar svaret från servern i $result
        return mysqli_fetch_all($result, MYSQLI_ASSOC); // lagrar i associativ array så det blir lättare att skriva ut på sidan
    }

    //get all stored films
    public function printPostsFilms(): array
    {
        $sql = "SELECT * FROM posts WHERE media='film' ORDER BY created DESC;";
        $result = $this->db->query($sql); //lagrar svaret från servern i $result
        return mysqli_fetch_all($result, MYSQLI_ASSOC); // lagrar i associativ array så det blir lättare att skriva ut på sidan
    }

    //get all stored series
    public function printPostsSeries(): array
    {
        $sql = "SELECT * FROM posts WHERE media='serie' ORDER BY created DESC;";
        $result = $this->db->query($sql); //lagrar svaret från servern i $result
        return mysqli_fetch_all($result, MYSQLI_ASSOC); // lagrar i associativ array så det blir lättare att skriva ut på sidan
    }

    //get all stored documentaris
    public function printPostsDoc(): array
    {
        $sql = "SELECT * FROM posts WHERE media='dokumentär' ORDER BY created DESC;";
        $result = $this->db->query($sql); //lagrar svaret från servern i $result
        return mysqli_fetch_all($result, MYSQLI_ASSOC); // lagrar i associativ array så det blir lättare att skriva ut på sidan
    }

    //get one specific post to info.php when clicked
    public function printPostSpec($id)
    {
        $sql = "SELECT * FROM posts WHERE id='$id';";
        $result = $this->db->query($sql); //lagrar svaret från servern i $result
        return mysqli_fetch_all($result, MYSQLI_ASSOC); // lagrar i associativ array så det blir lättare att skriva ut på sidan
    }

    //get all posts by the logged in user
    public function printMyPosts($username)
    {
        $sql = "SELECT * FROM posts WHERE username='$username' ORDER BY created DESC;";
        $result = $this->db->query($sql); //lagrar svaret från servern i $result
        return mysqli_fetch_all($result, MYSQLI_ASSOC); // lagrar i associativ array så det blir lättare att skriva ut på sidan
    }

    //get all posts from specific user
    public function printPostUser($username)
    {
        $sql = "SELECT * FROM posts WHERE username='$username' ORDER BY created DESC;";
        $result = $this->db->query($sql); //lagrar svaret från servern i $result
        return mysqli_fetch_all($result, MYSQLI_ASSOC); // lagrar i associativ array så det blir lättare att skriva ut på sidan
    }

    //print users on index.php
    public function printUsers()
    {
        $sql = "SELECT username FROM users ORDER BY created DESC;";
        $result = $this->db->query($sql); //lagrar svaret från servern i $result
        return mysqli_fetch_all($result, MYSQLI_ASSOC); // lagrar i associativ array så det blir lättare att skriva ut på sidan
    }





    //get edit post values
    public function getEditPost($id)
    {
        $sql = "SELECT * FROM posts WHERE id='$id' ORDER BY created DESC;";
        $result = $this->db->query($sql); //lagrar svaret från servern i $result
        // return mysqli_fetch_all($result, MYSQLI_ASSOC);  lagrar i associativ array så det blir lättare att skriva ut på sidan
        return mysqli_fetch_assoc($result); //returnerar endast en rad istället för en hel array
    }

    //add edit post values to db
    public function addEditPost(string $title, int $id, int $year, string $comment, string $media, string $genre, int $grade, $file): bool
    {

        //flyttar filen till rätt katalog
        move_uploaded_file($_FILES['file']['tmp_name'], "postsimages/" . $_FILES['file']['name']);
        $file = $_FILES['file']['name'];

        $title = $this->db->real_escape_string($title);
        $year = $this->db->real_escape_string($year);
        $comment = $this->db->real_escape_string($comment);

        //SQL fråga
        $sql = "UPDATE posts SET title = '$title', year = '$year', comment = '$comment', media = '$media', genre = '$genre', grade = '$grade', filename = '$file' WHERE id = '$id';";
        $this->db->query($sql);
        header("location: myposts.php");
        return true;
    }










    // delete post
    public function deletePost(string $id): bool
    {
        $sql = "DELETE FROM posts WHERE id=$id;";
        return $this->db->query($sql);
        return true;
    }



    //destructor
    function __destruct()
    {
        $this->db->close();
    }
}
