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

use Assetic\Asset\AssetInterface;
use Assetic\Asset\FileAsset;
use Assetic\AssetManager;
use UIoT\App\Core\Settings\Register;
use UIoT\App\Data\Models\Settings\AssetsSettingsModel;
use UIoT\App\Helpers\Manipulation\Constants;
use UIoT\App\Helpers\Manipulation\Files;
use UIoT\App\Helpers\Manipulation\Strings;

/**
 * Class Factory
 * @package UIoT\App\Core\Assets
 */
final class Factory
{
    /**
     * @var AssetManager Instance
     */
    private $assetManager;

    /**
     * @var AssetsSettingsModel
     */
    private $settingsBlock;

    /**
     * Create a Instance of Asset Factory
     */
    public function __construct()
    {
        $this->assetManager = new AssetManager;
        $this->settingsBlock = Register::get('resources');
    }

    /**
     * Set Resource Folder
     *
     * @param string $assetFolder
     * @param string $assetName
     *
     * @return string
     */
    public function getPath($assetFolder, $assetName)
    {
        return Constants::get('RESOURCE_FOLDER') . "$assetFolder/$assetName";
    }

    /**
     * Add Asset
     *
     * @param string $assetName
     * @param string $assetFolder
     * @param string $assetFileName
     */
    public function add($assetName, $assetFolder, $assetFileName)
    {
        $this->getManager()->set(Strings::toLower($assetName), new FileAsset($this->getPath($assetFolder, $assetFileName)));
    }

    /**
     * Create Asset and Return it Contents
     *
     * @param string $assetName
     * @return AssetInterface
     */
    public function get($assetName)
    {
        return $this->getManager()->get(Strings::toLower($assetName));
    }

    /**
     * Return Asset
     *
     * @param string $assetFileName
     * @return mixed Asset Content
     */
    public function dump($assetFileName)
    {
        $assetName = Files::getBaseName(Strings::toLower($assetFileName));

        header('Content-Type: ' . Constants::getJson('MIME_TYPES')->{Files::getExtension($assetName)});

        return $this->get($assetName)->dump();
    }

    /**
     * Get Asset Manager
     *
     * @return AssetManager
     */
    public function getManager()
    {
        return $this->assetManager;
    }
}
