<?php

class Newroute
{

    //properties
    private $db;
    private $location;
    private $kilometers;
    private $parking;
    private $toll;
    private $date;

    //constructor
    function __construct()
    {
        // $this->db = new mysqli('localhost', 'root', 'root', 'milesdb');
        $this->db = new mysqli('studentmysql.miun.se', 'luha2200', 'jordenrunt', 'luha2200');
        if ($this->db->connect_errno > 0) {
            die('fel vid anslutning till databasen: ' . $this->db->connect_error);
        }
    }

    // add post
    public function addRoute(string $location, int $kilometers, int $parking, int $toll, string $date): bool
    {

        //sanitera med real_escape_string
        $location = $this->db->real_escape_string($location);
        $kilometers = $this->db->real_escape_string($kilometers);
        $parking = $this->db->real_escape_string($parking);
        $toll = $this->db->real_escape_string($toll);
        $date = $this->db->real_escape_string($date);

        //SQL fråga
        $sql = "INSERT INTO route(location, kilometers, parking, toll, datetime)VALUES('$location', '$kilometers', '$parking', '$toll', '$date');";
        $this->db->query($sql);
        $_SESSION['routecreated'] = "The route has been registrered!";
        header("location: index.php");
        return true;
    }


    //print kilometers
    public function printKilometers(): array
    {
        // $sql = "SELECT price FROM payments WHERE name='Lucas';";
        $sql = "SELECT SUM(kilometers) FROM route";
        $result = $this->db->query($sql); //lagrar svaret från servern i $result

        if ($result->num_rows > 0) {
            return mysqli_fetch_all($result, MYSQLI_ASSOC); // lagrar i associativ array så det blir lättare att skriva ut på sidan
        } else {
            $result = ["0", "0", "0"];
            return $result; // lagrar i associativ array så det blir lättare att skriva ut på sidan

        }
    }


    //print parking
    public function printParking(): array
    {
        $sql = "SELECT SUM(parking) FROM route";
        $result = $this->db->query($sql); //lagrar svaret från servern i $result

        if ($result->num_rows > 0) {
            return mysqli_fetch_all($result, MYSQLI_ASSOC); // lagrar i associativ array så det blir lättare att skriva ut på sidan
        } else {
            $result = ["0", "0", "0"];
            return $result; // lagrar i associativ array så det blir lättare att skriva ut på sidan

        }
    }

        //print toll
        public function printToll(): array
        {
            $sql = "SELECT SUM(toll) FROM route";
            $result = $this->db->query($sql); //lagrar svaret från servern i $result
    
            if ($result->num_rows > 0) {
                return mysqli_fetch_all($result, MYSQLI_ASSOC); // lagrar i associativ array så det blir lättare att skriva ut på sidan
            } else {
                $result = ["0", "0", "0"];
                return $result; // lagrar i associativ array så det blir lättare att skriva ut på sidan
    
            }
        }

    //print all in routes.php
    public function printAll(): array
    {
        $sql = "SELECT * FROM route ORDER BY datetime DESC;";
        $result = $this->db->query($sql); //lagrar svaret från servern i $result
        return mysqli_fetch_all($result, MYSQLI_ASSOC); // lagrar i associativ array så det blir lättare att skriva ut på sidan
    }


    //delete payment
    public function deleteRoute(string $id_payment): bool
    {
        $sql = "DELETE FROM route WHERE id=$id_payment;";
        return $this->db->query($sql);
        header("location: index.php");
        return true;
    }
    // delete ALL
    public function deleteAll(): bool
    {
        $sql = "DELETE FROM route;";
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
