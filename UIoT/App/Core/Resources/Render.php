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

namespace UIoT\App\Core\Resources;

/**
 * Class Render
 * @package UIoT\App\Core\Resources
 */
final class Render
{
    /**
     * @var string
     */
    private $controller;
    /**
     * @var string
     */
    private $file;

    /**
     * Init Resource Handler
     *
     * @param array $arguments
     */
    public function __construct($arguments = [])
    {
        $this->setArguments($arguments);
    }

    /**
     * Set Arguments
     *
     * @param array $arguments
     */
    private function setArguments($arguments = [])
    {
        $this->controller = $arguments['controller'];
        $this->file = $arguments['file'];
    }

    /**
     * Show the Resource
     *
     * @return string
     */
    public function show()
    {
        /* register resources */
        Indexer::registerResources($this->controller);

        /* return resource */
        return Indexer::returnResource($this->file);
    }
}