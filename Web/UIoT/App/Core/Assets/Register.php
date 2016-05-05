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
use UIoT\App\Core\Communication\Sessions\Indexer as SIndexer;
use UIoT\App\Core\Layouts\Factory as LIndexer;
use UIoT\App\Helpers\Manipulation\Arrays;
use UIoT\App\Helpers\Manipulation\Constants;
use UIoT\App\Helpers\Manipulation\Files;
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
        return Strings::toRestUrlName(Constants::returnConstant('RESOURCE_FOLDER') . $assetFolder . '/' . $assetFileName);
    }

    /**
     * Add Resource
     *
     * @param string $assetName
     * @param string $assetFolder
     * @param string $assetFileName
     */
    public static function addAsset($assetName, $assetFolder, $assetFileName = '')
    {
        Manager::addAsset($assetName, self::convertToFileName($assetFolder, $assetFileName));
    }

    /**
     * Return Layout Resources
     *
     * @param string $layoutName
     * @param bool $resetSession
     * @return mixed
     */
    public static function registerResources($layoutName, $resetSession = false)
    {
        /* remove if is needed */
        !$resetSession || SIndexer::removeKey('layout');

        /* register the layout */
        LIndexer::addLayout($layoutName);

        /* get layout resources */
        LIndexer::getLayoutResources($layoutName);

        /* resource must change */
        self::calculateResourceChanges();
    }

    /**
     * Calculate Resource Changes
     *
     * These void is used to generate the final array.
     * if a new resource is added, the algorithm will use the local array
     * if isn't added new resources, but a resource is removed (if already used), he return the session array
     * also if don't exists any changes the session array will be used.
     *
     * @bug the algorithm only will work on second resource instantiation
     *
     * The reason of these algorithm is only the page-side resources must be loaded.
     * to protect XSS, and hot-links.
     */
    public static function calculateResourceChanges()
    {
        // get array values
        $resource_array = Manager::getAssetManager()->getNames();

        // if the session doesn't exists, add then
        SIndexer::addKey('layout', $resource_array);

        $session_array = SIndexer::getKeyValue('layout');

        // mount array with removed items
        $removed_array = array_diff($session_array, $resource_array);

        // mount final array
        $final_array = empty($removed_array) ? $session_array : $resource_array;

        // store array
        SIndexer::updateKey('layout', $final_array);
    }

    /**
     * Check if the Required Asset is Valid and Exists
     *
     * @return array
     */
    public static function getAvailableAssets()
    {
        return SIndexer::keyExists('layout') ? (array)SIndexer::getKeyValue('layout') : Manager::getAssetManager()->getNames();
    }

    /**
     * Update Resource Change
     *
     * @param string $assetName
     */
    public static function updateAssetsChanges($assetName)
    {
        SIndexer::updateKey('layout', self::removeAsset($assetName));
    }

    /**
     * Set Mime Type
     *
     * @param $assetName
     */
    public static function setMimeType($assetName)
    {
        header('Content-Type: ' . mime_content_type(Manager::getAssetPath($assetName)));
    }

    /**
     * Return Asset
     *
     * @param string $assetFileName
     * @return string
     * @throws Exception
     */
    public static function returnResource($assetFileName)
    {
        /* set asset name */
        $assetName = Files::getBaseName($assetFileName);

        if(!self::checkIfAssetIsValid($assetName)) {
            throw new Exception('The requested Resource wasn\'t Found on this Server', '404');
        }

        self::updateAssetsChanges($assetName);

        self::setMimeType($assetName);

        return Manager::getAsset($assetName)->dump();
    }

    /**
     * Remove Asset From Session
     *
     * @param string $assetName
     * @return array
     */
    public static function removeAsset($assetName)
    {
        return array_diff(Manager::getAssetManager()->getNames(), [$assetName]);
    }

    /**
     * Check if Asset Is Valid in Session
     *
     * @param string $assetName
     * @return bool
     */
    public static function checkIfAssetIsValid($assetName)
    {
        return Arrays::inArray($assetName, self::getAvailableAssets()) && Manager::getAssetManager()->has($assetName);
    }
}
