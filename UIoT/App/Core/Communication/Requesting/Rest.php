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

namespace UIoT\App\Core\Communication\Requesting;

use Httpful\Request;

/**
 * Class Rest
 * @package UIoT\App\Core\Communication\Requesting
 */
final class Rest
{
    /**
     * Rest Settings
     *
     * @var array
     */
    static $rest_data = [];

    /**
     * Rest Handler
     *
     * @var Request
     */
    static $handler;

    /**
     * Default Url
     *
     * @var string
     */
    static $raise_base_uri = 'http://localhost:80/';

    /**
     * Set Raise Settings
     */
    static function setSettings()
    {
        self::$rest_data = (json_decode(SETTINGS)->raise);
    }

    /**
     * Set Options
     *
     * @param string|array|mixed $options
     */
    static function setTemplate($options)
    {
        Request::ini($options);
    }

    /**
     * Set Raise Host (Base Url)
     */
    static function setHost()
    {
        self::$raise_base_uri = (((self::$rest_data->ssl == true) ? 'https' : 'http') . '://' . self::$rest_data->host . ':' . self::$rest_data->port . '/' . ((!empty(self::$rest_data->base_path)) ? (self::$rest_data->base_path . '/') : ''));
    }

    /**
     * Do the request, and get Request Body.
     *
     * @param string $url
     * @return mixed|string|array|null|object
     */
    static function doRequest($url)
    {
        return (new Data(self::$raise_base_uri . $url))->get_data('body');
    }
}