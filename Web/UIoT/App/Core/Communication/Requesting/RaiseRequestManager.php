<?php

/**
 * UIoTuims
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
 * @app UIoT User-Friendly Management System
 * @author UIoT
 * @developer Claudio Santoro
 * @developer Igor Moraes
 * @copyright University of Brasília
 */

namespace UIoT\App\Core\Communication\Requesting;

use Httpful\Request;
use UIoT\App\Core\Settings\Register as SettingsRegister;
use UIoT\App\Data\Models\Settings\RaiseSettingsModel;

/**
 * Class RaiseRequestManager
 * @package UIoT\App\Core\Communication\Requesting
 */
class RaiseRequestManager
{
    /**
     * @var RaiseSettingsModel
     */
    public static $restData;

    /**
     * @var Request
     */
    public static $handler;

    /**
     * @var string
     */
    public static $raiseBaseUri = 'http://localhost:80/';

    /**
     * Start Raise
     *
     * Raise constructor.
     */
    public function __construct()
    {
        self::setSettings();
        self::setHost();
    }

    /**
     * Set Raise Settings
     */
    public static function setSettings()
    {
        self::$restData = SettingsRegister::getSetting('raise');
    }

    /**
     * Set Raise Host (Base Url)
     */
    public static function setHost()
    {
        self::$raiseBaseUri =
            (self::$restData->raiseSsl === true ? 'https' : 'http')
            . '://' . self::$restData->raiseHost . ':' . self::$restData->raisePort . '/' .
            (!empty(self::$restData->raiseBasePath) ? (self::$restData->raiseBasePath . '/') : '');
    }

    /**
     * Set Options
     *
     * @param Request $options
     */
    public static function setTemplate($options)
    {
        Request::ini($options);
    }

    /**
     * Do the request, and get Request Body.
     *
     * @param string $url
     * @return mixed
     */
    public static function doRequest($url)
    {
        return (new RequestDataManager(self::$raiseBaseUri . $url))->get_data('body');
    }

    /**
     * Get Query String
     *
     * @param string $inputPath
     * @param mixed $inputArray
     * @return string
     */
    public static function getQueryStringUri($inputPath, $inputArray)
    {
        $requiredArray = array_slice($inputArray, 2);

        $queryArray = [];

        foreach(array_flip($requiredArray) as $key => $value) {
            if(array_key_exists($value + 1, $requiredArray)) {
                $queryArray[$key] = rawurldecode($requiredArray[$value + 1]);
            }
        }

        return "{$inputPath}?" . http_build_query($queryArray);
    }
}
