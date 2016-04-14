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

namespace UIoT\App\Core\Communication\Parsers;

use Httpful\Mime;
use UIoT\App\Core\Communication\Requesting\Brain;
use UIoT\App\Data\Singletons\RequestSingleton;
use UIoT\App\Helpers\Manipulation\Strings;

/**
 * Class DataManager
 * Manage the Data from Requests
 *
 * @package UIoT\App\Core\Communication\Parsers
 */
final class DataManager
{
    /**
     * Data Parsers
     *
     * @var array
     */
    private static $parsers = [];

    /**
     * Create the DataManager Instance
     */
    public function __construct()
    {
        /* start collectors and handlers */
        new DataCollector;
        new DataHandler;
        new DataTreater;

        /* store final handler */
        self::configureManager();
    }

    /**
     * Store Handler Information
     */
    private static function configureManager()
    {
        /* index handlers and layouts */
        foreach (DataHandler::getNames() as $method => $name)
            self::$parsers[Strings::toActionName($name)] = ['name' => Strings::toActionName($name), 'method' => $method];
    }

    /**
     * Check if Parser Exists
     *
     * @param string $name Parser Name
     *
     * @return bool
     */
    public static function parserExists($name)
    {
        return (array_key_exists($name, self::getParsers()));
    }

    /**
     * Get Parser Variable
     *
     * @param string $name
     * @param mixed $variable
     *
     * @return mixed|null
     */
    private static function getParserVariable($name, $variable)
    {
        return self::parserExists($name) ? self::getParsers()[$name][$variable] : null;
    }

    /**
     * Get Parser Method (GET, PUT, POST, DELETE)
     *
     * @param string $name Parser Name
     *
     * @return mixed
     */
    public static function getParserMethod($name)
    {
        return self::getParserVariable($name, 'method');
    }

    /**
     * Prepare Brain Template
     *
     * @param string $method
     */
    public static function setTemplate($method)
    {
        Brain::setTemplate(self::getParserMethod($method), Mime::JSON);
    }

    /**
     *
     * Return DataHandler and DataCollector Instance
     *
     * @param string $method
     *
     * @return RequestSingleton
     */
    public static function getInstance($method)
    {
        return DataCollector::getBaseCollector(self::getParserMethod($method));
    }

    /**
     * Get Parsers
     *
     * @return array
     */
    public static function getParsers()
    {
        return self::$parsers;
    }
}
