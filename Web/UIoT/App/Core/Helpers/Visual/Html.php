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

namespace UIoT\App\Core\Helpers\Visual;

use Mihaeu\HtmlFormatter;
use UIoT\App\Core\Helpers\Manipulation\Strings;

/**
 * Class Html
 * @package UIoT\App\Core\Helpers\Visual
 */
final class Html
{
    /**
     * @var string
     */
    private static $internal_formatted_code = '';

    /**
     * Add Code, Format and Store
     *
     * @param string $code
     */
    public static function addf($code = '')
    {
        self::add(self::format($code));
    }

    /**
     * Add Code and Store
     *
     * @param string $code
     */
    public static function add($code = '')
    {
        self::$internal_formatted_code .= $code;
    }

    /**
     * Format Html Code
     *
     * @param string $code
     * @return string
     */
    public static function format($code = '')
    {
        return Strings::removeEmptyLines(HtmlFormatter::format($code));
    }

    /**
     * Return Internal Code
     *
     * @return string
     */
    public static function get()
    {
        return self::$internal_formatted_code;
    }

    /**
     * Return Internal Code Formatted
     *
     * @return string
     */
    public static function getf()
    {
        return self::format(self::$internal_formatted_code);
    }
}
