<?php

namespace Models;


class Test3
{
    /**
     * @param $mas
     * @return array
     */
    public function createNewMas($mas){
        $result = [];
        $beginMas = current($mas);
        $i = 0;
        foreach ($beginMas as $submas){
            if(!empty($mas[$i+1])){
                $res = $this->createSubMas($mas, [$submas], ($i+1));
                $result = array_merge($result, $res);
            }
        }

        return $result;
    }

    /**
     * @param $mas
     * @param $elemArray
     * @param $i
     * @return array
     */
    public function createSubMas($mas, $elemArray, $i){
        $currentMas = $mas[$i];
        $result = [];
        foreach ($currentMas as $submas){
            if(!empty($mas[$i+1])){
                $subArray = array_merge($elemArray, [$submas]);
                $res = $this->createSubMas($mas, $subArray, ($i+1));
                $result = array_merge($result, $res);
            }
            else{
                array_push($elemArray, $submas);
                $result[] = $elemArray;
            }
        }
        return $result;
    }
}