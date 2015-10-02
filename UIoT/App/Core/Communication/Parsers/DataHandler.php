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
 * @copyright University of Brasília
 */

namespace UIoT\App\Core\Communication\Parsers;

use Httpful\Http;
use UIoT\App\Core\Helpers\Manipulators\Arrays;
use UIoT\App\Core\Helpers\Manipulators\Strings;
use UIoT\App\Core\Layouts\Indexer;
use UIoT\App\Data\Models\Layout;

/**
 * Class DataHandler
 * @package UIoT\App\Core\Communication\Parsers
 */
class DataHandler
{

    private static $handlers = [], $layouts = [], $parsers = [], $names = [], $collectors = [];

    /**
     * Start the Handler
     */
    function __construct()
    {
        $this->startHandler();
    }

    /**
     * Return NameSpace String
     *
     * @param string $string
     * @return string
     */
    private static function getNameSpace($string = '')
    {
        return (__NAMESPACE__ . '\\' . $string);
    }

    /**
     * Return Handlers NameSpace String
     * @param string $string
     * @return string
     */
    private static function getHandlerNameSpace($string = '')
    {
        return (self::getNameSpace('Handlers\\' . $string));
    }

    /**
     * Register Httpful UIoT Handlers
     * Methods: GET, POST, PUT, DELETE
     * Default Handlers: Gettable, Postable, Puttable, Deletable
     */
    private static function registerHandlers()
    {
        self::$handlers = [
            Http::GET => self::getHandlerNameSpace('Gettable'),
            Http::POST => self::getHandlerNameSpace('Postable'),
            Http::PUT => self::getHandlerNameSpace('Puttable'),
            Http::DELETE => self::getHandlerNameSpace('Deletable'),
        ];
    }

    /**
     * Register Httpful UIoT Layouts
     * Methods: GET, POST, PUT, DELETE
     * Default Layouts: By Layout Names ->registerNames();
     * You can put other names ;)
     */
    private static function registerLayouts()
    {
        self::$layouts = [
            Http::GET => Indexer::addLayout(Strings::toControllerName(self::$names[Http::GET])),
            Http::POST => Indexer::addLayout(Strings::toControllerName(self::$names[Http::POST])),
            Http::PUT => Indexer::addLayout(Strings::toControllerName(self::$names[Http::PUT])),
            Http::DELETE => Indexer::addLayout(Strings::toControllerName(self::$names[Http::DELETE])),
        ];
    }

    /**
     * Register Layout Names
     * Methods: GET, POST, PUT, DELETE
     * Default Names: GET: main, POST: add, PUT: edit, DELETE: remove;
     */
    private static function registerNames()
    {
        self::$names = [
            Http::GET => 'main',
            Http::POST => 'add',
            Http::PUT => 'edit',
            Http::DELETE => 'remove',
        ];
    }

    /**
     * Return Parser Names
     *
     * @return array
     */
    static function getParserArray()
    {
        return Arrays::toControllerArray(array_flip(Arrays::toControllerArray(self::$names)));
    }

    /**
     * Start Indexing all Handlers and Layouts
     * Start the Handler, and register everything
     */
    static function startHandler()
    {
        /* register names */
        self::registerNames();

        /* register handlers */
        self::registerHandlers();

        /* register layouts */
        self::registerLayouts();
    }

    /**
     * Store Handler Information
     */
    static function storeHandler()
    {
        /* get collectors */
        self::$collectors = DataCollector::getCollectors();

        /* get controller name */
        $controller = DataManager::getController();

        /* index handlers and layouts */
        foreach (self::$names as $method => $name)
            self::$parsers[Strings::toActionName($name)] = ['handler' => self::$handlers[$method], 'collector' => self::$collectors[$method], 'layout' => self::$layouts[$method], 'method' => $method, 'controller' => $controller, 'name' => Strings::toActionName($name)];
    }

    /**
     * Check if Parser Exists
     *
     * @param string $name Parser Name
     * @return bool
     */
    static function parserExists($name)
    {
        return (array_key_exists($name, self::$parsers));
    }

    /**
     * Get the Parser Array
     *
     * @param string $name Parser Name
     * @return mixed
     */
    static function getParser($name)
    {
        return ((self::parserExists($name)) ? (self::$parsers[$name]) : null);
    }

    /**
     * Get Parser Method (GET, PUT, POST, DELETE)
     *
     * @param string $name Parser Name
     * @return mixed
     */
    static function getParserMethod($name)
    {
        return ((self::parserExists($name)) ? (self::$parsers[$name]['method']) : null);
    }

    /**
     * Get Parser Collector
     *
     * @param $name
     * @return null
     */
    static function getParserCollector($name)
    {
        return ((self::parserExists($name)) ? (self::$parsers[$name]['collector']) : null);
    }

    /**
     * Get Parser Controller Name
     *
     * @param $name
     * @return null
     */
    static function getParserController($name)
    {
        return ((self::parserExists($name)) ? (self::$parsers[$name]['controller']) : null);
    }

    /**
     * Get Parser Handler
     *
     * @param string $name Parser Name
     * @return mixed
     */
    static function getParserHandler($name)
    {
        return ((self::parserExists($name)) ? (self::$parsers[$name]['handler']) : null);
    }

    /**
     * Get Parser Layout (Only call the Add Layout, because we don't want add all layout's in execution time
     * Only need add the called layout.
     *
     * @param string $name Parser Name
     * @return mixed
     */
    static function getParserLayout($name)
    {
        return ((self::parserExists($name)) ? (self::$parsers[$name]['layout']) : null);
    }

    /**
     * Open Parser Layout
     * Return Layout Instance
     *
     * @param string $name Parser Name
     * @return Layout|mixed|null (Layout Instance)
     */
    static function openParserLayout($name)
    {
        return ((self::parserExists($name)) ? (Indexer::getLayout(Strings::toControllerName($name))) : null);
    }

    /**
     * Get Names
     *
     * @return array
     */
    public static function getNames()
    {
        return self::$names;
    }
}