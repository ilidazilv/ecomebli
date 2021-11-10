<?php

use DevCoder\DotEnv;

ini_set('display_errors', '1');
ini_set('display_startup_errors', '1');
error_reporting(E_ALL);

require '../DevCoder.php';

(new DotEnv(false))->load();

class Database
{
    protected $servername = "";
    protected $username = "";
    protected $password = "";
    public $db = "";
    public function __construct(){
        $this->servername = getenv('DATABASE_HOST');
        $this->username = getenv('DATABASE_USER');
        $this->password = getenv('DATABASE_PASSWORD');
        $this->db = getenv('DATABASE_NAME');
    }
    public function lastInsertId() {
        try{
            $dsn = "mysql:host=$this->servername;" . "dbname=$this->db" . ';charset=utf8';
            $connection = new PDO($dsn, $this->username, $this->password);
            $connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            return $connection->lastInsertId();
        } catch(PDOException $e) {
            error_log("Uncaught exception class=" . get_class($e) . " message=" . $e->getMessage() . " line=" . $e->getLine());
            ob_end_clean(); # try to purge content sent so far
            header('HTTP/1.1 500 Internal Server Error');
            echo 'Internal error ' . $e->getMessage();
            return $e->getMessage();
        }
    }
    public function doRequestWithNoAnswer($sql, $useDB) {
        try{
            $dsn = "mysql:host=$this->servername;" . (($useDB) ? "dbname=$this->db" : '' . ';charset=utf8');
            $connection = new PDO($dsn, $this->username, $this->password);
            $connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            $stmt = $connection->prepare($sql);
            $stmt->execute();
            echo $sql . "<br> Success";
        } catch(PDOException $e) {
            error_log("Uncaught exception class=" . get_class($e) . " message=" . $e->getMessage() . " line=" . $e->getLine());
            ob_end_clean(); # try to purge content sent so far
            header('HTTP/1.1 500 Internal Server Error');
            echo 'Internal error ' . $e->getMessage();
            return $e->getMessage();
        }
    }
    public function doRequest($sql, $useDB, $fetchAll) {
        try {
            $dsn = "mysql:host=$this->servername;" . (($useDB) ? "dbname=$this->db" : '') . ";charset=utf8";
            $connection = new PDO($dsn, $this->username, $this->password);
            $connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $stmt = $connection->prepare($sql);
            $stmt->execute();
            if($fetchAll){
                return $stmt->fetchAll();
            } else {
                return $stmt->fetch();
            }
        } catch(PDOException $e) {
            error_log("Uncaught exception class=" . get_class($e) . " message=" . $e->getMessage() . " line=" . $e->getLine());
            ob_end_clean(); # try to purge content sent so far
            header('HTTP/1.1 500 Internal Server Error');
            echo 'Internal error ' . $e->getMessage();
            return $e->getMessage();
        }
    }
    public function doRequestWithVar($sql, $variables, $insert, $id) {
        try{
            $dsn = "mysql:host=$this->servername;" . "dbname=$this->db" . ";charset=utf8";
            $connection = new PDO($dsn, $this->username, $this->password);
            $connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $stmt = $connection->prepare($sql);
            $stmt->execute($variables);
            if($id){
                return $connection->lastInsertId();
            }
            if($insert){
                return true;
            } else {
                return $stmt->fetchAll();
            }
        } catch (PDOException $e){
            error_log("Uncaught exception class=" . get_class($e) . " message=" . $e->getMessage() . " line=" . $e->getLine());
            ob_end_clean(); # try to purge content sent so far
            header('HTTP/1.1 500 Internal Server Error');
            echo 'Internal error ' . $e->getMessage();
            return $e->getMessage();
        }
    }
}
