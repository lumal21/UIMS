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

namespace UIoT\App\Core\Helpers\Manipulators;


final class Settings
{
	/**
	 * @var object
	 */
	private static $settings;

	/**
	 * Store and Set Settings
	 *
	 * @param array $setting_variable
	 */
	public static function setAndStoreSettings($setting_variable = [])
	{
		self::storeSettings($setting_variable);
		self::setSettings();
	}

	/**
	 * Store Settings Constant
	 *
	 * @param array $setting_variable
	 */
	public static function storeSettings($setting_variable = [])
	{
		Constants::addJsonConstant
		(
			'SETTINGS',
			$setting_variable,
			JSON_FORCE_OBJECT
		);
	}

	/**
	 * Return Specific Setting Variable
	 *
	 * @param string $setting_variable_name
	 * @return mixed
	 */
	public static function getSetting($setting_variable_name = '')
	{
		return self::getSettings()->$setting_variable_name;
	}

	/**
	 * Return Settings Constants
	 *
	 * @return mixed
	 */
	public static function getSettings()
	{
		return self::$settings;
	}

	/**
	 * Set Settings
	 */
	public static function setSettings()
	{
		self::$settings = Constants::returnJsonConstant('SETTINGS');
	}
}
