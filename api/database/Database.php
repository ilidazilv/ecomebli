<?php

use DevCoder\DotEnv;

require '../DevCoder.php';

(new DotEnv(false))->load();

class Database
{
    protected $servername = "";
    protected $username = "";
    protected $password = "";
    protected $db = "";
    public function __construct(){
        $this->servername = getenv('DATABASE_HOST');
        $this->username = getenv('DATABASE_USER');
        $this->password = getenv('DATABASE_PASSWORD');
        $this->db = getenv('DATABASE_NAME');
    }
    public function doRequestWithNoAnswer($sql, $useDB) {
        try{
            $dsn = "mysql:host=$this->servername;" . (($useDB) ? "dbname=$this->db" : '');
            $connection = new PDO($dsn, $this->username, $this->password);
            $connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            $stmt = $connection->prepare($sql);
            $stmt->execute();
            echo $sql . "<br> Success";
        } catch(PDOException $e) {
            echo $sql . "<br>" . $e->getMessage() . "<br/>";
        }
    }
    public function doRequest($sql, $useDB) {
        $dsn = "mysql:host=$this->servername;" . (($useDB) ? "dbname=$this->db" : '');
        $connection = new PDO($dsn, $this->username, $this->password);
        $connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $stmt = $connection->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll();
    }
}