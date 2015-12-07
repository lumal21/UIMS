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

namespace UIoT\App\Exception\Template;

use Whoops\Util\TemplateHelper;

/**
 * Class Helper
 * Exception Template Helper
 *
 * @package UIoT\App\Exception\Template
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
	 * Get File Content
	 *
	 * @param string $template
	 * @return mixed|string
	 */
	public function display($template = '')
	{
		/* return templates like css,js, etc */
		return file_get_contents($template);
	}

	/**
	 * Executes the Render
	 *
	 * @param Handler $handler
	 * @return int
	 */
	public function execute(Handler $handler)
	{
		$this->setHelperVariables(array_merge($handler->hResources(), $handler->hSettings(), $handler->hVariables()));

		/* render main layout */
		$this->render($handler->getPublicResource('Layouts/layout.html.php'));

		/* return exit code */
		return Handler::QUIT;
	}

	/**
	 * Given a template path, render it within its own scope. This
	 * method also accepts an array of additional variables to be
	 * passed to the template.
	 *
	 * @param string $template
	 * @param array $additionalVariables
	 */
	public function render($template, array $additionalVariables = null)
	{
		/* set tpl variable */
		$this->setVariable('tpl', $this);

		/* render file */
		$this->getRenderFile($template, $this->getHelperVariables());
	}

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
	 * Get A Rendered File Content
	 *
	 * @param string $template
	 * @param array|null $variables
	 */
	protected function getRenderFile($template = '', array $variables = null)
	{
		/* get variables from array and set in this function */
		extract($variables);

		/* require included file */
		require_once $template;
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
	}
}
