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

namespace UIoT\App\Core\Templates;

use UIoT\App\Core\Communication\Parsers\DataHandler;
use UIoT\App\Core\Controllers\Commander;
use UIoT\App\Core\Controllers\Indexer as ControllerIndexer;
use UIoT\App\Core\Helpers\Manipulation\Constants;
use UIoT\App\Core\Helpers\Manipulation\Strings;
use UIoT\App\Core\Resources\Indexer as ResourceIndexer;
use UIoT\App\Core\Views\Indexer as ViewIndexer;

/**
 * Class Render
 * @package UIoT\App\Core\Templates
 */
final class Render
{
	/**
	 * Disable Render the View's and View's Layout
	 *
	 * @var bool
	 */
	private static $show_view = true;

	/**
	 * Enable to show Default Action
	 *
	 * @var bool
	 */
	private static $enable_default_action = false;

	/**
	 * Controller Name
	 *
	 * @var string
	 */
	private $controller_name;

	/**
	 * Action Name
	 *
	 * @var string
	 */
	private $controller_action_name;

	/**
	 * Init Template (Layout/Controller/View) Handler
	 *
	 * @param array $arguments
	 */
	public function __construct($arguments = [])
	{
		$this->setArguments($arguments);
		$this->setResources();
		$this->setController();
	}

	/**
	 * Set Arguments
	 *
	 * @param array $arguments
	 */
	private function setArguments($arguments = [])
	{
		$this->controller_name        = Strings::toControllerName($arguments['controller']);
		$this->controller_action_name = Strings::toActionName($arguments['action']);
	}

	/**
	 * Start the Controller Commander
	 */
	private function setController()
	{
		/* Start Controller Commander, and set Action to Execute */
		(new Commander($this->controller_name, $this->controller_action_name))->setAction($this->controller_action_name);
	}

	/**
	 * Check if Need to Enable Default Controller Action
	 *
	 * @param bool $boolean
	 * @return bool
	 */
	public static function enableControllerDefaultAction($boolean = null)
	{
		/* check if need change boolean value */
		!(self::$enable_default_action === $boolean && is_bool($boolean)) || self::$enable_default_action = $boolean;

		return self::$enable_default_action;
	}

	/**
	 * Check if need to Show Controller View
	 *
	 * @param bool $boolean
	 * @return bool
	 */
	public static function showControllerView($boolean = null)
	{
		/* check if need change boolean value */
		!(self::$show_view === $boolean && is_bool($boolean)) || self::$show_view = $boolean;

		return self::$show_view;
	}

	/**
	 * Return Controller Content if the Controller Exists,
	 * If not Return the Abstract Controller Handler (DataHandler) Content
	 * Also DataHandler view Enable the Abstract Controller Layout
	 *
	 * @return mixed
	 */
	private function returnControllerContent()
	{
		return ControllerIndexer::controllerExists($this->controller_name) ? Commander::getControllerContent() : DataHandler::openParserLayout($this->controller_action_name);
	}

	/**
	 * Return Controller View Content if View Exists,
	 * If not, return Controller Content
	 *
	 * @return mixed
	 */
	private function returnControllerView()
	{
		return ViewIndexer::viewExists($this->controller_name) ? ViewIndexer::showView($this->controller_name) : $this->returnControllerContent();
	}

	/**
	 * Show Template Content
	 * If is to show the View, echoes the View Content with Controller Content, if not Only echoes Controller Content
	 */
	public function show()
	{
		return self::showControllerView() ? $this->returnControllerView() : $this->returnControllerContent();
	}

	/**
	 * Register Controller's Layout Resources
	 */
	private function setResources()
	{
		ResourceIndexer::registerResources(in_array($this->controller_name, Constants::returnJsonConstant('PREDEFINED_LAYOUTS')) ? $this->controller_name : $this->controller_action_name, true);
	}
}
