<?php

namespace vcinsidedigital\DB;

use PDO;

class Sql
{
    private $conn;
    private $host;
    private $user;
    private $password;
    private $db;

    public function __construct()
    {
        global $config;
        $this->host = $config['HOST'];
        $this->user = $config['USER'];
        $this->password = $config['PASSWORD'];
        $this->db = $config['DB'];
        $this->conetar();
    }

    public function conetar($test = false)
    {
        if($test)
        {
            try
            {
                $this->conn = new PDO("mysql:dbname=".$this->db.";host=".$this->host, $this->user,$this->password, array(\PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8"));
                echo "Connection made successfully.";
                exit;
            }catch(\Exception $e)
            {
                echo "Code: ".$e->getCode()."<br>";
                echo "Message: ". $e->getMessage();
                exit;
            }
        }else
        {
            $this->conn = new PDO("mysql:dbname=".$this->db.";host=".$this->host, $this->user,$this->password, array(\PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8"));
        }
    }

    private function setParams($statement, $parameters = array())
    {
       foreach ($parameters as $key => $value)
       {
           $this->bindParam($statement, $key, $value);
       }
    }

    private function bindParam($statement, $key, $value)
    {
        $statement->bindParam($key, $value);
    }

    public function query($rawQuery, $params = array())
    {
        $stmt = $this->conn->prepare($rawQuery);
        $this->setParams($stmt, $params);
        $stmt->execute();
    }

    public function select($rawQuery, $params = array()):array
    {
        $stmt = $this->conn->prepare($rawQuery);
        $this->setParams($stmt, $params);
        $stmt->execute();
        return $stmt->fetchAll(\PDO::FETCH_ASSOC);
    }
}