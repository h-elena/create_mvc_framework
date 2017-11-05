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
        if(preg_match_all('/(?<=\[)(.*?)(?=\:)|(?<=\[)([^\:\/]+)(?=\])/u', $str, $matchesTags)){
            foreach ($matchesTags[0] as $val){
                if(preg_match_all('/(?<=\])(.*?)(?=\[\/'.$val.'])/u', $str, $matchesData)){
                    foreach ($matchesData[0] as $v){
                        $masTagData[$val] = $v;
                    }
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
        if(preg_match_all('/(?<=\[)(.*?)(?=\:)|(?<=\[)([^\:\/]+)(?=\])/ui', $str, $matchesTags)){
            foreach ($matchesTags[0] as $val){
                if(preg_match_all('/(?<=\['.$val.'\:)(.*?)(?=\])/u', $str, $matchesData)){
                    foreach ($matchesData[0] as $v){
                        $masTagDesc[$val] = $v;
                    }
                }
            }
        }
        return $masTagDesc;
    }
}