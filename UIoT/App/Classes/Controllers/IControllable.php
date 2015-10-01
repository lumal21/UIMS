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

use UIoT\App\Classes\Communication\Parsers\DataManager;
use UIoT\App\Classes\Helpers\Strings;
use UIoT\App\Data\Models\IController;

/**
 * @property IController c_data
 * @property array c_s_array
 */
class IControllable
{
    /**
     * Enable the Instance
     *
     * @param array $array
     */
    protected function __enable($array = [])
    {
        /* store array */
        $this->c_s_array = $array;

        /* call methods */
        $this->__addInstance();
        $this->__addMethods();
    }

    /**
     * Create Controller Instance
     */
    private function __addInstance()
    {
        $this->c_data = (new IController);
    }

    /**
     * Add Controller Abstract Methods
     */
    private function __addMethods()
    {
        foreach ($this->c_s_array as $method => $request):
            $this->c_data->{Strings::toActionMethodName($method)} = function () use ($method) {
                return DataManager::getInstance($method);
            };
        endforeach;
    }
}