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

namespace UIoT\App\Core\Helpers\Data;

use UIoT\App\Core\Helpers\Manipulation\Constants;

/**
 * Class ClientData
 * @package UIoT\App\Core\Helpers\Data
 */
final class ClientData
{
	/**
	 * Get Real User Ip Address
	 *
	 * @return string|false
	 */
	public static function getRealClientIpAddress()
	{
		foreach (['HTTP_CLIENT_IP', 'HTTP_PRAGMA', 'HTTP_CONNECTION', 'HTTP_CACHE_INFO', 'HTTP_PROXY', 'HTTP_PROXY_CONNECTION', 'HTTP_VIA', 'HTTP_X_COMING_FROM', 'HTTP_COMING_FROM', 'HTTP_X_FORWARDED_FOR', 'HTTP_X_FORWARDED', 'HTTP_X_CLUSTER_CLIENT_IP', 'HTTP_FORWARDED_FOR', 'HTTP_FORWARDED', 'REMOTE_ADDR'] as $key)
			if (array_key_exists($key, Constants::returnJsonConstant('SERVER_WEB')) === true)
				if (($ip = self::checkIpCombination($key)) !== false)
					return $ip;
		return '127.0.0.1';
	}

	/**
	 * Check Specific IP Combination
	 *
	 * @param string $key
	 * @return string|false
	 */
	private static function checkIpCombination($key = '')
	{
		foreach (explode(',', $_SERVER[$key]) as $ip)
			if (filter_var($ap = trim($ip), FILTER_VALIDATE_IP, FILTER_FLAG_IPV4) !== false)
				return $ap;
		return false;
	}
}
