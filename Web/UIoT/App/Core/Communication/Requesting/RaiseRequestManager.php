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
}
