<?php

namespace Alcodo\PowerImage\Handler;

use function str_replace;

class ParamsHelper
{
    /**
     * It converts a string to params.
     *
     * from:
     * w=300&h=300&fit=crop
     * w:200,h:200
     *
     * to:
     * ['w' => 300, 'h' => 300, 'fit' => 'crop']
     *
     * @param $prefix
     *
     * @return array
     */
    public static function parseToArray($parameterString)
    {
        $result = [];
        $eachType = explode('&', $parameterString);

        foreach ($eachType as $typeWithValue) {
            list($parameter, $value) = explode('=', $typeWithValue);
            $result[$parameter] = $value;
        }

        return $result;
    }

    /**
     * @param array $params
     *
     * @return string
     */
    public static function parseToString(array $params): string
    {
        $result = [];

        foreach ($params as $parameter => $value) {
            $result[] = $parameter.'='.$value;
        }

        return implode('&', $result);
    }

    /**
     * from:
     * images/car_w=300&h=200.jpg.
     *
     * to:
     * w=300&h=200
     *
     * @param $path
     * @param $fileextension
     *
     * @return bool
     */
    public static function getParameterString($path, $fileextension)
    {
        //get all occurances of delimiter
        $arr = explode('_', $path);
        //grab last occurance
        $string = end($arr);
        //remove extension
        $string =  str_replace('.' . $fileextension, '', $string);

        if (!isset($string) || empty($string)) {
            return false;
        }
        return $string;
    }
}
