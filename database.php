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

        //$json = file_get_contents("databaseDetails.json");
        //$config = json_decode($json, true);
        $this->host = "containers-us-west-100.railway.app";
        $this->user = "root";
        $this->pw = "R7z7HwpuHJMDlpKXrBO9";
        $this->port = 6568;
        $this->database = "railway";
    }


    public function db_connect()
    {
        $dsn="mysql:host=".$this->host.";port=".$this->port."dbname=".$this->database;
        return new PDO($dsn, $this->user, $this->pw);
    }
}