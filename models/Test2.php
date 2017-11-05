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

    public function getAllTreeFromSql(){
        $sql = "SELECT t1.name AS name1, t2.name AS name2, t3.name AS name3, t4.name AS name4, t5.name AS name5, 
                  t6.name AS name6, t7.name AS name7
                FROM tree t1
                  LEFT JOIN tree t2 ON t2.parent=t1.id
                  LEFT JOIN tree t3 ON t3.parent=t2.id
                  LEFT JOIN tree t4 ON t4.parent=t3.id
                  LEFT JOIN tree t5 ON t5.parent=t4.id
                  LEFT JOIN tree t6 ON t6.parent=t5.id
                  LEFT JOIN tree t7 ON t7.parent=t6.id
                WHERE t1.parent IS NULL
                ORDER BY t1.id, t2.name, t3.name, t4.name, t5.name, t6.name, t7.name";
        if($res = $this->getSql($sql, 'num')){
            return $res;
        }
        else {
            return false;
        }
    }

    /**
     * Create sql query and get all childs hoo has 2 parent
     *
     * @return array|bool
     */
    public function getChildsHave2Parent(){
        $sql = "SELECT t1.*
            FROM tree AS t1
            JOIN tree AS t2 ON t2.id=t1.parent
            JOIN tree AS t3 ON t3.id=t2.parent
            LEFT JOIN tree AS t4 ON t4.parent=t1.id
            WHERE t4.id IS NULL";
        if($res = $this->getSql($sql, 'assoc')){
            return $res;
        }
        else {
            return false;
        }
    }

    public function outTree($mas){
        $res = '';
        $prevMas = [];
        foreach ($mas as $m){
            foreach ($m as $key => $subM){
                if(empty($subM)){
                    continue;
                }
                if(empty($res)){
                    $res .= $subM.'<br>';
                }
                elseif (empty($prevMas) || (!empty($prevMas) && !in_array($subM, $prevMas))){
                    if($key > 0){
                        for ($i=0;$i<$key;$i++){
                            $res .= '&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;';
                        }
                    }
                    $res .= ($key > 0 ? '->' : '').$subM.'<br>';
                }
            }
            $prevMas = $m;
        }

        return $res;
    }

}