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

namespace UIoT\App\Data\Models\Settings;

use UIoT\App\Data\Interfaces\Settings\SettingsInterface;

/**
 * Class ExceptionSettingsModel
 * @package UIoT\App\Data\Models\Settings
 */
final class ExceptionSettingsModel implements SettingsInterface
{
    /**
     * @var string
     */
    public $errorPageTitle = 'Houston, we have a problem!';

    /**
     * @see http://php.net/manual/pt_BR/function.error-reporting.php
     * @var integer php error reporting level
     */
    public $errorReportingLevels = (E_ALL ^ E_WARNING);

    /**
     * @see SecuritySettingsModel::$whiteIpList
     * @var string
     */
    public $errorDeveloperCode = 'de';

    /**
     * @var string
     */
    public $errorResourceFolder = 'Whoops';

    /**
     * Return Block Name
     *
     * @return string
     */
    public function getBlockName()
    {
        return 'exceptions';
    }
}
