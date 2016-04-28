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

namespace UIoT\App\Helpers\Manipulation;

use SplFileInfo;
use UIoT\App\Exception\Manager;

/**
 * Class Files
 * @package UIoT\App\Helpers\Manipulation
 * @observation this is a singleton
 */
class Files
{
    /**
     * @var SplFileInfo|null File Info Instance
     */
    protected static $fileInfoInstance;

    /**
     * @var Files File Instance
     */
    protected static $fileInstance;

    /**
     * Instantiate SplFileInfo Class
     *
     * Files constructor.
     */
    final private function __construct()
    {
        if(null !== self::$fileInstance)
            return;

        Manager::throwError(908, 'Stop!', 'You cannot instantiate a singleton!', ['What happened?' => 'Singletons are not instantiated by the user!']);
    }

    /**
     * Get File Base Name
     *
     * @param string $filePath
     * @return string
     */
    public static function getBaseName($filePath)
    {
        self::checkInstance($filePath);

        return self::getSplFileInfoInstance()->getBasename('.' . self::getSplFileInfoInstance()->getExtension());
    }

    /**
     * Check Instance
     *
     * @param $fileName
     */
    final private static function checkInstance($fileName)
    {
        if(self::$fileInfoInstance === null)
            self::create($fileName);
    }

    /**
     * Instantiate SplFileInfo Class
     *
     * @param $fileName
     */
    final private static function create($fileName)
    {
        empty($fileName) || self::$fileInfoInstance = new SplFileInfo($fileName);
    }

    /**
     * Get Spl File Info Instance
     *
     * @return null|SplFileInfo
     */
    private static function getSplFileInfoInstance()
    {
        return self::$fileInfoInstance;
    }

    /**
     * Get File Extension
     *
     * @param string $filePath
     * @return string
     */
    public static function getExtension($filePath)
    {
        self::checkInstance($filePath);

        return self::getSplFileInfoInstance()->getExtension();
    }

    /**
     * Get Only File Name
     *
     * @param $filePath
     * @return string
     */
    public static function getFileName($filePath)
    {
        self::checkInstance($filePath);

        return self::getSplFileInfoInstance()->getFilename();
    }

    /**
     * Finish Operations with that Instance
     */
    public static function finish()
    {
        self::__destruct();

        self::getLastInstance();
    }

    /**
     * Destroy current Instance
     */
    final public function __destruct()
    {
        self::$fileInstance = null;
    }

    /**
     * Return Last Instance
     *
     * @return Files
     */
    public static function getLastInstance()
    {
        if(NULL === self::$fileInstance)
            self::$fileInstance = new self;

        return self::$fileInstance;
    }

    /**
     * Clone SplFileInfo Instance
     */
    final private function __clone()
    {
        self::$fileInfoInstance = clone self::$fileInfoInstance;
    }
}
