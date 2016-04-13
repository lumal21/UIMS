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

namespace UIoT\App\Exception;

use UIoT\App\Core\Settings\Register as SettingsRegister;
use UIoT\App\Data\Models\Settings\ExceptionSettingsModel;
use UIoT\App\Exception\Template\Handler;
use UIoT\App\Helpers\Manipulation\Constants;
use Whoops\Run;

/**
 * Class Manager
 * Exception Manager
 *
 * @package UIoT\App\Exception
 */
final class Manager
{
    /**
     *
     * Settings variable
     *
     * @var ExceptionSettingsModel
     */
    private static $settings;

    /**
     * Create Instance of Everything
     *
     * Manager constructor.
     */
    public function __construct()
    {
        $this->setClasses();
        $this->setSettings();
        $this->registerHandler();
    }

    /**
     * Set Classes
     */
    private function setClasses()
    {
        Register::setHandler(new Handler);
        Register::setRunner(new Run);
    }

    /**
     * Check if Trying to Access Developer Mode
     *
     * @return bool
     */
    public static function checkDeveloperMode()
    {
        return Constants::returnConstant('QUERY_STRING') == self::$settings->errorDeveloperCode;
    }

    /**
     * Set Page Handler Settings
     */
    private function setSettings()
    {
        self::$settings = SettingsRegister::getSetting('exceptions');

        Register::setErrorLevels(self::$settings->errorReportingLevels);
        Register::addResourcePath(self::getResourcePath());
        Register::setPageTitle(self::$settings->errorPageTitle);
    }

    /**
     * Get Resource Path
     *
     * @return string
     */
    public static function getResourcePath()
    {
        return Constants::returnConstant('RESOURCE_FOLDER') . self::$settings->errorResourceFolder . '/';
    }

    /**
     * Register Page Handler
     */
    private function registerHandler()
    {
        Register::pushHandler();
        Register::registerHandler();
    }
}
