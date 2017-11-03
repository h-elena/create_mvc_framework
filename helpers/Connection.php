<?php

namespace Helpers;


/**
 * Class Connection
 *  Class for work with database
 */
class Connection
{

    public $dbName, $dbHost, $dbUser, $dbPassw, $error, $connection;

    function __construct(){
        $this->error = '';
        include($_SERVER['DOCUMENT_ROOT'].'/configuration/config.php');
        if(empty($config['db']) || empty($config['db']['host']) || empty($config['db']['name']) || empty($config['db']['user'])){
            $this->error = 'Пустое подключение к базе в конфиге.';
        }

        $this->dbHost = $config['db']['host'];
        $this->dbName = $config['db']['name'];
        $this->dbUser = $config['db']['user'];
        $this->dbPassw = $config['db']['passw'];
    }

    public function connect(){
        if(!empty($this->error)){
            return false;
        }

        try {
            $this->connection = new \PDO("mysql:dbname=$this->dbName;host=$this->dbHost", $this->dbUser, $this->dbPassw);
            $this->connection->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION);
            $this->connection->exec("set names utf8");
        }
        catch(PDOException $e) {
            $this->error = $e->getMessage();
            return false;
        }

        return true;
    }

    public function getSelectSql($sql, $params = []){
        if(empty($sql)){
            $this->error = 'Пустой запрос.';
            return false;
        }
        $statement = $this->connection->prepare($sql);
        if(empty($params)){
            $statement->execute();
        }
        else{
            $statement->execute($params);
        }
        $statement->setFetchMode(\PDO::FETCH_ASSOC);
        $result = [];
        while($res = $statement->fetch()) {
            $result[] = $res;
        }

        return $result;
    }


}