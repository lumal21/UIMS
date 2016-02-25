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

namespace UIoT\App\Core\Communication\Sessions;

/**
 * Class Storage
 * @package UIoT\App\Core\Communication\Sessions
 */
final class Storage
{
	/**
	 * Get Session Array Key
	 *
	 * @param string $session_key
	 * @return array
	 */
	public function getSessionArrayKey($session_key = '')
	{
		return $_SESSION[$session_key];
	}

	/**
	 * Remove Session Array Key
	 *
	 * @param string $session_array_key
	 */
	public function removeSessionArrayKey($session_array_key = '')
	{
		unset($_SESSION[$session_array_key]);
	}

	/**
	 * Set Session Array Key
	 *
	 * @param $session_array_key
	 * @param $session_array_value
	 */
	public function setSessionArrayKey($session_array_key, $session_array_value)
	{
		$_SESSION[$session_array_key] = $session_array_value;
	}

	/**
	 * Get Session Array
	 *
	 * @return array
	 */
	public function getSessionArray()
	{
		return $_SESSION;
	}
}
