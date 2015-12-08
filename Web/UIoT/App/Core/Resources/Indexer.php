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
	 * Resource Array
	 *
	 * @var array
	 */
	private static $resources = [];

	/**
	 * Resource Folder
	 *
	 * @var string
	 */
	private static $folder = '';

	/**
	 * Set Resource Folder
	 *
	 * @param string $f
	 */
	public static function setResourceFolder($f)
	{
		self::setFolder(Constants::returnConstant('RESOURCE_FOLDER') . $f . '/');
	}

	/**
	 * Check if File Exists
	 *
	 * @param string $file_name
	 * @return bool
	 */
	public static function fileExists($file_name)
	{
		return is_file(Strings::toRestUrlName(self::getFolder() . $file_name));
	}

	/**
	 * Add Resource
	 *
	 * @param string $file_name
	 * @param string $mime_type
	 */
	public static function addResource($file_name, $mime_type)
	{
		self::$resources[strtolower($file_name)] = [
			'mime_type' => $mime_type,
			'file_content' => self::parseResourceFile(self::getFolder() . Strings::toRestUrlName($file_name))
		];
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
		LIndexer::addLayout($layout_name, strtok($layout_name, '_'));

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
		$resource_array = array_keys(self::getResources());

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
	 * Check if Session array exists, if yes, return the session array as resource file names
	 * if not, return local array of resource file names.
	 *
	 * @return array
	 */
	public static function getResourceSessionValue()
	{
		return SIndexer::keyExists('layout') ? (array)SIndexer::getKeyValue('layout') : (array)array_keys(self::getResources());
	}

	/**
	 * Update Resource Change
	 *
	 * @param string $file_name
	 */
	public static function updateResourceChange($file_name)
	{
		SIndexer::updateKey('layout', self::resourceRemove(Strings::toRestUrlName($file_name)));
	}

	/**
	 * Return Resource
	 *
	 * @param string $file_name
	 * @param boolean $header
	 * @return string
	 */
	public static function returnResource($file_name, $header = true)
	{
		/* put in str to lower */
		$file_name = Strings::toRestUrlName($file_name);

		/* if resource doesn't exists, or resource is hot linked we must show error */
		self::checkResourceExistence($file_name) || self::showHotLinkErrorMessage();

		/* check for file existence */
		self::checkResourceExistence($file_name) || self::checkFileExistence($file_name);

		/* update the resource change */
		self::updateResourceChange($file_name);

		/* add header (mime-type) */
		!$header || header('Content-Type: ' . self::getResources()[$file_name]['mime_type']);

		/* return content */
		return self::getResources()[$file_name]['file_content'];
	}

	/**
	 * Remove Resource
	 *
	 * @param string $resource_name
	 * @return array
	 */
	public static function resourceRemove($resource_name)
	{
		return array_diff(array_keys(self::getResources()), [Strings::toRestUrlName($resource_name)]);
	}

	/**
	 * Parse Resource File
	 *
	 * @param string $file_name
	 * @return string
	 */
	public static function parseResourceFile($file_name)
	{
		return file_get_contents(Strings::toRestUrlName($file_name));
	}

	/**
	 * Check if Resource Exists
	 *
	 * @param string $file_name
	 * @return bool
	 */
	public static function checkResourceExistence($file_name)
	{
		return Arrays::inArray($file_name, self::getResourceSessionValue()) || stripos($file_name, 'bower') || stripos($file_name, 'Npm');
	}

	/**
	 * Check if File Exists
	 * @param string $filename
	 */
	private static function checkFileExistence($filename)
	{
		/* check if file exists */
		self::fileExists(Strings::toRestUrlName($filename)) || Register::getRunner()->errorMessage(907,
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

	/**
	 * Get Resource Array
	 *
	 * @return array
	 */
	public static function getResources()
	{
		return self::$resources;
	}

	/**
	 * Set Resource Array
	 *
	 * @param array $resources
	 */
	public static function setResources($resources)
	{
		self::$resources = $resources;
	}

	/**
	 * Get Folder String
	 *
	 * @return string
	 */
	public static function getFolder()
	{
		return self::$folder;
	}

	/**
	 * Set Folder String
	 *
	 * @param string $folder
	 */
	public static function setFolder($folder)
	{
		self::$folder = Strings::toRestUrlName($folder);
	}
}
