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

use Assetic\Asset\AssetCache;
use Assetic\Asset\AssetInterface;
use Assetic\Asset\FileAsset;
use Assetic\AssetManager;
use Assetic\Cache\FilesystemCache;
use UIoT\App\Core\Settings\Register as SettingsRegister;
use UIoT\App\Data\Models\Settings\ResourcesSettingsModel;
use UIoT\App\Helpers\Manipulation\Constants;

/**
 * Class Manager
 * @package UIoT\App\Core\Assets
 */
final class Manager
{
    /**
     * @var AssetManager
     */
    private static $assetManager;

    /**
     * @var bool
     */
    private static $enableCaching = false;

    /**
     * @var FilesystemCache
     */
    private static $cacheManager;

    /**
     * @var ResourcesSettingsModel
     */
    private $settings;

    /**
     * Manager constructor.
     */
    public function __construct()
    {
        self::setSettings(SettingsRegister::getSetting('resources'));
        self::setAssetManager(new AssetManager);
        self::setEnableCaching($this->settings->enableCaching);
    }

    /**
     * Add an Asset
     *
     * @param string $assetName
     * @param string $assetPath
     */
    public static function addAsset($assetName, $assetPath)
    {
        if(self::isCachingEnabled())
            self::getAssetManager()->set($assetName, new AssetCache(new FileAsset($assetPath), self::getCacheManager()));
        else
            self::getAssetManager()->set($assetName, new FileAsset($assetPath));
    }

    /**
     * Create Asset and Return it Contents
     *
     * @param string $assetName
     * @return AssetInterface
     */
    public static function getAsset($assetName)
    {
        return self::getAssetManager()->get($assetName);
    }

    /**
     * Get Asset File Path
     *
     * @param string $assetName
     * @return null|string
     */
    public static function getAssetPath($assetName)
    {
        return self::getAsset($assetName)->getSourceRoot() . '/' . self::getAsset($assetName)->getSourcePath();
    }

    /**
     * Get Asset Manager
     *
     * @return AssetManager
     */
    public static function getAssetManager()
    {
        return self::$assetManager;
    }

    /**
     * Set Asset Manager
     *
     * @param AssetManager $assetManager
     */
    public static function setAssetManager(AssetManager $assetManager)
    {
        self::$assetManager = $assetManager;
    }

    /**
     * Return if is Enabled Cache System
     *
     * @return boolean
     */
    public static function isCachingEnabled()
    {
        return self::$enableCaching;
    }

    /**
     * Enable/Disable Cache System
     *
     * @param boolean $enableCaching
     */
    public static function setEnableCaching($enableCaching)
    {
        self::$enableCaching = $enableCaching;

        !$enableCaching || self::setCacheManager(new FilesystemCache(Constants::returnConstant('RESOURCE_CACHE_FOLDER')));
    }

    /**
     * Return Cache Manager
     *
     * @return FilesystemCache
     */
    public static function getCacheManager()
    {
        return self::$cacheManager;
    }

    /**
     * Set Cache Manager
     *
     * @param FilesystemCache $cacheManager
     */
    public static function setCacheManager($cacheManager)
    {
        self::$cacheManager = $cacheManager;
    }

    /**
     * Set settings
     *
     * @param ResourcesSettingsModel $settings
     */
    public function setSettings($settings)
    {
        $this->settings = $settings;
    }
}
