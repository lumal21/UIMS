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
 * @copyright University of Bras�lia
 */

namespace UIoT\App\Exception;

use Exception;
use Whoops\Handler\PrettyPageHandler as WhoopsHandler;

/**
 * Class Register
 * @package UIoT\App\Exception
 */
final class Register
{
    /**
     * static variable to store exception page handler
     *
     * @var WhoopsHandler
     */
    private static $handler;

    /**
     * static variable to store exception page runner
     *
     * @var Runner
     */
    private static $runner;

    /**
     * Set Page Handler
     *
     * @param WhoopsHandler $handler
     */
    public static function setHandler(WhoopsHandler $handler)
    {
        self::$handler = new $handler;
    }

    /**
     * Set Page Runner
     *
     * @param Runner $runner
     */
    public static function setRunner(Runner $runner)
    {
        self::$runner = new $runner;
    }

    /**
     * Get Runner
     *
     * @return Runner
     */
    public static function getRunner()
    {
        return self::$runner;
    }

    /**
     * Get Handler
     *
     * @return WhoopsHandler|callable
     */
    public static function getHandler()
    {
        return self::$handler;
    }

    /**
     * Add Resource Path
     *
     * @param string $resource_path
     */
    public static function addResourcePath($resource_path = '')
    {
        self::getHandler()->addResourcePath($resource_path);
    }

    /**
     * Set Page Title
     *
     * @param string $page_title
     */
    public static function setPageTitle($page_title = '')
    {
        self::getHandler()->setPageTitle($page_title);
    }

    /**
     * Push the Page Handler
     */
    public static function pushHandler()
    {
        self::getRunner()->pushHandler(self::getHandler());
    }

    /**
     * Register the Page Handler
     */
    public static function registerHandler()
    {
        self::getRunner()->register();
    }

    /**
     * Add Data Table on Page Handler
     *
     * @param string $message_title
     * @param array $message
     */
    public static function addDataTable($message_title = '', $message = [])
    {
        self::getHandler()->addDataTable($message_title, $message);
    }

    /**
     * Handle a PhP Exception
     *
     * @param Exception $exception
     */
    public static function handleException(Exception $exception)
    {
        self::getRunner()->handleException($exception);
    }

    /**
     * Set Error Reporting Levels
     *
     * @param string $error_levels
     */
    public static function setErrorLevels($error_levels = '')
    {
        error_reporting($error_levels);
    }
}