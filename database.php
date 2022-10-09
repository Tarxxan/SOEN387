<?php

class database
{
    private $host;
    private $user;
    private $pw;
    private $database;
    private $port;
    public $failedConnection = false;

    function __construct()
    {

        $json = file_get_contents("databaseDetails.json");
        $config = json_decode($json, true);
        $this->host = $config["Data"][0]["Hostname"];
        $this->user = $config["Data"][0]["Username"];
        $this->pw = $config["Data"][0]["Password"];
        $this->port = $config["Data"][0]["Port"];
        $this->database = $config["Data"][0]["Database"];
        $this->failedConnection = true;
    }


    public function db_connect()
    {
        echo $this->user;
        echo $this->port;
        echo $this->database;
        echo $this->pw;
        echo $this->host;
        $mysqli = mysqli_connect($this->host, $this->user, $this->pw, $this->database,$this->port);
        if ($mysqli->connect_errno) {
            echo "done";
           $this->failedConnection = true;
        }
        return $mysqli;
    }
}