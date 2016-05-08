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

use UIoT\App\Core\Layouts\Factory;
use UIoT\App\Data\Interfaces\Parsers\RenderInterface;
use UIoT\App\Helpers\Manipulation\Files;

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
     * @var string
     */
    private static $assetData;

    /**
     * Init Resource Handler
     *
     * @param array $arguments
     */
    public function __construct($arguments = [])
    {
        $this->setArguments($arguments);
        $this->setAssetData();
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
     * Set Asset Base Name
     */
    private function setAssetData()
    {
        self::$assetData = Files::getBaseName($this->assetName);
    }

    /**
     * Return Asset File Name
     *
     * @return string
     */
    public static function getAssetData()
    {
        return self::$assetData;
    }

    /**
     * Show Asset Content
     *
     * @return string
     */
    public function showContent()
    {
        Factory::getLayoutAssets($this->layoutName);

        return Register::returnAsset(self::getAssetData());
    }
}
