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

namespace UIoT\App\Classes\Controllers;

use UIoT\App\Classes\Helpers\Strings;
use UIoT\App\Classes\Views\Indexer as VIndexer;

/**
 * Class Indexer
 * @package UIoT\App\Data\Controllers
 */
final class Indexer
{
    /**
     * @var array
     */
    static $controller = [];

    /**
     * Add a Controller
     *
     * @param string $controller_name
     */
    static function addController($controller_name)
    {
        (self::controllerExists($controller_name)) || (self::$controller[$controller_name] = self::getControllerActions($controller_name));
    }

    /**
     * Check if Controller Exists
     *
     * @param string $controller_name
     * @return bool
     */
    static function controllerExists($controller_name)
    {
        return array_key_exists($controller_name, self::$controller);
    }

    /**
     * Get Controller Actions
     *
     * @param string $controller_name
     * @return array|mixed|null
     */
    static function getControllerActions($controller_name)
    {
        return ((self::controllerExists($controller_name)) ? VIndexer::getViewAction($controller_name) : null);
    }

    /**
     * Get Controller Instance
     *
     * @param string $controller_name
     * @return null
     */
    static function getController($controller_name)
    {
        return ((self::controllerExists($controller_name)) ? self::activeController($controller_name) : null);
    }

    /**
     * Activate Controller
     *
     * @param string $controller_name
     * @return mixed
     */
    static function activeController($controller_name)
    {
        /* try to get controller, without check if exists */
        $c = self::getControllerNameSpace($controller_name);

        /* return controller */
        return new $c();
    }

    /**
     * Get Controller Namespace
     *
     * @param string $controller_name
     * @return string
     */
    static function getControllerNameSpace($controller_name)
    {
        return (Strings::toNameSpace($controller_name, 'UIoT\\App\\Data\\Controllers\\'));
    }
}