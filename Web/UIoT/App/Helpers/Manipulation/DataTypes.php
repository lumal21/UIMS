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

use UIoT\App\Data\Models\Parsers\PropertyObject;

/**
 * Class DataTypes
 * @package UIoT\App\Helpers\Manipulation
 */
class DataTypes
{
    /**
     * @var array List of Disabled events
     */
    private static $disabledEvents = [
        'udn',
        'upc',
        'id',
        'xml_uri'
    ];

    /**
     * Return a filtered array without disabled item
     *
     * @param array $propertiesArray
     *
     * @return array
     */
    public static function removeDisabledTypes($propertiesArray)
    {
        return array_filter($propertiesArray, function (PropertyObject $propertyObject) {
            return Arrays::inArray($propertyObject->PROP_FRIENDLY_NAME, self::$disabledEvents) !== true;
        });
    }

    /**
     * Return Specific Data Type Value
     *
     * @param string $itemKey
     *
     * @return mixed
     */
    public static function getTypeValue($itemKey)
    {
        switch (strtolower($itemKey)) {
            case 'time':
                return date('Y-m-d H:i:s', time());
            default:
                return '';
        }
    }
}
