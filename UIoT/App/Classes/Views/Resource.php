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

namespace UIoT\App\Classes\Views;

use UIoT\App\Classes\Resources\Mapper;

/**
 * Class Resource
 * @property string file_name
 * @property string resource
 * @package UIoT\App\Classes\Views
 */
final class Resource
{
    /**
     * Init Resource Handler
     *
     * @param string $controller
     * @param string $action
     * @param string $sub_action
     */
    function __construct($controller, $action, $sub_action)
    {
        $this->__name($action, $sub_action);
        $this->__show($controller);
    }

    /**
     * Save Resource Name
     *
     * @param string $action
     * @param string $sub_action
     */
    private function __name($action, $sub_action)
    {
        $this->file_name = ($action . $sub_action);
    }

    /**
     * Show the Resource
     *
     * @param string $controller
     * @return null
     */
    private function __show($controller)
    {
        /* register resources */
        Mapper::registerResources($controller);

        /* return resource */
        $this->resource = Mapper::returnResource($this->file_name);
    }

    /**
     * Return Resource
     *
     * @return string
     */
    function __toString()
    {
        return $this->resource;
    }
}