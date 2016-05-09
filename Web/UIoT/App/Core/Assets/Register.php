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
use UIoT\App\Helpers\Manipulation\Strings;

/**
 * Class Register
 * @package UIoT\App\Core\Assets
 */
final class Register
{
    /**
     * Set Resource Folder
     *
     * @param string $assetFolder
     * @param string $assetFileName
     * @return string
     */
    public static function convertToFileName($assetFolder, $assetFileName)
    {
        return Strings::toLower(Constants::returnConstant('RESOURCE_FOLDER') . $assetFolder . '/' . $assetFileName);
    }

    /**
     * Add Asset
     *
     * @param string $assetName
     * @param string $assetFolder
     * @param string $assetFileName
     */
    public static function addAsset($assetName, $assetFolder, $assetFileName = '')
    {
        Manager::addAsset(Strings::toLower($assetName), self::convertToFileName($assetFolder, $assetFileName));
    }

    /**
     * Set Mime Type
     *
     * @param $assetName
     */
    private static function setMimeType($assetName)
    {
        header('Content-Type: ' . mime_content_type(Manager::getAssetPath($assetName)));
    }

    /**
     * Return Asset
     *
     * @param string $assetName
     * @return mixed Asset Content
     * @throws Exception
     */
    public static function returnAsset($assetName)
    {
        $assetName = Strings::toLower($assetName);

        if(!Manager::getAssetManager()->has($assetName)) {
            throw new Exception("The requested Resource wasn't Found on this Server", '404');
        }

        self::setMimeType($assetName);

        return Manager::getAsset($assetName)->dump();
    }
}
