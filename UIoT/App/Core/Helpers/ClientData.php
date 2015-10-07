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
 * @copyright University of Brasília
 */

namespace UIoT\App\Core\Helpers;

/**
 * Class ClientData
 * @package UIoT\App\Core\Helpers
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
        /* ip possible headers */
        $header_checks = [
            'HTTP_CLIENT_IP',
            'HTTP_PRAGMA',
            'HTTP_CONNECTION',
            'HTTP_CACHE_INFO',
            'HTTP_PROXY',
            'HTTP_PROXY_CONNECTION',
            'HTTP_VIA',
            'HTTP_X_COMING_FROM',
            'HTTP_COMING_FROM',
            'HTTP_X_FORWARDED_FOR',
            'HTTP_X_FORWARDED',
            'HTTP_X_CLUSTER_CLIENT_IP',
            'HTTP_FORWARDED_FOR',
            'HTTP_FORWARDED',
            'REMOTE_ADDR'
        ];

        /* check ip combinations */
        foreach ($header_checks as $key)
            if (array_key_exists($key, ((array)json_decode(SERVER_WEB))) === true)
                if (($ip = self::checkIpCombination($key)) !== false)
                    return $ip;

        /* if is nothing above */
        return 'UNKNOWN';
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