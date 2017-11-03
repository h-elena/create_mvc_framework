<?php

namespace Helpers;

/**
 * Class WorkWithString
 *  Class for working with strings and texts
 * @package Helpers
 */
class WorkWithString
{
    /**
     * Find tags and data in text
     *
     * @param $str
     *  Current text
     * @return array
     */
    public static function findTagAndData($str){
        $masTagData = [];
        if(preg_match_all('/\[(.*?)\:/ui', $str, $matchesKeys)){
            if(preg_match_all('/\](.*?)\[/ui', $str, $matchesData)){
                foreach ($matchesKeys[1] as $key => $val){
                    $masTagData[] = [
                        $val => $matchesData[1][$key]
                    ];
                }
            }
        }
        return $masTagData;
    }

    /**
     * Find tads and description in text
     *
     * @param $str
     *  Current text
     * @return array
     */
    public static function findTagAndDesc($str){
        $masTagDesc = [];
        if(preg_match_all('/\[(.*?)\:/ui', $str, $matchesKeys)){
            if(preg_match_all('/\:(.*?)\]/ui', $str, $matchesData)){
                foreach ($matchesKeys[1] as $key => $val){
                    $masTagDesc[] = [
                        $val => $matchesData[1][$key]
                    ];
                }
            }
        }
        return $masTagDesc;
    }
}