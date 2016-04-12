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

namespace UIoT\App\Core\Controllers;

use UIoT\App\Data\Models\Data\ControllerModel;
use UIoT\App\Data\Singletons\ControllerSingleton;
use UIoT\App\Helpers\Manipulation\Strings;

/**
 * Class Factory
 *
 * @package UIoT\App\Data\Controllers
 */
final class Factory
{
    /**
     *
     * Controllers
     *
     * @var array
     */
    private static $controllers = [];

    /**
     *
     * Add a Controller
     *
     * @param string $controller_name
     */
    public static function addController($controller_name)
    {
        self::controllerExists($controller_name) || array_push(self::$controllers, $controller_name);
    }

    /**
     *
     * Check if Controller Exists
     *
     * @param string $controller_name
     *
     * @return bool
     */
    public static function controllerExists($controller_name)
    {
        return in_array(Strings::toControllerName($controller_name), self::$controllers);
    }

    /**
     *
     * Get Controller Instance
     *
     * @param string $controller_name
     *
     * @return ControllerModel|ControllerSingleton|null
     */
    public static function getController($controller_name)
    {
        return self::controllerExists($controller_name) ? self::callControllerStaticMethod($controller_name, 'getInstance') : null;
    }

    /**
     *
     * Call Controller Action and Execute It Returning its Contents
     *
     * @param string $controller_name
     * @param string $action_name
     * @return string
     */
    public static function executeControllerAction($controller_name, $action_name)
    {
        return self::controllerActionExists($controller_name, $action_name) ? self::getController($controller_name)->{Strings::toActionMethodName($action_name)}() : '';
    }

    /**
     *
     * Check if Controller Action Exists
     *
     * @param string $controller_name
     * @param string $action_name
     *
     * @return mixed
     */
    public static function controllerActionExists($controller_name, $action_name)
    {
        return in_array(Strings::toActionName($action_name), self::getControllerActions($controller_name));
    }

    /**
     *
     * Get Controller Actions
     *
     * @param string $controller_name
     *
     * @return mixed
     */
    public static function getControllerActions($controller_name)
    {
        return array_map('UIoT\App\Helpers\Manipulation\Arrays::toActionName', get_class_methods(self::getController($controller_name)));
    }

    /**
     *
     * Call Controller static method.
     *
     * @param string $controller_name
     * @param string $controller_method
     *
     * @return mixed
     */
    public static function callControllerStaticMethod($controller_name, $controller_method)
    {
        return forward_static_call(["UIoT\\App\\Data\\Controllers\\$controller_name", $controller_method]);
    }
}
