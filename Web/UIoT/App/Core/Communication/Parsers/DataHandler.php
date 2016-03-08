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

namespace UIoT\App\Core\Communication\Parsers;

use Httpful\Http;
use UIoT\App\Core\Helpers\Manipulation\Arrays;
use UIoT\App\Core\Helpers\Manipulation\Strings;
use UIoT\App\Core\Layouts\Indexer;

/**
 * Class DataHandler
 * Manages the Handling of the Specific Data of Each Type
 *
 * @package UIoT\App\Core\Communication\Parsers
 */
class DataHandler
{

    /**
     * @var array
     */
    private static $handlers = [];
    /**
     * @var array
     */
    private static $layouts = [];
    /**
     * @var array
     */
    private static $parsers = [];
    /**
     * @var array
     */
    private static $names = [];
    /**
     * @var array
     */
    private static $collectors = [];

    /**
     * Start the Handler
     */
    public function __construct()
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
            Http::GET => Indexer::addLayout(Strings::toActionName(self::$names[Http::GET])),
            Http::POST => Indexer::addLayout(Strings::toActionName(self::$names[Http::POST])),
            Http::PUT => Indexer::addLayout(Strings::toActionName(self::$names[Http::PUT])),
            Http::DELETE => Indexer::addLayout(Strings::toActionName(self::$names[Http::DELETE])),
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
            Http::GET => 'home',
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
    public static function getParserArray()
    {
        return Arrays::toControllerArray(array_flip(Arrays::toControllerArray(self::$names)));
    }

    /**
     * Start Indexing all Handlers and Layouts
     * Start the Handler, and register everything
     */
    public static function startHandler()
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
    public static function storeHandler()
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
    public static function parserExists($name)
    {
        return (array_key_exists($name, self::$parsers));
    }

    /**
     * Get the Parser Array
     *
     * @param string $name Parser Name
     * @return mixed
     */
    public static function getParser($name)
    {
        return self::parserExists($name) ? self::$parsers[$name] : null;
    }

    /**
     * Get Parser Variable
     *
     * @param $name
     * @param $variable
     * @return null
     */
    protected static function getParserVariable($name, $variable)
    {
        return self::parserExists($name) ? self::$parsers[$name][$variable] : null;
    }

    /**
     * Get Parser Method (GET, PUT, POST, DELETE)
     *
     * @param string $name Parser Name
     * @return mixed
     */
    public static function getParserMethod($name)
    {
        return self::getParserVariable($name, 'method');
    }

    /**
     * Get Parser Collector
     *
     * @param $name
     * @return \UIoT\App\Data\Models\CollectorModel
     */
    public static function getParserCollector($name)
    {
        return self::getParserVariable($name, 'collector');
    }

    /**
     * Get Parser Controller Name
     *
     * @param $name
     * @return null
     */
    public static function getParserController($name)
    {
        return self::getParserVariable($name, 'controller');
    }

    /**
     * Get Parser Handler
     *
     * @param string $name Parser Name
     * @return mixed
     */
    public static function getParserHandler($name)
    {
        return self::getParserVariable($name, 'handler');
    }

    /**
     * Get Parser Layout (Only call the Add Layout, because we don't want add all layout's in execution time
     * Only need add the called layout.
     *
     * @param string $name Parser Name
     * @return mixed
     */
    public static function getParserLayout($name)
    {
        return self::getParserVariable($name, 'layout');
    }

    /**
     * Open Parser Layout
     * Return Layout Instance
     *
     * @param string $name Parser Name
     * @return string|null (Layout Instance)
     */
    public static function openParserLayout($name)
    {
        return self::parserExists($name) ? Indexer::getLayout(Strings::toControllerName($name)) : null;
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
