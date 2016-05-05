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

namespace UIoT\App\Security\Helpers;

/**
 * Class VariableFilters
 * @package UIoT\App\Security\Helpers
 */
final class VariableFilters
{
    /**
     * Sanitize a Variable
     *
     * @param mixed $inputVariable
     * @return array|mixed|string
     */
    public static function sanitizeVariable($inputVariable = '')
    {
        if (is_array($inputVariable) || is_object($inputVariable)) {
            return array_map(__METHOD__, (array)$inputVariable);
        }
        if (is_string($inputVariable)) {
            return str_replace(['\\', "\0", "\n", "\r", "'", '"', "\x1a"],
                ['\\\\', '\\0', '\\n', '\\r', "\\'", '\\"', '\\Z'], $inputVariable);
        }
        return $inputVariable;
    }
}
