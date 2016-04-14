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
 *
 * @package UIoT\App\Core\Assets
 */
final class Register
{
    /**
     * Set Resource Folder
     *
     * @param string $asset_folder
     * @param string $asset_file_name
     *
     * @return string
     */
    public static function convertToFileName($asset_folder, $asset_file_name)
    {
        return Strings::toRestUrlName(Constants::returnConstant('RESOURCE_FOLDER') . $asset_folder . '/' . $asset_file_name);
    }

    /**
     * Add Resource
     *
     * @param string $asset_name
     * @param string $asset_folder
     * @param string $asset_file_name
     */
    public static function addAsset($asset_name, $asset_folder, $asset_file_name = '')
    {
        Manager::addAsset($asset_name, self::convertToFileName($asset_folder, $asset_file_name));
    }

    /**
     * Return Layout Resources
     *
     * @param string $layout_name
     * @param bool $reset_session
     * @return mixed
     */
    public static function registerResources($layout_name, $reset_session = false)
    {
        /* remove if is needed */
        !$reset_session || SIndexer::removeKey('layout');

        /* register the layout */
        LIndexer::addLayout($layout_name);

        /* get layout resources */
        LIndexer::getLayoutResources($layout_name);

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
     * @param string $asset_name
     */
    public static function updateAssetsChanges($asset_name)
    {
        SIndexer::updateKey('layout', self::removeAsset($asset_name));
    }

    /**
     *
     * Set Mime Type
     *
     * @param $asset_name
     */
    public static function setMimeType($asset_name)
    {
        header('Content-Type: ' . mime_content_type(Manager::getAssetPath($asset_name)));
    }

    /**
     * Return Asset
     *
     * @param string $asset_file_name
     *
     * @return string
     *
     * @throws Exception
     */
    public static function returnResource($asset_file_name)
    {
        /* set asset name */
        $asset_name = Files::getBaseName($asset_file_name);

        if (!self::checkIfAssetIsValid($asset_name))
            throw new Exception('The requested Resource wasn\'t Found on this Server', '404');

        /* update the resource change */
        self::updateAssetsChanges($asset_name);

        /* set file mime type */
        self::setMimeType($asset_name);

        /* return asset */
        return Manager::getAsset($asset_name)->dump();
    }

    /**
     * Remove Asset From Session
     *
     * @param string $asset_name
     * @return array
     */
    public static function removeAsset($asset_name)
    {
        return array_diff(Manager::getAssetManager()->getNames(), [$asset_name]);
    }

    /**
     * Check if Asset Is Valid in Session
     *
     * @param string $asset_name
     * @return bool
     */
    public static function checkIfAssetIsValid($asset_name)
    {
        return Arrays::inArray($asset_name, self::getAvailableAssets()) && Manager::getAssetManager()->has($asset_name);
    }
}
