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
 * @package UIoT\App\Data\Controllers
 */
final class Factory
{
    /**
     * Check if Controller Exists
     *
     * @param string $controllerName
     * @return bool
     */
    public static function exists($controllerName)
    {
        return self::get($controllerName) != false;
    }

    /**
     * Get Controller Instance
     *
     * @param string $controllerName
     * @return ControllerModel|ControllerSingleton|null
     */
    public static function get($controllerName)
    {
        return self::callMethod($controllerName, 'getInstance');
    }

    /**
     * Get Controller Action and Execute It
     *
     * @param string $controllerName
     * @param string $actionName
     * @return string
     */
    public static function getAction($controllerName, $actionName)
    {
        return self::get($controllerName)->{Strings::toAction($actionName)}();
    }

    /**
     * Check if desired action Exists
     *
     * @param string $controllerName
     * @param string $actionName
     * @return mixed
     */
    public static function isAction($controllerName, $actionName)
    {
        return method_exists(self::get($controllerName), Strings::toAction($actionName));
    }

    /**
     * Call Controller static method.
     *
     * @param string $controllerName
     * @param string $controllerMethod
     * @return mixed
     */
    public static function callMethod($controllerName, $controllerMethod)
    {
        return forward_static_call(['UIoT\App\Data\Controllers\\' . Strings::toCamel($controllerName), $controllerMethod]);
    }
}
