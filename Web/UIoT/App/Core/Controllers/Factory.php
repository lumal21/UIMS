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
use UIoT\App\Helpers\Manipulation\Arrays;
use UIoT\App\Helpers\Manipulation\Strings;

/**
 * Class Factory
 * @package UIoT\App\Data\Controllers
 */
final class Factory
{
    /**
     * @var array
     */
    private static $controllers = [];

    /**
     * Add a Controller
     *
     * @param string $controllerName
     */
    public static function addController($controllerName)
    {
        self::controllerExists(Strings::toControllerName($controllerName)) ||
        array_push(self::$controllers, Strings::toControllerName($controllerName));
    }

    /**
     * Check if Controller Exists
     *
     * @param string $controllerName
     * @return bool
     */
    public static function controllerExists($controllerName)
    {
        return in_array(Strings::toControllerName($controllerName), self::$controllers);
    }

    /**
     * Get Controller Instance
     *
     * @param string $controllerName
     * @return ControllerModel|ControllerSingleton|null
     */
    public static function getController($controllerName)
    {
        return self::controllerExists($controllerName) ?
            self::callControllerStaticMethod($controllerName, 'getInstance') : null;
    }

    /**
     * Call Controller Action and Execute It Returning its Contents
     *
     * @param string $controllerName
     * @param string $actionName
     * @return string
     */
    public static function executeControllerAction($controllerName, $actionName)
    {
        return self::controllerActionExists($controllerName, $actionName) ?
            self::getController($controllerName)->{Strings::toActionMethodName($actionName)}() : '';
    }

    /**
     * Check if Controller Action Exists
     *
     * @param string $controllerName
     * @param string $actionName
     * @return mixed
     */
    public static function controllerActionExists($controllerName, $actionName)
    {
        return in_array(Strings::toActionName($actionName), self::getControllerActions($controllerName));
    }

    /**
     * Get Controller Actions
     *
     * @param string $controllerName
     * @return mixed
     */
    public static function getControllerActions($controllerName)
    {
        return array_map(function($controllerAction) {
            return Arrays::toActionName($controllerAction);
        }, (array)get_class_methods(self::getController(Strings::toControllerName($controllerName))));
    }

    /**
     * Call Controller static method.
     *
     * @param string $controllerName
     * @param string $controllerMethod
     * @return mixed
     */
    public static function callControllerStaticMethod($controllerName, $controllerMethod)
    {
        return forward_static_call(["UIoT\\App\\Data\\Controllers\\$controllerName", $controllerMethod]);
    }
}
