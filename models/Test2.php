<?php

namespace Models;

use Core\Model,
    Helpers\Connection;

class Test2 extends Model
{

    public $table;

    function __construct(){
        $this->table = 'tree';
    }

    /**
     * Find all children from massive
     *
     * @param $mas
     * @param $parentId
     * @param int $level
     * @return array
     */
    public function findAllChildren($mas, $parentId, $level = 1){
        $result = [];
        foreach ($mas as $key => $m){
            if($m['parent'] == $parentId){
                unset($mas[$key]);
                $m['children'] = $this->findAllChildren($mas, $m['id']);
                $result[$m['id']] = $m;
            }
        }
        return $result;

    }

    /**
     * Create tree from massive
     *
     * @param $mas
     * @return array
     */
    public function createTree($mas){
        $result = [];
        foreach ($mas as $key => $m){
            if(empty($m['parent'])){
                unset($mas[$key]);
                $m['children'] = $this->findAllChildren($mas, $m['id']);
                $result[$m['id']] = $m;
            }
        }
        return $result;
    }

    /**
     * Output all children of tree in string
     *
     * @param $mas
     * @param int $level
     * @return string
     */
    public function printChilds($mas, $level = 1){
        $res = '';
        foreach ($mas as $key => $m){
            if($level > 1){
                for ($i=0;$i<$level;$i++){
                    $res .= '&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;';
                }
            }
            $res .= ($level > 1 ? '->' : '').$m['name'].'<br>';
            if(!empty($m['children'])){
                $res .= $this->printChilds($m['children'], ($level+1));
            }
        }
        return $res;
    }

    /**
     * Create and output tree in string from massive
     *
     * @param $mas
     * @return string
     */
    public function printTree($mas){
        $tree = $this->createTree($mas);
        $s = '';
        if(!empty($tree)){
            $s = $this->printChilds($tree);
        }
        return $s;
    }

    public function getChildsHave2Parent(){
        $sql = "SELECT t1.*
            FROM tree AS t1
            JOIN tree AS t2 ON t2.id=t1.parent
            JOIN tree AS t3 ON t3.id=t2.parent
            LEFT JOIN tree AS t4 ON t4.parent=t1.id
            WHERE t4.id IS NULL";
        if($res = $this->getSql($sql)){
            return $res;
        }
        else {
            return false;
        }
    }

}