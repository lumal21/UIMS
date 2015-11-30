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

namespace UIoT\App\Core\Helpers\Manipulators;

/**
 * Class Security
 * @package UIoT\App\Core\Helpers\Manipulators
 */
final class Security
{
	/**
	 * Sanitize a Variable
	 *
	 * @param mixed $input_variable
	 * @return array|mixed|string
	 */
	public static function sanitizeVariable($input_variable)
	{
		if (is_array($input_variable))
			return array_map(__METHOD__, $input_variable);
		if (is_object($input_variable))
			return array_map(__METHOD__, (array)$input_variable);
		if (!empty($input_variable) && is_string($input_variable))
			return str_replace(['\\', "\0", "\n", "\r", "'", '"', "\x1a"], ['\\\\', '\\0', '\\n', '\\r', "\\'", '\\"', '\\Z'], $input_variable);
		return $input_variable;
	}
}
