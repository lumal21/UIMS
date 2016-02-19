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
 * @developer Igor Moraes
 * @copyright University of Brasília
 */

namespace UIoT\App\Core\Controllers;

use UIoT\App\Core\Helpers\Manipulation\Arrays;
use UIoT\App\Core\Helpers\Manipulation\Strings;
use UIoT\App\Data\Models\ControllerModel;
use UIoT\App\Data\Models\IControllerModel;
use UIoT\App\Exception\Register;

/**
 * Class Commander
 * @package UIoT\App\Core\Controllers
 */
final class Commander
{
	/**
	 * Controller Data
	 *
	 * @var IControllerModel|ControllerModel
	 */
	private $controller_data;

	/**
	 * Controller Actions
	 *
	 * @var array
	 */
	private $controller_actions = [];

	/**
	 * Controller Name
	 *
	 * @var string
	 */
	private $controller_name = '';

	/**
	 * Controller Content
	 *
	 * @var string
	 */
	private static $controller_content = '';

	/**
	 * Abstract Controller Handler
	 *
	 * @var null|Controllable
	 */
	private $abstract_controller_manager = null;

	/**
	 * Start Controller Data
	 *
	 * @param string $controller_name
	 * @param $action_name
	 */
	public function __construct($controller_name, $action_name = 'main')
	{
		/* if is non abstract controller or is an abstract controller */
		if (Indexer::controllerExists($controller_name)):
			$this->controller_data    = Indexer::instantiateController($controller_name);
			$this->controller_actions = Arrays::getStaticControllerActions($controller_name);
			$this->controller_name    = $controller_name;
		else:
			$this->setAbstractControllerManager(new Controllable($controller_name, $action_name));

			$this->controller_data    = $this->getAbstractControllerManager()->getControllerData();
			$this->controller_actions = Arrays::getAbstractControllerActions($this->getAbstractControllerManager()->getControllerActions());
			$this->controller_name    = Strings::toControllerName($controller_name);
		endif;
	}

	/**
	 * Check if Is an Valid Action
	 *
	 * @param $controller_name
	 * @param $action_name
	 * @return bool
	 */
	public static function controllerActionExists($controller_name, $action_name)
	{
		return in_array(Strings::toActionName($action_name), Arrays::getStaticControllerActions($controller_name));
	}

	/**
	 * Get Controller Content
	 *
	 * @return string
	 */
	public static function getControllerContent()
	{
		return self::$controller_content;
	}

	/**
	 * Set Controller Content
	 *
	 * @param string $controller_content
	 */
	public static function setControllerContent($controller_content)
	{
		self::$controller_content = $controller_content;
	}

	/**
	 * Enable Action
	 *
	 * @param string $action_name
	 * @return mixed
	 */
	public function setAction($action_name)
	{
		/* check if action exists, if not we have problem! */
		$this->checkActionExistence($action_name) || self::showNonExistentActionError($this->controller_name, $action_name);

		/* if not call action */
		$this->refineControllerData($this->controller_data->{Strings::toActionMethodName($action_name)}());
	}

	/**
	 * Check if Action Exists
	 *
	 * @param string $action_name
	 * @return bool
	 */
	public function checkActionExistence($action_name)
	{
		return in_array(Strings::toActionName($action_name), $this->controller_actions);
	}

	/**
	 * Refine Controller Code
	 *
	 * @param mixed|string $returned_code
	 */
	public function refineControllerData($returned_code = '')
	{
		self::setControllerContent($returned_code);
	}

	/**
	 * Show Non Existent Action Error
	 *
	 * @param string $controller_name
	 * @param string $action_name
	 */
	public static function showNonExistentActionError($controller_name, $action_name)
	{
		Register::getRunner()->errorMessage(902,
			"Stop! That Action Doesn't Exists!",
			'Details: ',
			[
				'What Happened?' => "You're trying to call an nonexistent Action",
				'What Action?' => "Action with name: $action_name",
				'From the Controller:' => $controller_name,
				'Resolution:' => "Stop trying to call nonexistent actions.",
				'What Actions can i Call?' => "You can Call UIoT's Abstract Actions (Handlers), and the Built-In Controllers Actions",
				'Are you the developer?' => 'You can open this same error Page with Developer Code, only need put ?de on the Url'
			]
		);
	}

	/**
	 * Get Controllable
	 *
	 * @return Controllable
	 */
	public function getAbstractControllerManager()
	{
		return $this->abstract_controller_manager;
	}

	/**
	 * Set Controllable
	 *
	 * @param Controllable $abstract_controller_manager
	 */
	public function setAbstractControllerManager(Controllable $abstract_controller_manager)
	{
		$this->abstract_controller_manager = $abstract_controller_manager;
	}
}
