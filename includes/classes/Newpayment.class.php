<?php

class Newpayment
{

    //properties
    private $db;
    private $name;
    private $price;
    private $comment;

    //constructor
    function __construct()
    {
        // $this->db = new mysqli('localhost', 'root', 'root', 'paymentsdb');
        $this->db = new mysqli('studentmysql.miun.se', 'luha2200', 'jordenrunt', 'luha2200');
        if ($this->db->connect_errno > 0) {
            die('fel vid anslutning till databasen: ' . $this->db->connect_error);
        }
    }

    // add post
    public function addPayment(string $name, int $price, string $comment): bool
    {

        //sanitera med real_escape_string
        $name = $this->db->real_escape_string($name);
        $price = $this->db->real_escape_string($price);
        $comment = $this->db->real_escape_string($comment);

        //SQL fråga
        $sql = "INSERT INTO payments(name, price, comment)VALUES('$name', '$price', '$comment');";
        $this->db->query($sql);
        $_SESSION['paymentcreated'] = "Utgiften har registrerats!";
        header("location: index.php");
        return true;
    }


    //print payments
    public function printPayments(): array
    {
        // $sql = "SELECT price FROM payments WHERE name='Lucas';";
        $sql = "SELECT name,SUM(price) FROM payments GROUP BY name;";
        $result = $this->db->query($sql); //lagrar svaret från servern i $result

        if ($result->num_rows > 0) {
            return mysqli_fetch_all($result, MYSQLI_ASSOC); // lagrar i associativ array så det blir lättare att skriva ut på sidan
        } else {
            $result = ["0", "0", "0"];
            return $result; // lagrar i associativ array så det blir lättare att skriva ut på sidan

        }
    }
    //print all in utgifter.php
    public function printAll(): array
    {
        $sql = "SELECT * FROM payments ORDER BY created DESC;";
        $result = $this->db->query($sql); //lagrar svaret från servern i $result
        return mysqli_fetch_all($result, MYSQLI_ASSOC); // lagrar i associativ array så det blir lättare att skriva ut på sidan
    }




    //delete payment
    public function deletePayment(string $id_payment): bool
    {
        $sql = "DELETE FROM payments WHERE id=$id_payment;";
        return $this->db->query($sql);
        header("location: index.php");
        return true;
    }
    // delete ALL
    public function deleteAll(): bool
    {
        $sql = "DELETE FROM payments;";
        return $this->db->query($sql);
        header("location: index.php");
        return true;
    }



    //destructor
    function __destruct()
    {
        $this->db->close();
    }
}
