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

namespace UIoT\App\Core\Layouts;

use UIoT\App\Core\Helpers\Manipulation\Strings;
use UIoT\App\Data\Models\LayoutModel;

/**
 * Class Indexer
 * @package UIoT\App\Data\Layouts
 */
final class Indexer
{
    /**
     * @var array
     */
    private static $layout = [];

    /**
     * Add a Layout
     *
     * @param string $layout_name
     * @param string $view_name
     */
    public static function addLayout($layout_name, $view_name = '')
    {
        self::layoutExists($layout_name) || (self::$layout[$layout_name] = !empty($view_name) ? $view_name : $layout_name);
    }

    /**
     * Check if Layout Exists
     *
     * @param string|LayoutModel $layout_name
     * @return bool
     */
    public static function layoutExists($layout_name)
    {
        return array_key_exists($layout_name, self::$layout);
    }

    /**
     * Remove Layout from Array
     *
     * @param string $layout_name
     */
    public static function removeLayout($layout_name)
    {
        if (self::layoutExists($layout_name))
            unset(self::$layout[$layout_name]);
    }

    /**
     * Return all Layout Names from That View
     *
     * @param string $view_name
     * @return mixed|array
     */
    public static function getLayoutName($view_name)
    {
        return array_keys($view_name, self::$layout);
    }

    /**
     * Return View Name by Layout Name
     *
     * @param string $layout_name
     * @return mixed|string
     */
    public static function getLayoutView($layout_name)
    {
        return self::$layout[$layout_name] || '';
    }

    /**
     * Return View Name Space
     *
     * @param string $layout_name
     * @return string
     */
    public static function getLayout($layout_name)
    {
        return self::openLayout($layout_name);
    }

    /**
     * Return Instance of Layout
     *
     * @param string $layout_name
     * @return string
     */
    public static function openLayout($layout_name)
    {
        return self::layoutExists(self::getLayoutReverseNameSpace($layout_name)) ? (new $layout_name)->__show() : '';
    }

    /**
     * Really Crazy but Works
     * (Is for return a reverse namespace)
     *
     * @param string|LayoutModel $layout_name_space
     * @return string|LayoutModel
     */
    public static function getLayoutReverseNameSpace(&$layout_name_space)
    {
        /* get layout name space and returns */
        $layout_name_space = self::getLayoutNameSpace($layout_name = $layout_name_space);

        /* return normal layout name */
        return $layout_name;
    }

    /**
     * Return the Namespace form the Layout
     *
     * @param string|LayoutModel $layout_name
     * @return LayoutModel|string
     */
    public static function getLayoutNameSpace($layout_name)
    {
        return Strings::toNameSpace($layout_name, 'UIoT\App\Data\Layout\\');
    }

    /**
     * Get the Layout Resources
     *
     * @param string $layout_name
     */
    public static function getLayoutResources($layout_name)
    {
        self::openLayoutResources($layout_name);
    }

    /**
     * Return Layout Resources
     *
     * @param LayoutModel|string $layout_name
     * @return mixed
     */
    public static function openLayoutResources($layout_name)
    {
        !self::layoutExists(self::getLayoutReverseNameSpace($layout_name)) || $layout_name::__resources();
    }
}
