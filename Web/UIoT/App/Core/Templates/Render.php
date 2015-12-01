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
use UIoT\App\Core\Helpers\Data\Urls;
use UIoT\App\Core\Helpers\Manipulation\Constants;
use UIoT\App\Core\Resources\Indexer as ResourceIndexer;
use UIoT\App\Core\Views\Indexer as ViewIndexer;

/**
 * Class Render
 * @package UIoT\App\Core\Templates
 */
final class Render
{
	/**
	 * @var bool
	 */
	public static $disable_show_view = false;
	/**
	 * @var bool
	 */
	public static $enable_default_action = false;
	/**
	 * @var string
	 */
	private $controller;
	/**
	 * @var string
	 */
	private $action;

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
		$this->controller = $arguments['controller'];
		$this->action     = $arguments['action'];
	}

	/**
	 * Start the Controller Commander
	 */
	private function setController()
	{
		(new Commander($this->controller, $this->action))->setAction($this->action);
	}

	/**
	 * Enable Basic View/Layout (Only controller output Code)
	 *
	 * @return mixed|string|null
	 */
	private function bView()
	{
		return Constants::returnConstant('CONTROLLER_CONTENT');
	}

	/**
	 * Start Abstract Layout (For Abstract Core)
	 */
	private function aView()
	{
		return DataHandler::openParserLayout($this->action);
	}

	/**
	 * Call View/Layout
	 */
	public function show()
	{
		return !self::$disable_show_view ? (ViewIndexer::viewExists($this->controller) ? ViewIndexer::getView($this->controller) : '') : (!ControllerIndexer::controllerExists($this->controller) ? $this->aView() : $this->bView());
	}

	/**
	 * Register Resources
	 */
	private function setResources()
	{
		ResourceIndexer::registerResources(in_array($this->action, Urls::getLayouts()) ? $this->action : $this->controller, true);
	}
}
