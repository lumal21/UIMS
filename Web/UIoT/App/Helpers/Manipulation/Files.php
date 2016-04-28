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
 *
 * @package UIoT\App\Helpers\Manipulation
 *
 * @observation this is a singleton
 */
class Files
{
    /**
     * File Instance
     *
     * @var SplFileInfo|null
     */
    protected static $spl_file_info_instance;

    /**
     * File Instance
     *
     * @var Files
     */
    protected static $files_instance;

    /**
     * Instantiate SplFileInfo Class
     *
     * Files constructor.
     */
    final private function __construct()
    {
        if (NULL !== self::$files_instance)
            return;

        Manager::throwError(908, 'Stop!', 'You cannot instantiate a singleton!', [
            'What happened?' => 'Singletons are not instantiated by the user!']);
    }

    /**
     * Get File Base Name
     *
     * @param string $file_path
     *
     * @return string
     */
    public static function getBaseName($file_path)
    {
        self::checkInstance($file_path);

        return self::getSplFileInfoInstance()->getBasename('.' . self::getSplFileInfoInstance()->getExtension());
    }

    /**
     * Check Instance
     *
     * @param $file_name
     */
    final private static function checkInstance($file_name)
    {
        if (self::$spl_file_info_instance === null)
            self::create($file_name);
    }

    /**
     * Instantiate SplFileInfo Class
     *
     * @param $file_name
     */
    final private static function create($file_name)
    {
        empty($file_name) || self::$spl_file_info_instance = new SplFileInfo($file_name);
    }

    /**
     * Get Spl File Info Instance
     *
     * @return null|SplFileInfo
     */
    private static function getSplFileInfoInstance()
    {
        return self::$spl_file_info_instance;
    }

    /**
     * Get File Extension
     *
     * @param string $file_path
     *
     * @return string
     */
    public static function getExtension($file_path)
    {
        self::checkInstance($file_path);

        return self::getSplFileInfoInstance()->getExtension();
    }

    /**
     * Get Only File Name
     *
     * @param $file_path
     *
     * @return string
     */
    public static function getFileName($file_path)
    {
        self::checkInstance($file_path);

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
        self::$files_instance = null;
    }

    /**
     * Return Last Instance
     *
     * @return Files
     */
    public static function getLastInstance()
    {
        if (NULL === self::$files_instance)
            self::$files_instance = new self;

        return self::$files_instance;
    }

    /**
     * Clone SplFileInfo Instance
     */
    final private function __clone()
    {
        self::$spl_file_info_instance = clone self::$spl_file_info_instance;
    }
}
