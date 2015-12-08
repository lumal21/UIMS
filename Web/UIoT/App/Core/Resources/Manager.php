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
 * @copyright University of Bras�lia
 */

namespace UIoT\App\Core\Resources;

use Assetic\AssetManager;
use Assetic\Factory\AssetFactory;
use UIoT\App\Core\Helpers\Manipulation\Constants;

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
	 * Manager constructor.
	 */
	public function __construct()
	{
		self::setAssetManager(new AssetManager);
		self::setAssetFactory(new AssetFactory(Constants::returnConstant('RESOURCE_FOLDER')));
		self::getAssetFactory()->setAssetManager($this->getAssetManager());
	}

	/**
	 * Return Asset Name
	 *
	 * @param string $asset_name
	 *
	 * @return \Assetic\Asset\AssetCollection
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
}
