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

use UIoT\App\Core\Communication\Routing\RenderSelector;
use UIoT\App\Core\Templates\Render;
use UIoT\App\Data\Models\ControllerModel;
use UIoT\App\Data\Singletons\ControllerSingleton;
use UIoT\App\Helpers\Manipulation\Strings;

/**
 * Class Indexer
 *
 * @package UIoT\App\Data\Controllers
 */
final class Indexer
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
    public static function instantiateController($controller_name)
    {
        return self::controllerExists($controller_name) ? self::callControllerStaticMethod($controller_name, 'getInstance') : null;
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

    /**
     *
     * Get Controller Namespace
     *
     * @param string $controller_name
     *
     * @return string|false
     */
    public static function getControllerNameSpace($controller_name)
    {
        return Strings::toNameSpace($controller_name, 'UIoT\App\Data\Controllers\\');
    }

    /**
     *
     * Redirect to Another Controller
     *
     * @param string $controller
     * @param string $controller_action
     *
     * @return string|null
     */
    public static function redirectToController($controller, $controller_action = DEFAULT_CONTROLLER_ACTION)
    {
        return RenderSelector::go(new Render(['controller' => $controller, 'action' => $controller_action]));
    }
}
