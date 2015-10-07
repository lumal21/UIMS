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
 * @copyright University of Bras�lia
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
     * @var string
     */
    private $controller;
    /**
     * @var
     */
    private $file;

    /**
     * Init Resource Handler
     *
     * @param array $arguments
     */
    public function __construct($arguments = [])
    {
        $this->controller = $arguments['controller'];
        $this->file       = $arguments['file'];
    }

    /**
     * Show the Resource
     *
     * @return string
     */
    public function show()
    {
        /* register resources */
        Mapper::registerResources($this->controller);

        /* return resource */
        return Mapper::returnResource($this->file);
    }
}