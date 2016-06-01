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

use Httpful\Http;
use InvalidArgumentException;
use UIoT\App\Helpers\Manipulation\Strings;

/**
 * Class DataHandler - Manages the Handling of the Specific Data of Each Type
 * @package UIoT\App\Core\Communication\Parsers
 */
class DataHandler
{
    /**
     * @var array Method Handlers aka Layouts
     */
    private static $methodHandlers = [
        'Main' => Http::GET,
        'Add' => Http::POST,
        'Edit' => Http::PUT,
        'Delete' => Http::DELETE,
    ];

    /**
     * Get Method Handler
     *
     * @param string $methodHandler
     * @return mixed
     */
    public static function getName($methodHandler)
    {
        if (!array_key_exists(Strings::toCamel($methodHandler), self::getMethods())) {
            throw new InvalidArgumentException('Invalid Raise Method', '404');
        }

        return self::getMethods()[Strings::toCamel($methodHandler)];
    }

    /**
     * Get Method Layouts
     *
     * @return array
     */
    public static function getMethods()
    {
        return self::$methodHandlers;
    }
}
