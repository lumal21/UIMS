<?php

/**
 * UIoTuims
 * @version dev-alpha
 *                          88
 *                          ""              ,d
 *                                          88
 *              88       88 88  ,adPPYba, MM88MMM
 *              88       88 88 a8"     "8a  88
 *              88       88 88 8b       d8  88
 *              "8a,   ,a88 88 "8a,   ,a8"  88,
 *               `"YbbdP'Y8 88  `"YbbdP"'   "Y888
 *
 * @project Uniform Internet of Things
 * @app UIoT User-Friendly Management System
 * @author UIoT
 * @developer Claudio Santoro
 * @developer Igor Moraes
 * @copyright University of Brasília
 */

namespace UIoT\App\Helpers\Manipulation;

/**
 * Class Json
 * @package UIoT\App\Helpers\Manipulation
 */
final class Json
{
    /**
     * Encode as jSON
     *
     * @param mixed|array|object|null $data
     * @param int $options
     * @return string
     */
    public static function jsonEncode($data = [], $options = 0)
    {
        return json_encode($data, $options);
    }

    /**
     * Decode jSON
     *
     * @param string $data
     * @return mixed|array|object
     */
    public static function jsonDecode($data = '')
    {
        return json_decode($data);
    }
}
