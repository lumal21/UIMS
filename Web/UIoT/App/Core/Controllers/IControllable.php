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

use UIoT\App\Core\Communication\Parsers\DataManager;
use UIoT\App\Data\Models\Requesting\IControllerModel;
use UIoT\App\Helpers\Manipulation\Strings;

/**
 * Class IControllable
 * @package UIoT\App\Core\Controllers
 */
class IControllable
{
    /**
     * Abstract Controller Name
     *
     * @var string
     */
    protected $controller_name = '';

    /**
     * Abstract Controller Action (Method)
     *
     * @var string
     */
    protected $controller_action = '';

    /**
     * All Possible Abstract Controller Actions (Methods)
     *
     * @var array
     */
    protected $controller_actions = [];

    /**
     * Array of Abstract Controllers
     *
     * @var array
     */
    protected $abstract_controllers_array = [];

    /**
     * Abstract Controller
     *
     * @var IControllerModel
     */
    protected $controller_data;

    /**
     * Get Controller Data
     *
     * @return IControllerModel
     */
    public function getControllerData()
    {
        return $this->controller_data;
    }

    /**
     * Set Controller Data
     *
     * @param IControllerModel $controller_data
     */
    public function setControllerData(IControllerModel $controller_data)
    {
        $this->controller_data = $controller_data;
    }

    /**
     * Get Abstract Controller Actions (Methods)
     *
     * @return array
     */
    public function getControllerActions()
    {
        return $this->controller_actions;
    }

    /**
     * Set Abstract Controller Actions (Methods)
     *
     * @param array $controller_actions
     */
    public function setControllerActions($controller_actions)
    {
        $this->controller_actions = $controller_actions;
    }

    /**
     * Enable the Instance
     *
     * @param array $array
     */
    protected function enableController($array = [])
    {
        /* store array */
        $this->setControllerActions($array);

        /* call methods */
        $this->addInstance();
        $this->addMethods();
    }

    /**
     * Create Controller Instance
     */
    private function addInstance()
    {
        $this->controller_data = new IControllerModel;
    }

    /**
     * Add Controller Abstract Methods
     */
    private function addMethods()
    {
        foreach ($this->controller_actions as $method => $request)
            $this->controller_data->{Strings::toActionMethodName($method)} = function () use ($method) {
                return DataManager::getInstance($method);
            };
    }
}
