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

namespace UIoT\App\Core\Renders;

use UIoT\App\Core\Resources\Mapper;

/**
 * Class Resource
 * @property string resource
 * @package UIoT\App\Core\Views
 */
final class Resource
{
    /**
     * Init Resource Handler
     *
     * @param string $controller
     * @param $file
     */
    function __construct($controller, $file)
    {
        $this->__show($controller, $file);
    }

    /**
     * Show the Resource
     *
     * @param string $controller
     * @param $file
     * @return null
     */
    private function __show($controller, $file)
    {
        /* register resources */
        Mapper::registerResources($controller);

        /* return resource */
        $this->resource = Mapper::returnResource($file);
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