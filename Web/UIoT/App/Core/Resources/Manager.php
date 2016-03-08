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

use Assetic\Asset\AssetCache;
use Assetic\Asset\AssetCollection;
use Assetic\Asset\FileAsset;
use Assetic\AssetManager;
use Assetic\Cache\FilesystemCache;
use Assetic\Factory\AssetFactory;
use UIoT\App\Core\Helpers\Manipulation\Constants;
use UIoT\App\Core\Helpers\System\Settings;
use UIoT\App\Core\Helpers\System\Settings\SettingsIndexer;
use UIoT\App\Data\Models\Settings\ResourcesSettingsModel;

/**
 * Class Manager
 * @package UIoT\App\Core\Resources
 */
final class Manager
{
    /**
     * Asset Manager Instance
     *
     * @var AssetManager
     */
    private static $asset_manager;

    /**
     * @var AssetFactory
     */
    private static $asset_factory;

    /**
     * Enable/Disable File System Cache
     *
     * @var bool
     */
    private static $enable_caching = false;

    /**
     * Cache Manager
     *
     * @var FileSystemCache
     */
    private static $cache_manager;

    /**
     * Settings variable
     *
     * @var ResourcesSettingsModel
     */
    private $settings;

    /**
     * Manager constructor.
     */
    public function __construct()
    {
        self::setSettings(SettingsIndexer::getSetting('resources'));
        self::setAssetManager(new AssetManager);
        self::setAssetFactory(new AssetFactory(Constants::returnConstant('RESOURCE_FOLDER')));
        self::getAssetFactory()->setAssetManager($this->getAssetManager());
        self::setEnableCaching($this->settings->enableCaching);
    }

    /**
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
     * Return Asset Name
     *
     * @param string $asset_name
     *
     * @return AssetCollection
     */
    public static function returnAsset($asset_name)
    {
        return self::getAssetFactory()->createAsset("@{$asset_name}");
    }

    /**
     * Get Asset Manager
     *
     * @return AssetManager
     */
    public static function getAssetManager()
    {
        return self::$asset_manager;
    }

    /**
     * Set Asset Manager
     *
     * @param AssetManager $asset_manager
     */
    public static function setAssetManager(AssetManager $asset_manager)
    {
        self::$asset_manager = $asset_manager;
    }

    /**
     * Get Asset Factory
     *
     * @return AssetFactory
     */
    public static function getAssetFactory()
    {
        return self::$asset_factory;
    }

    /**
     * Set Asset Factory
     *
     * @param AssetFactory $asset_factory
     */
    public static function setAssetFactory($asset_factory)
    {
        self::$asset_factory = $asset_factory;
    }

    /**
     * Return if is Enabled Cache System
     *
     * @return boolean
     */
    public static function isCachingEnabled()
    {
        return self::$enable_caching;
    }

    /**
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
     * Return Cache Manager
     *
     * @return FilesystemCache
     */
    public static function getCacheManager()
    {
        return self::$cache_manager;
    }

    /**
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
    public function setSettings(ResourcesSettingsModel $settings)
    {
        $this->settings = $settings;
    }
}
