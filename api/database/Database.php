<?php


class Database
{
    protected $servername = "127.0.0.1";
    protected $username = "root";
    protected $password = "";
    protected $db = "ecomebli";
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