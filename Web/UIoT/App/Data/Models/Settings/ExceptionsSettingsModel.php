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

namespace UIoT\App\Data\Models\Settings;

use UIoT\App\Data\Interfaces\SettingsInterface;

/**
 * Class ExceptionSettingsModel
 *
 * @package UIoT\App\Data\Models\Settings
 */
class ExceptionSettingsModel implements SettingsInterface
{
    const settingsBlockName = 'exceptions';

    /**
     *
     * Error page title
     *
     * @var string
     */
    var $errorPageTitle;

    /**
     *
     * php error reporting level
     *
     * @see http://php.net/manual/pt_BR/function.error-reporting.php
     *
     * @var integer
     */
    var $errorReportingLevels;

    /**
     *
     * URI query string to access error details
     *
     * IP must be in white list
     *
     * @see SecuritySettingsModel::$whiteIpList
     *
     * @var string
     */
    var $errorDeveloperCode;

    /**
     *
     * Error page resource folder
     *
     * @var string
     */
    var $errorResourceFolder;
}
