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

namespace UIoT\App\Core\Helpers\Manipulators;

/**
 * Class Constants
 * @package UIoT\App\Core\Helpers\Manipulators
 */
final class Constants
{
    /**
     * Define a Constant with jSON
     *
     * @param string $a Name
     * @param mixed $b Value
     * @param int $c jSON Options
     */
    static function __addJConstant($a, $b = '', $c = 0)
    {
        self::__addConstant($a, json_encode($b, $c));
    }

    /**
     * Define a Constant
     *
     * @param string $a Name
     * @param mixed $b Value
     */
    static function __addConstant($a, $b = '')
    {
        defined($a) || define($a, $b);
    }
}