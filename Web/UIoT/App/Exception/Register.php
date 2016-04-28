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
use Whoops\Handler\PrettyPageHandler;
use Whoops\Run;

/**
 * Class Register
 * Exception Template Data/Configuration Register
 *
 * @package UIoT\App\Exception
 */
final class Register
{
    /**
     * static variable to store exception page handler
     *
     * @var PrettyPageHandler
     */
    private static $handler;

    /**
     * static variable to store exception page runner
     *
     * @var Run
     */
    private static $runner;

    /**
     * Instantiate Page Handler and Whoops Runner
     */
    public static function instantiateMembers()
    {
        self::$runner = new Run;

        self::$handler = new PrettyPageHandler;
    }

    /**
     * Configure Settings
     */
    public static function configureMembers()
    {
        self::$handler->setPageTitle(SettingsRegister::getSetting('exceptions')->errorPageTitle);

        error_reporting(SettingsRegister::getSetting('exceptions')->errorReportingLevels);
    }

    /**
     * Register the Page Handler and Invoke the Runner
     */
    public static function invokeMembers()
    {
        self::$runner->register();

        self::$runner->pushHandler(self::getHandler());
    }

    /**
     * Get Template Handler
     *
     * @return PrettyPageHandler
     */
    public static function getHandler()
    {
        return self::$handler;
    }

    /**
     * Get Whoops Runner
     *
     * @return Run
     */
    public static function getRunner()
    {
        return self::$runner;
    }
}
