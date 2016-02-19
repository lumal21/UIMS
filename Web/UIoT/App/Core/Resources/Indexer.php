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

use UIoT\App\Core\Communication\Sessions\Indexer as SIndexer;
use UIoT\App\Core\Helpers\Manipulation\Arrays;
use UIoT\App\Core\Helpers\Manipulation\Constants;
use UIoT\App\Core\Helpers\Manipulation\Strings;
use UIoT\App\Core\Layouts\Indexer as LIndexer;
use UIoT\App\Exception\Register;

/**
 * Class Indexer
 * @package UIoT\App\Core\Resources
 */
final class Indexer
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
	public static function addAsset($asset_name, $asset_folder, $asset_file_name)
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
	 * Return Asset
	 *
	 * @param string $asset_name
	 *
	 * @return string
	 */
	public static function returnResource($asset_name)
	{
		/* if resource doesn't exists, or resource is hot linked we must show error */
		self::checkIfAssetIsValid($asset_name) || self::showHotLinkErrorMessage();

		/* check for file existence */
		self::checkIfAssetIsValid($asset_name) || self::checkAssetExistence($asset_name);

		/* update the resource change */
		self::updateAssetsChanges($asset_name);

		/* return asset */
		return Manager::returnAsset($asset_name)->dump();
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
		return Arrays::inArray($asset_name, self::getAvailableAssets());
	}

	/**
	 * Check if Asset exists
	 *
	 * @param string $asset_name
	 */
	private static function checkAssetExistence($asset_name)
	{
		!Manager::getAssetManager()->has($asset_name) || Register::getRunner()->errorMessage(907,
			"404!",
			'Details: ',
			[
				'What Happened?' => "Sorry but this file doesn't exists.",
				'Solution:' => "Go Back to Home Page.",
				'Are you the developer?' => 'You can open this same error Page with Developer Code, only need put ?de on the Url'
			]
		);
	}

	/**
	 * Show Hot Link Error Message
	 */
	private static function showHotLinkErrorMessage()
	{
		/* show hot link error message */
		Register::getRunner()->errorMessage(903,
			'Stop! D\'not Hotlinks!',
			'Details: ',
			[
				'What Happened?' => 'You\'re a bitch, and trying to get resources...',
				'Resolution:' => 'Stop giving 555xxxx requests!',
				'Are you the developer?' => 'You can open this same error Page with Developer Code, only need put ?de on the Url'
			]
		);
	}
}
