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

namespace UIoT\App\Exception;

use UIoT\App\Core\Helpers\Manipulation\Constants;
use UIoT\App\Core\Helpers\System\Settings;
use UIoT\App\Core\Helpers\System\Settings\SettingsIndexer;
use UIoT\App\Data\Models\Settings\ExceptionSettingsModel;
use UIoT\App\Exception\Template\Handler;

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
        Register::setRunner(new Collector);
    }

    /**
     * Check if Trying to Access Developer Mode
     *
     * @return bool
     */
    public static function checkDeveloperMode()
    {
        return Constants::returnConstant('QUERY_STRING') != self::$settings->errorDeveloperCode;
    }

    /**
     * Set Page Handler Settings
     */
    private function setSettings()
    {
        self::$settings = SettingsIndexer::getSetting('exceptions');

        Register::setErrorLevels(self::$settings->errorReportingLevels);
        Register::addResourcePath(Constants::returnConstant('RESOURCE_FOLDER') . self::$settings->errorResourceFolder . '/');
        Register::setPageTitle(self::$settings->errorPageTitle);
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
