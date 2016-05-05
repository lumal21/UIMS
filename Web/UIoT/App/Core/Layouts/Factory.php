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

/**
 * Class Indexer
 * @package UIoT\App\Data\Layouts
 */
final class Factory
{
    /**
     * @var array
     */
    private static $layout = [];

    /**
     * Add a Layout
     *
     * @param string $layoutName
     * @return string
     */
    public static function addLayout($layoutName)
    {
        self::layoutExists($layoutName) || array_push(self::$layout, $layoutName);

        return $layoutName;
    }

    /**
     * Check if Layout Exists
     *
     * @param string|LayoutSingleton $layoutName
     * @return bool
     */
    public static function layoutExists($layoutName)
    {
        return in_array($layoutName, self::$layout);
    }

    /**
     * Return Instance of Layout
     *
     * @param string $layoutName
     * @return string
     */
    public static function getLayout($layoutName)
    {
        return self::layoutExists($layoutName) ? self::callLayoutStaticMethod($layoutName, 'executeLayout') : '';
    }

    /**
     * Call Layout static method.
     *
     * @param string $layoutName
     * @param string $layoutMethod
     * @return mixed
     */
    public static function callLayoutStaticMethod($layoutName, $layoutMethod)
    {
        return forward_static_call(["UIoT\\App\\Data\\Layouts\\$layoutName", $layoutMethod]);
    }

    /**
     * Get the Layout Resources
     *
     * @param string $layoutName
     */
    public static function getLayoutResources($layoutName)
    {
        self::callLayoutStaticMethod($layoutName, 'callResource');
    }
}
