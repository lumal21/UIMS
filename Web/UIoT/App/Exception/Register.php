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
 * @package UIoT\App\Exception
 */
final class Register
{
    /**
     * @var PrettyPageHandler Instance
     */
    private static $handler;

    /**
     * @var Run Page Runner
     */
    private static $runner;

    /**
     * Instantiate Page Handler and Whoops Runner
     */
    public static function create()
    {
        self::$runner = new Run;

        self::$handler = new PrettyPageHandler;
    }

    /**
     * Configure Settings
     */
    public static function configure()
    {
        self::$handler->setPageTitle(SettingsRegister::get('exceptions')->errorPageTitle);

        error_reporting(SettingsRegister::get('exceptions')->errorReportingLevels);
    }

    /**
     * Register the Page Handler and Invoke the Runner
     */
    public static function invoke()
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
