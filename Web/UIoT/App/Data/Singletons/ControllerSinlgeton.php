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

namespace UIoT\App\Data\Singletons;

use UIoT\App\Data\Models\Data\ControllerModel;

/**
 * Class ControllerSingleton
 *
 * @package UIoT\App\Data\Singletons
 */
class ControllerSingleton extends ControllerModel
{
    /**
     *
     * Controller Model Instance
     *
     * @var ControllerModel|ControllerSingleton
     */
    protected static $controllerInstance = null;

    /**
     *
     * Abstract and Singleton Protection
     */
    protected function __construct()
    {
        /* not implemented */
    }

    /**
     *
     * Return Instance of Controller
     *
     * @return ControllerModel|ControllerSingleton|mixed
     */
    public static function getInstance()
    {
        if (null === self::$controllerInstance)
            self::$controllerInstance = new static;

        return self::$controllerInstance;
    }

    /**
     * Get Controller Actions
     *
     * @return mixed
     */
    public static function getActions()
    {
        return array_map('self::toActionName', get_class_methods(self::$controllerInstance));
    }

    /**
     *
     * Abstract and Singleton Protection
     */
    protected function __clone()
    {
        /* not implemented */
    }

    /**
     *
     * Abstract and Singleton Protection
     */
    protected function __wakeup()
    {
        /* not implemented */
    }
}
