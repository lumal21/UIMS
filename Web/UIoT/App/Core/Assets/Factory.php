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

use Exception;
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
     * Set Resource Folder
     *
     * @param string $assetFolder
     * @param string $assetName
     *
     * @return string
     */
    public function getFileName($assetFolder, $assetName)
    {
        return Strings::toLower(Constants::returnConstant('RESOURCE_FOLDER') . $assetFolder . '/' . $assetName);
    }

    /**
     * Add Asset
     *
     * @param string $assetName
     * @param string $assetFolder
     * @param string $assetFileName
     */
    public function addAsset($assetName, $assetFolder, $assetFileName = '')
    {
        Manager::addAsset(Strings::toLower($assetName), $this->getFileName($assetFolder, $assetFileName));
    }

    /**
     * Return Asset
     *
     * @param string $assetFileName
     *
     * @return mixed Asset Content
     * @throws Exception
     */
    public static function returnAsset($assetFileName)
    {
        $assetName = Files::getBaseName(Strings::toLower($assetFileName));

        if (!Manager::getAssetManager()->has($assetName)) {
            throw new Exception('The requested Resource wasn\'t Found on this Server', '404');
        }

        return Manager::getAsset($assetName)->dump();
    }
}
