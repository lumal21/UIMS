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
	private $helper_variables = [];

	/**
	 * Sets a single template variable, by its name:
	 *
	 * @param string $variableName
	 * @param mixed $variableValue
	 */
	public function setVariable($variableName, $variableValue)
	{
		$this->helper_variables[$variableName] = $variableValue;
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
		return isset($this->helper_variables[$variableName]) ? $this->helper_variables[$variableName] : $defaultValue;
	}

	/**
	 * Unset a single template variable, by its name
	 *
	 * @param string $variableName
	 */
	public function delVariable($variableName)
	{
		unset($this->helper_variables[$variableName]);
	}

	/**
	 * Returns all variables for this helper
	 *
	 * @return array
	 */
	public function getHelperVariables()
	{
		return $this->helper_variables;
	}

	/**
	 * Sets the variables to be passed to all templates rendered
	 * by this template helper.
	 *
	 * @param array $helper_variables
	 * @return Helper
	 */
	public function setHelperVariables(array $helper_variables = [])
	{
		$this->helper_variables = $helper_variables;

		return $this;
	}

	/**
	 * Set Helper Variables
	 *
	 * @param array $helper_variables
	 * @return Helper
	 */
	public function setH(array $helper_variables = [])
	{
		return $this->setHelperVariables($helper_variables);
	}
}