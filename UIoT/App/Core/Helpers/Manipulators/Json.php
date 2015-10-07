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
 * @copyright University of Bras�lia
 */

namespace UIoT\App\Core\Helpers\Manipulators;

use stdClass;
use UIoT\App\Data\Models\RequestData;

/**
 * Class Json
 * @package UIoT\App\Core\Helpers\Manipulators
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
        foreach ($k as $index => $object) {
            $v[] = self::createClosure($object);
        }

        /* return the final array */
        return $v;
    }

    /**
     * Create Closure
     *
     * @param stdClass $object
     * @return RequestData
     */
    public static function createClosure(stdClass $object)
    {
        return new RequestData($object);
    }
}