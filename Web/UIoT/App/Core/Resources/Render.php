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
 * @developer Igor Moraes
 * @copyright University of Brasília
 */

namespace UIoT\App\Core\Resources;

use UIoT\App\Core\Helpers\Manipulation\Files;
use UIoT\App\Data\Interfaces\RenderInterface;


/**
 * Class Render
 * @package UIoT\App\Core\Resources
 */
final class Render implements RenderInterface
{
    /**
     * Layout Name
     *
     * @var string
     */
    private $layout_name;

    /**
     * Asset Name
     *
     * @var string
     */
    private $asset_name;

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
    public function setArguments($arguments = [])
    {
        $this->layout_name = $arguments['layout'];
        $this->asset_name = Files::getBaseName($arguments['asset']);
    }

    /**
     * Show the Resource
     *
     * @return string
     */
    public function show()
    {
        /* register resources */
        Indexer::registerResources($this->layout_name);

        /* return resource */
        return Indexer::returnResource($this->asset_name);
    }
}
