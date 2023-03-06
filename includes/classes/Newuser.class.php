<?php

class Newuser
{

    //properties
    private $db;
    private $firstname;
    private $lastname;
    private $email;
    private $username;
    private $password;
    private $repeatpassword;

    //constructor
    function __construct()
    {
        $this->db = new mysqli('localhost', 'root', 'root', 'blogsdb');
        if ($this->db->connect_errno > 0) {
            die('fel vid anslutning: ' . $this->db->connect_error);
        }
    }

    //add user
    public function addUser(string $firstname, string $lastname, string $email, string $username, string $password, string $memory, string $repeatpassword): bool
    {

        if (!$this->setFirstname($firstname)) return false;
        if (!$this->setLastname($lastname)) return false;
        if (!$this->validEmail($email)) return false;
        if (!$this->emailTaken($email)) return false;
        // if (!$this->setEmail($email)) return false;
        if (!$this->setUsername($username)) return false;
        if (!$this->setPassword($password)) return false;
        if (!$this->repeatPassword($repeatpassword, $password)) return false;

        $sql = "SELECT username FROM users WHERE username='$username';";
        $result = $this->db->query($sql);

        //sanitera med read_escape_string
        $username = $this->db->real_escape_string($username);
        $password =  $this->db->real_escape_string($password);
        $repeatpassword =  $this->db->real_escape_string($repeatpassword);
        $email =  $this->db->real_escape_string($email);
        $firstname =  $this->db->real_escape_string($firstname);
        $lastname =  $this->db->real_escape_string($lastname);
        $memory =  $this->db->real_escape_string($memory);
        $hashed_password = password_hash($password, PASSWORD_DEFAULT);


        if ($result->num_rows > 0) {
            echo "<p class='message error'> Användarnamnet är redan upptaget! </p>";
            return false;
        } else {
            $sql = "INSERT INTO users(username, password, firstname, lastname, email, memory)VALUES('$username', '$hashed_password', '$firstname', '$lastname', '$email', '$memory');";
            header("location: login.php");
            $_SESSION['accountcreated'] = "Ditt konto har skapats";
            return $this->db->query($sql);
        }
    }


    public function setFirstname(string $firstname): bool
    {
        if ($firstname != "") {
            $this->firstname = $firstname;
            return true;
        } else {
            return false;
        }
    }
    public function setLastname(string $lastname): bool
    {
        if (($lastname) != "") {
            $this->lastname = $lastname;
            return true;
        } else {
            return false;
        }
    }

    public function emailTaken(string $email): bool
    {
        $sql = "SELECT email FROM users WHERE email='$email';";
        $result = $this->db->query($sql);

        if ($result->num_rows < 1) {
            $this->email = $email;
            return true;
        } else {
            return false;
        }
    }

    public function validEmail(string $email): bool
    {
        if (filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $this->email = $email;
            return true;
        } else {
            return false;
        }
    }


    // public function setEmail(string $email): bool
    // {
    //     if (($email) != "") {
    //         $this->email = $email;
    //         return true;
    //     } else {
    //         return false;
    //     }
    // }
    public function setUsername(string $username): bool
    {
        if (($username) != "") {
            $this->username = $username;
            return true;
        } else {
            return false;
        }
    }
    public function setPassword(string $password): bool
    {
        if (strlen($password) > 4 && preg_match('/[A-Za-z]/', $password) && preg_match('/[0-9]/', $password)) {
            $this->password = $password;
            return true;
        } else {
            return false;
        }
    }
    public function repeatPassword(string $repeatpassword, string $password): bool
    {
        if ($repeatpassword != $password) {
            return false;
        } else {
            $this->repeatpassword = $repeatpassword;
            return true;
        }
    }


    //login user
    public function getUser(string $username, string $password): bool
    {
        $sql = "SELECT * FROM users WHERE username='$username';";
        $result = $this->db->query($sql);

        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();
            $stored_password = $row['password'];

            if (password_verify($password, $stored_password)) { // om den här returnerar sant
                $_SESSION['username'] = $username;
                header("location: index.php");
            } else {
                echo "<p class='error message'><i class='fa-solid fa-triangle-exclamation'></i> &nbsp; Du har skrivit in fel lösenord.</p>";
                return false;
            }
        } else {
            echo "<p class='error message'><i class='fa-solid fa-triangle-exclamation'></i> &nbsp; Du har skrivit in fel användarnamn eller lösenord.</p>";
            return false;
        }
    }

    //print user


    //destructor
    function __destruct()
    {
        // unset($this->db);
        $this->db->close();
    }
}
