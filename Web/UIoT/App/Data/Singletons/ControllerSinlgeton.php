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

use UIoT\App\Core\Controllers\Factory as ControllerFactory;
use UIoT\App\Data\Models\Data\ControllerModel;

/**
 * Class ControllerSingleton
 * @package UIoT\App\Data\Singletons
 */
abstract class ControllerSingleton extends ControllerModel
{
    /**
     * @var ControllerSingleton Instance
     */
    protected static $controllerInstance;
    /**
     * @var ControllerFactory Instance
     */
    protected $controllerFactory;

    /**
     * Return Instance of Controller
     *
     * @return ControllerSingleton
     */
    public static function getInstance()
    {
        if(null === self::$controllerInstance) {
            self::$controllerInstance = new static;
        }

        return self::$controllerInstance;
    }

    /**
     * Get Controller Factory
     *
     * @return ControllerFactory
     */
    public function getControllerFactory()
    {
        if(null === $this->controllerFactory) {
            $this->controllerFactory = new ControllerFactory;
        }

        return $this->controllerFactory;
    }
}
