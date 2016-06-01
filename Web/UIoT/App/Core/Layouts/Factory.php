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

namespace UIoT\App\Core\Layouts;

use UIoT\App\Data\Singletons\LayoutSingleton;
use UIoT\App\Helpers\Manipulation\Strings;

/**
 * Class Indexer
 * @package UIoT\App\Data\Layouts
 */
final class Factory
{
    /**
     * Check if Layout Exists
     *
     * @param string $layoutName
     * @return bool
     */
    public static function exists($layoutName)
    {
        return self::get($layoutName) !== null;
    }

    /**
     * Get Layout Instance
     *
     * @param $layoutName
     * @return LayoutSingleton
     */
    public static function get($layoutName)
    {
        return self::call($layoutName, 'getInstance');
    }

    /**
     * Call Layout static method.
     *
     * @param string $layoutName Layout Name
     * @param string $layoutMethod Layout Method
     * @return mixed Layout Method Return
     */
    public static function call($layoutName, $layoutMethod)
    {
        return forward_static_call(['UIoT\App\Data\Layouts\\' . Strings::toCamel($layoutName), $layoutMethod]);
    }
}
