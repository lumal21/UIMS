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


namespace UIoT\App\Core\Helpers\Data;
use UIoT\App\Core\Helpers\Manipulation\Constants;

/**
 * Class UrlCombinations
 * @package UIoT\App\Core\Helpers\Manipulation
 */
class UrlCombinations
{
	/**
	 * @var array
	 */
	protected static $layouts = [];
	/**
	 * @var array
	 */
	protected static $resources = [];
	/**
	 * @var array
	 */
	protected static $url = [];
	/**
	 * @var array
	 */
	protected static $combined_url;
	/**
	 * @var array
	 */
	protected static $combinations;
	/**
	 * @var array
	 */
	protected static $reversed_f;
	/**
	 * @var array
	 */
	protected static $normal_f;

	/**
	 * Get Combined Url
	 *
	 * @return array
	 */
	public static function getCombinedUrl()
	{
		return self::$combined_url;
	}

	/**
	 * Set Combined Url
	 *
	 * @param array $combined_url
	 * @return array
	 */
	public static function setCombinedUrl($combined_url)
	{
		return (self::$combined_url = $combined_url);
	}

	/**
	 * Get Combinations
	 *
	 * @return array
	 */
	public static function getCombinations()
	{
		return self::$combinations;
	}

	/**
	 * Get Layouts
	 *
	 * @return mixed
	 */
	public static function getLayouts()
	{
		return self::$layouts;
	}

	/**
	 * Set Layouts
	 *
	 * @param array $layouts
	 * @return mixed
	 */
	public static function setLayouts($layouts)
	{
		return (self::$layouts = $layouts);
	}

	/**
	 * Get Url Combination
	 *
	 * @return mixed|array|null
	 */
	public static function getNormalF()
	{
		return self::$normal_f;
	}

	/**
	 * Set Url Combination
	 *
	 * @param array $normal_f
	 * @return array
	 */
	public static function setNormalF($normal_f = [])
	{
		return !is_array(self::getNormalF()) ? (self::$normal_f = $normal_f) : [];
	}

	/**
	 * Get Reversed Url Combination
	 *
	 * @return mixed|array|null
	 */
	public static function getReversedF()
	{
		return self::$reversed_f;
	}

	/**
	 * Set Reversed Url Combination
	 *
	 * @param array $reversed_f
	 * @return array
	 */
	public static function setReversedF($reversed_f = [])
	{
		return !is_array(self::getReversedF()) ? (self::$reversed_f = $reversed_f) : [];
	}

	/**
	 * Set Url
	 *
	 * @return array
	 */
	public static function getUrl()
	{
		return self::$url;
	}

	/**
	 * Return the Controller Url
	 * For Resource
	 *
	 * @param $c
	 * @return mixed
	 */
	protected static function checkResourceInto($c)
	{
		return ($c['controller'] != Constants::returnConstant('DEFAULT_CONTROLLER')) ? ((self::checkIsResourceAction($c)) ? ($c['action']) : ((self::checkIsDefaultAction($c)) ? ($c['controller']) : ($c['action']))) : ($c['controller']);
	}

	/**
	 * Check if is Resource Action
	 *
	 * @param array $c
	 * @return bool
	 */
	protected static function checkIsResourceAction($c)
	{
		return (!in_array($c['action'], self::getResources()) && ($c['action'] == $c['controller']));
	}

	/**
	 * Get All Resources
	 *
	 * @return array
	 */
	public static function getResources()
	{
		return self::$resources;
	}

	/**
	 * Set Resources
	 *
	 * @param array $resources
	 * @return array
	 */
	public static function setResources($resources)
	{
		return (self::$resources = $resources);
	}

	/**
	 * Check if is Default Action
	 *
	 * @param array $c
	 * @return bool
	 */
	protected static function checkIsDefaultAction($c)
	{
		return (($c['action'] == $c['controller']) || ($c['action'] != Constants::returnConstant('DEFAULT_VIEW_ACTION')));
	}
}
