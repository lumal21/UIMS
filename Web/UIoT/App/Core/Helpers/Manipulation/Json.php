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

namespace UIoT\App\Core\Helpers\Manipulation;

use stdClass;
use UIoT\App\Data\Models\RequestDataModel;

/**
 * Class Json
 * @package UIoT\App\Core\Helpers\Manipulation
 */
final class Json
{
    /**
     * Convert an Array of Standard Objects in an Array of Closure Objects
     *
     * @param array $k
     * @return array
     */
    public static function valueArrayObjectToClosure(array $k = [])
    {
        /* create the garbage array */
        $v = [];

        /* foreach every item */
        foreach ($k as $index => $object)
            $v[] = self::createClosure($object);

        return $v;
    }

    /**
     * Create Closure
     *
     * @param stdClass $object
     * @return RequestDataModel
     */
    public static function createClosure(stdClass $object)
    {
        return new RequestDataModel($object);
    }

    /**
     * Is a Reference to Arrays::isInstanceOfClosure()
     *
     * @param string $x
     * @return mixed
     */
    public static function isInstanceOfClosure($x)
    {
        return Arrays::checkIsInstanceOf($x, 'Closure');
    }

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
