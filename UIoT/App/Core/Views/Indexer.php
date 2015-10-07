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

namespace UIoT\App\Core\Views;

use UIoT\App\Core\Helpers\Manipulators\Strings;

/**
 * Class Indexer
 * @package UIoT\App\Data\Views
 */
final class Indexer
{
    /**
     * Views Array
     *
     * @var array
     */
    static $view = [];

    /**
     * Add a View
     *
     * @param string $view_name
     */
    static function addView($view_name = '')
    {
        if (self::viewExists($view_name))
            return;

        self::$view[$view_name] = [];
        self::addViewAction($view_name, 'Main');
    }

    /**
     * Check if View Exists
     *
     * @param string $view_name
     * @return bool
     */
    static function viewExists($view_name = '')
    {
        return (array_key_exists($view_name, self::$view));
    }

    /**
     * Add View Action
     *
     * @param string $view_name
     * @param string $action_name
     */
    static function addViewAction($view_name, $action_name)
    {
        ((!self::viewExists($view_name)) && (self::actionExists($view_name, $action_name))) || array_push(self::$view[$view_name], $action_name);
    }

    /**
     * Check if Action Exists
     *
     * @param string $view_name
     * @param string $action_name
     * @return bool
     */
    static function actionExists($view_name, $action_name)
    {
        return array_key_exists($action_name, self::$view[$view_name]);
    }

    /**
     * Remove View Action
     *
     * @param string $view_name
     * @param string $action_name
     */
    static function removeViewAction($view_name, $action_name)
    {
        if ((self::viewExists($view_name)) && (self::actionExists($view_name, $action_name))) unset(self::$view[$view_name][$action_name]);
    }

    /**
     * Remove View
     *
     * @param string $view_name
     */
    static function removeView($view_name)
    {
        if (self::viewExists($view_name)) unset(self::$view[$view_name]);
    }

    /**
     * Get View Name
     * Return all View Names by Action
     *
     * @param string $action_name
     * @return mixed|array
     */
    static function getViewName($action_name)
    {
        return array_keys($action_name, self::$view);
    }

    /**
     * Return View Actions by View Name
     *
     * @param string $view_name
     * @return mixed|array
     */
    static function getViewAction($view_name)
    {
        return ((self::viewExists($view_name)) ? self::$view[$view_name] : []);
    }

    /**
     * Open the View
     *
     * @param string $view_name
     * @return mixed
     */
    static function getView($view_name)
    {
        return ((self::viewExists($view_name)) ? (self::openView($view_name)) : '');
    }

    /**
     * Return a Instance of the View
     *
     * @param string $view_name
     * @return mixed
     */
    static function openView($view_name)
    {
        /* if view exists enable it */
        if (self::viewExists(self::getViewReverseSpace($view_name))) new $view_name;
    }

    /**
     * Really Crazy but Works
     * (Is for return a reverse namespace)
     *
     * @param $view_name_space
     * @return mixed
     */
    static function getViewReverseSpace(&$view_name_space)
    {
        /* get view name space and returns */
        $view_name_space = self::getViewNameSpace($view_name = $view_name_space);

        /* return normal view name */
        return $view_name;
    }

    /**
     * Return the Namespace form the View
     *
     * @param string $view_name
     * @return string
     */
    static function getViewNameSpace($view_name)
    {
        return ((self::viewExists($view_name)) ? (Strings::toNameSpace($view_name, 'UIoT\\App\\Data\\Views\\')) : '');
    }
}