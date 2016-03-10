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
 * @developer Igor Moraes
 * @copyright University of Brasília
 */

namespace UIoT\App\Core\Layouts;

use UIoT\App\Data\Singletons\LayoutSingleton;

/**
 * Class Indexer
 *
 * @package UIoT\App\Data\Layouts
 */
final class Indexer
{
    /**
     *
     * Layout Array
     *
     * @var array
     */
    private static $layout = [];

    /**
     *
     * Add a Layout
     *
     * @param string $layout_name
     */
    public static function addLayout($layout_name)
    {
        self::layoutExists($layout_name) || array_push(self::$layout, $layout_name);
    }

    /**
     *
     * Check if Layout Exists
     *
     * @param string|LayoutSingleton $layout_name
     *
     * @return bool
     */
    public static function layoutExists($layout_name)
    {
        return in_array($layout_name, self::$layout);
    }

    /**
     *
     * Return Instance of Layout
     *
     * @param string $layout_name
     *
     * @return string
     */
    public static function getLayout($layout_name)
    {
        return self::layoutExists($layout_name) ? self::callLayoutStaticMethod($layout_name, '__run') : '';
    }

    /**
     *
     * Call Layout static method.
     *
     * @param string $layout_name
     * @param string $layout_method
     *
     * @return mixed
     */
    public static function callLayoutStaticMethod($layout_name, $layout_method)
    {
        return forward_static_call(["UIoT\\App\\Data\\Layout\\$layout_name", $layout_method]);
    }

    /**
     *
     * Get the Layout Resources
     *
     * @param string $layout_name
     */
    public static function getLayoutResources($layout_name)
    {
        self::callLayoutStaticMethod($layout_name, '__res');
    }
}
