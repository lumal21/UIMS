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

namespace UIoT\App\Helpers\Visual;

/**
 * Class Format
 * @package UIoT\App\Helpers\Visual
 */
final class Format
{
    /**
     * @var string
     */
    private static $internalCode = '';

    /**
     * Add Code, Format and Store
     *
     * @param string $code
     */
    public static function addFormat($code = '')
    {
        //@TODO giving MemoryAllocation Error if the HTML is too big. self::add(self::format($code));
        self::add($code);
    }

    /**
     * Add Code and Store
     *
     * @param string $code
     */
    public static function add($code = '')
    {
        self::$internalCode .= $code;
    }

    /**
     * Format Html Code
     *
     * @param string $code
     * @return string
     */
    public static function format($code = '')
    {
        //@TODO giving MemoryAllocation Error if the HTML is too big. return HtmlFormatter::format($code);
        return $code;
    }

    /**
     * Return Internal Code
     *
     * @return string
     */
    public static function get()
    {
        return self::$internalCode;
    }

    /**
     * Return Internal Code Formatted
     *
     * @return string
     */
    public static function getFormat()
    {
        //@TODO giving MemoryAllocation Error if the HTML is too big. return self::format(self::$internalCode);
        return self::$internalCode;
    }
}
