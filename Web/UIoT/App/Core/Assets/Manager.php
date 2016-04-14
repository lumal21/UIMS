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
 *
 * @package UIoT\App\Core\Assets
 */
final class Manager
{
    /**
     *
     * Asset Manager Instance
     *
     * @var AssetManager
     */
    private static $asset_manager;

    /**
     *
     * Enable/Disable File System Cache
     *
     * @var bool
     */
    private static $enable_caching = false;

    /**
     *
     * Cache Manager
     *
     * @var FilesystemCache
     */
    private static $cache_manager;

    /**
     *
     * Settings variable
     *
     * @var ResourcesSettingsModel
     */
    private $settings;

    /**
     *
     * Manager constructor.
     */
    public function __construct()
    {
        self::setSettings(SettingsRegister::getSetting('resources'));
        self::setAssetManager(new AssetManager);
        self::setEnableCaching($this->settings->enableCaching);
    }

    /**
     *
     * Add an Asset
     *
     * @param string $asset_name
     * @param string $asset_path
     */
    public static function addAsset($asset_name, $asset_path)
    {
        if (self::isCachingEnabled())
            self::getAssetManager()->set($asset_name, new AssetCache(new FileAsset($asset_path), self::getCacheManager()));
        else
            self::getAssetManager()->set($asset_name, new FileAsset($asset_path));
    }

    /**
     * Create Asset and Return it Contents
     *
     * @param string $asset_name
     *
     * @return AssetInterface
     */
    public static function getAsset($asset_name)
    {
        return self::getAssetManager()->get($asset_name);
    }

    /**
     * Get Asset File Path
     *
     * @param string $asset_name
     *
     * @return null|string
     */
    public static function getAssetPath($asset_name)
    {
        return self::getAsset($asset_name)->getSourceRoot() . '/' . self::getAsset($asset_name)->getSourcePath();
    }

    /**
     *
     * Get Asset Manager
     *
     * @return AssetManager
     */
    public static function getAssetManager()
    {
        return self::$asset_manager;
    }

    /**
     *
     * Set Asset Manager
     *
     * @param AssetManager $asset_manager
     */
    public static function setAssetManager(AssetManager $asset_manager)
    {
        self::$asset_manager = $asset_manager;
    }

    /**
     *
     * Return if is Enabled Cache System
     *
     * @return boolean
     */
    public static function isCachingEnabled()
    {
        return self::$enable_caching;
    }

    /**
     *
     * Enable/Disable Cache System
     *
     * @param boolean $enable_caching
     */
    public static function setEnableCaching($enable_caching)
    {
        self::$enable_caching = $enable_caching;

        !$enable_caching || self::setCacheManager(new FilesystemCache(Constants::returnConstant('RESOURCE_CACHE_FOLDER')));
    }

    /**
     *
     * Return Cache Manager
     *
     * @return FilesystemCache
     */
    public static function getCacheManager()
    {
        return self::$cache_manager;
    }

    /**
     *
     * Set Cache Manager
     *
     * @param FilesystemCache $cache_manager
     */
    public static function setCacheManager($cache_manager)
    {
        self::$cache_manager = $cache_manager;
    }

    /**
     *
     * Set settings
     *
     * @param ResourcesSettingsModel $settings
     */
    public function setSettings($settings)
    {
        $this->settings = $settings;
    }
}
