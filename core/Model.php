<?php

namespace Core;

use Helpers\Connection;

class Model
{
    public $table;
    public $error;

    function __construct(){
        $this->table = 'test';
    }

    /**
     * Get data from database table
     *
     * @param null $variables
     * @param array $params
     * @return array|bool
     */
    public function getModel($variables = null, $params = []){
        $db = new Connection();
        if(!$db->connect()){
            $this->error = $db->error;
            return false;
        }
        $sql = "SELECT ";
        if(!empty($variables)){
            foreach ($variables as $v){
                $sql .= ":".$v.",";
            }
            $sql = substr($sql, 0, -1);
        }
        else{
            $sql .= "*";
        }
        $sql .= " FROM `".$this->table."`";
        return $db->getSelectSql($sql, $params);
    }

    /**
     * Get data from sql query
     *
     * @param $sql
     * @param string $typeOutputMassive
     * @return array|bool
     */
    public function getSql($sql, $typeOutputMassive = 'assoc'){
        $db = new Connection();
        if(!$db->connect()){
            $this->error = $db->error;
            return false;
        }
        return $db->getSelectSql($sql, [], $typeOutputMassive);
    }

}