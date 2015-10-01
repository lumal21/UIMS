<?php

/**
 * UIoT CMS
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
 * @app UIoT Content Management System
 * @author UIoT
 * @developer Claudio Santoro
 * @copyright University of Brasília
 */


namespace UIoT\App\Classes\Helpers;

use stdClass;
use UIoT\App\Data\Models\RequestData;

/**
 * Class JsonHelper
 * @package UIoT\App\Classes\Helpers
 */
final class JsonHelper
{
    /**
     * Convert an Array of Standard Objects in an Array of Closure Objects
     *
     * @param array $k
     * @return array
     */
    static function valueArrayObjectToClosure(array $k = [])
    {
        /* create the garbage array */
        $v = [];

        /* foreach every item */
        foreach ($k as $index => $object) $v[] = self::createClosure($object);

        /* return the final array */
        return $v;
    }

    /**
     * Create Closure
     *
     * @param stdClass $object
     * @return RequestData
     */
    static function createClosure(stdClass $object)
    {
        return new RequestData($object);
    }
}