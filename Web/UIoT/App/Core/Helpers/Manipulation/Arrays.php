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

namespace UIoT\App\Core\Helpers\Manipulation;

use UIoT\App\Core\Controllers\Indexer;
use UIoT\App\Data\Models\MethodModel;
use UIoT\App\Data\Models\NodeModel;
use UIoT\App\Security\Helpers\VariableFilters;

/**
 * Class Arrays
 * @package UIoT\App\Core\Helpers\Manipulation
 */
class Arrays
{
	/**
	 * Convert String to ActionName
	 * (Used on Array_Map)
	 *
	 * @param $x
	 * @return string
	 */
	public static function toActionName($x)
	{
		return Strings::toActionName(stripos($x, '__action') !== false ? (str_ireplace('__action', '', $x)) : $x);
	}

	/**
	 * Add Value in Array
	 *
	 * @param $key
	 * @param string $value
	 * @param array $array
	 */
	public static function addOnArray($key, $value, &$array = [])
	{
		$array[$key] = $value;
	}

	/**
	 * Add value in Method
	 *
	 * @param $key
	 * @param $value
	 * @param MethodModel $class
	 * @param array $array
	 * @return bool
	 */
	public static function addOnHttpMethod($key, $value, MethodModel $class, &$array = [])
	{
		$array[$key] = $class->setData($value);
	}

	/**
	 * Check if is Instance of Closure
	 * (Used on ArrayMap)
	 *
	 * @param string $a
	 * @return mixed
	 */
	public static function isInstanceOfClosure($a)
	{
		return self::checkIsInstanceOf($a, 'Closure');
	}

	/**
	 * Check if is InstanceOf
	 * (Used on ArrayMap)
	 *
	 * @param $a
	 * @param string $b
	 * @return mixed
	 */
	public static function checkIsInstanceOf($a, $b)
	{
		return $a instanceof $b ? $a() : $a;
	}

	/**
	 * Convert to Controller Name
	 * (Used on ArrayMap)
	 *
	 * @param $x
	 * @return string
	 */
	public static function toControllerName($x)
	{
		return Strings::toControllerName($x);
	}

	/**
	 * Convert to Controller Name an entire Array
	 *
	 * @param array $a
	 * @return array
	 */
	public static function toControllerArray($a = [])
	{
		return array_map('self::toControllerName', (array)$a);
	}

	/**
	 * Get Entire Methods (Actions) of User Defined Controller
	 * (Only for Public - non-static - methods)
	 *
	 * @param string $controller_name
	 * @return array
	 */
	public static function staticToArray($controller_name = '')
	{
		return array_map('self::toActionName', get_class_methods(Indexer::getControllerNameSpace($controller_name)));
	}

	/**
	 * Return to Resource Valid File Name
	 *
	 * @param array $array
	 * @return array
	 */
	public static function toResourceName(array $array)
	{
		return array_map('self::toActionName', $array);
	}

	/**
	 * Remove Blank Items from Array
	 *
	 * @param array $array
	 * @return array
	 */
	public static function removeBlank($array = [])
	{
		return is_array($array) ? array_values(array_diff($array, [''])) : [];
	}

	/**
	 * Get Entire Methods (Actions) of UIoT Abstract Controller
	 * (Only for Public - non-static - methods)
	 *
	 * @param array $a
	 * @return array
	 */
	public static function abstractToArray($a = [])
	{
		return is_array($a) ? (array_map('self::toActionName', array_keys((array)$a))) : [];
	}

	/**
	 * Sanitize the Array
	 *
	 * @param array $input_array
	 * @return array|mixed|string
	 */
	public static function sanitizeArray(array $input_array = [])
	{
		return VariableFilters::sanitizeVariable((array)$input_array);
	}

	/**
	 * Return Search by Parameter
	 *
	 * @param array $array
	 * @param string $parameter_name
	 * @param mixed $parameter_value
	 * @param string $expression
	 * @param bool $by_callback
	 * @return array
	 */
	public static function getArrayByLogicComparsion(array $array, $parameter_name = '', $parameter_value, $expression = '==', $by_callback = false)
	{
		return array_filter($array, function ($var) use ($parameter_name, $parameter_value, $expression, $by_callback) {

			/** @var NodeModel $var */
			$variable = !empty($parameter_name) ? ($by_callback ? $var->getCallback()->{'get' . $parameter_name}() : $var->{'get' . $parameter_name}()) : get_class($var->getCallback());

			switch ($expression):
				default:
					return $variable == $parameter_value;
				case '!=':
					return $variable != $parameter_value;
				case '>=':
					return $variable >= $parameter_value;
				case '>':
					return $variable > $parameter_value;
				case '<=':
					return $variable <= $parameter_value;
				case '<':
					return $variable < $parameter_value;
				case '===':
					return $variable === $parameter_value;
			endswitch;
		});
	}

	/**
	 * Remove each instance of an object within an array (matched on a given property, $prop)
	 *
	 * @param array $array
	 * @param mixed $value
	 * @param string $prop
	 * @return array
	 */
	public static function removeObjectFromArray(&$array, $value, $prop)
	{
		return array_filter($array, function ($a) use ($value, $prop) {
			return $a->$prop !== $value;
		});
	}

	/**
	 * Return Object by Search for Property
	 *
	 * @param $array
	 * @param $index
	 * @param $value
	 * @return null|NodeModel
	 */
	public static function objArraySearch($array, $index, $value)
	{
		foreach ($array as $arrayInf)
			if ($arrayInf->{'get' . $index}() == $value)
				return $arrayInf;

		return null;
	}

	/**
	 * Return Object by Search for Property
	 *
	 * @param $array
	 * @param $index
	 * @param $value
	 * @return null|NodeModel
	 */
	public static function objArraySearchBool($array, $index, $value)
	{
		foreach ($array as $arrayInf)
			if ($arrayInf->{'get' . $index}() == $value)
				return true;

		return false;
	}

	/**
	 * Get Array Object Parameter Value
	 *
	 * @param $getNodes
	 * @param $parameter_name
	 * @return array
	 */
	public static function getArrayObjectProperty($getNodes, $parameter_name)
	{
		return array_map(function ($node) use ($parameter_name) {
			return $node->{'get' . $parameter_name}();
		}, $getNodes);
	}

	/**
	 * Check if Any Occurrence Exists
	 *
	 * @param array $needles
	 * @param array $haystack
	 * @return bool
	 */
	public static function inArrayAny($needles, $haystack)
	{
		return !!array_intersect($needles, $haystack);
	}
}
