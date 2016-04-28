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

namespace UIoT\App\Core\Assets;

use UIoT\App\Data\Interfaces\Parsers\RenderInterface;

/**
 * Class Render
 * @package UIoT\App\Core\Assets
 */
final class AssetRender implements RenderInterface
{
    /**
     * @var string
     */
    private $layoutName;

    /**
     * @var string
     */
    private $assetName;

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
     * @return void
     */
    public function setArguments($arguments = [])
    {
        $this->layoutName = $arguments['layout'];
        $this->assetName = $arguments['asset'];
    }

    /**
     * Show the Resource
     *
     * @return string
     */
    public function show()
    {
        /* register resources */
        Register::registerResources($this->layoutName);

        /* return resource */
        return Register::returnResource($this->assetName);
    }
}
