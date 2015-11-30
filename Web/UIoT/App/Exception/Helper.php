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

namespace UIoT\App\Exception;

use Whoops\Util\TemplateHelper;

/**
 * Class Helper
 * @package UIoT\App\Exception
 */
class Helper extends TemplateHelper
{
	/**
	 * Global Variables
	 *
	 * @var array
	 */
	private $variables = [];

	/**
	 * Sets a single template variable, by its name:
	 *
	 * @param string $variableName
	 * @param mixed $variableValue
	 */
	public function setVariable($variableName, $variableValue)
	{
		$this->variables[$variableName] = $variableValue;
	}

	/**
	 * Gets a single template variable, by its name, or
	 * $defaultValue if the variable does not exist
	 *
	 * @param  string $variableName
	 * @param  mixed $defaultValue
	 * @return mixed
	 */
	public function getVariable($variableName, $defaultValue = '')
	{
		return isset($this->variables[$variableName]) ? $this->variables[$variableName] : $defaultValue;
	}

	/**
	 * Unsets a single template variable, by its name
	 *
	 * @param string $variableName
	 */
	public function delVariable($variableName)
	{
		unset($this->variables[$variableName]);
	}

	/**
	 * Returns all variables for this helper
	 *
	 * @return array
	 */
	public function getVariables()
	{
		return $this->variables;
	}

	/**
	 * Sets the variables to be passed to all templates rendered
	 * by this template helper.
	 *
	 * @param array $variables
	 * @return $this|void
	 */
	public function setVariables(array $variables = [])
	{
		$this->variables = $variables;

		return $this;
	}
}