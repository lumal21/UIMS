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

namespace UIoT\App\Core\Views;

use UIoT\App\Core\Helpers\Manipulators\Strings;

/**
 * Class Indexer
 * @package UIoT\App\Data\Views
 */
final class Indexer
{
	/**
	 * Views Array
	 *
	 * @var array
	 */
	private static $view = [];

	/**
	 * Add a View
	 *
	 * @param string $view_name
	 */
	public static function addView($view_name = '')
	{
		if (self::viewExists($view_name))
			return;

		self::$view[$view_name] = [];
		self::addViewAction($view_name, 'Main');
	}

	/**
	 * Check if View Exists
	 *
	 * @param string $view_name
	 * @return bool
	 */
	public static function viewExists($view_name = '')
	{
		return array_key_exists($view_name, self::$view);
	}

	/**
	 * Add View Action
	 *
	 * @param string $view_name
	 * @param string $action_name
	 */
	public static function addViewAction($view_name, $action_name)
	{
		(!self::viewExists($view_name) && self::actionExists($view_name, $action_name)) || array_push(self::$view[$view_name], $action_name);
	}

	/**
	 * Check if Action Exists
	 *
	 * @param string $view_name
	 * @param string $action_name
	 * @return bool
	 */
	public static function actionExists($view_name, $action_name)
	{
		return array_key_exists($action_name, self::$view[$view_name]);
	}

	/**
	 * Remove View Action
	 *
	 * @param string $view_name
	 * @param string $action_name
	 */
	public static function removeViewAction($view_name, $action_name)
	{
		if (self::viewExists($view_name) && self::actionExists($view_name, $action_name))
			unset(self::$view[$view_name][$action_name]);
	}

	/**
	 * Remove View
	 *
	 * @param string $view_name
	 */
	public static function removeView($view_name)
	{
		if (self::viewExists($view_name))
			unset(self::$view[$view_name]);
	}

	/**
	 * Get View Name
	 * Return all View Names by Action
	 *
	 * @param string $action_name
	 * @return mixed|array
	 */
	public static function getViewName($action_name)
	{
		return array_keys($action_name, self::$view);
	}

	/**
	 * Return View Actions by View Name
	 *
	 * @param string $view_name
	 * @return mixed|array
	 */
	public static function getViewAction($view_name)
	{
		return self::$view[$view_name] || [];
	}

	/**
	 * Open the View
	 *
	 * @param string $view_name
	 * @return mixed
	 */
	public static function getView($view_name)
	{
		return self::openView($view_name);
	}

	/**
	 * Return a Instance of the View
	 *
	 * @param string $view_name
	 * @return mixed
	 */
	public static function openView($view_name)
	{
		return self::viewExists(self::getViewReverseSpace($view_name)) ? (new $view_name)->__show() : '';
	}

	/**
	 * Really Crazy but Works
	 * (Is for return a reverse namespace)
	 *
	 * @param string $view_name_space
	 * @return string
	 */
	public static function getViewReverseSpace(&$view_name_space)
	{
		$view_name_space = self::getViewNameSpace($view_name = $view_name_space);

		return $view_name;
	}

	/**
	 * Return the Namespace form the View
	 *
	 * @param string $view_name
	 * @return string
	 */
	public static function getViewNameSpace($view_name)
	{
		return Strings::toNameSpace($view_name, 'UIoT\App\Data\Views\\');
	}
}
