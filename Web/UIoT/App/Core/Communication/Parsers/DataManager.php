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

namespace UIoT\App\Core\Communication\Parsers;

use Httpful\Mime;
use UIoT\App\Core\Communication\Requesting\Brain;
use UIoT\App\Core\Helpers\Manipulation\Strings;

/**
 * Class DataManager
 * Manage the Data from Requests
 *
 * @package UIoT\App\Core\Communication\Parsers
 */
final class DataManager
{
	/**
	 * Controller Name
	 *
	 * @var string
	 */
	private static $controller;
	/**
	 * Action Name
	 *
	 * @var string
	 */
	private static $action;

	/**
	 * Create the DataManager Instance
	 */
	public function __construct()
	{
		/* start collectors and handlers */
		new DataCollector;
		new DataHandler;

		/* store final handler */
		DataHandler::storeHandler();
	}

	/**
	 * Prepare Brain Template
	 */
	public static function prepareTemplate()
	{
		Brain::setTemplate(DataHandler::getParserMethod(self::getAction()), Mime::JSON);
	}

	/**
	 * Return DataHandler and DataCollector Instance
	 *
	 * @param $method
	 * @return \UIoT\App\Data\Models\CollectorModel
	 */
	public static function getInstance($method)
	{
		return DataCollector::initCollector(DataHandler::getParserCollector($method), DataHandler::getParserHandler($method));
	}

	/**
	 * This must only be called for REST Purposes!
	 * Because the controller NAME will be lowercase, and the Engine need in Ucfirst!
	 * Only for REST need be lowercase.
	 *
	 * @return string
	 */
	public static function getController()
	{
		return Strings::toRestUrlName(self::$controller);
	}

	/**
	 * Set controller name only for REST purposes
	 *
	 * @param mixed $controller
	 * @return string
	 */
	public static function setController($controller = '')
	{
		return self::$controller = Strings::toControllerName($controller);
	}

	/**
	 * @return string
	 */
	public static function getAction()
	{
		return Strings::toRestUrlName(self::$action);
	}

	/**
	 * @param string $action
	 * @return string
	 */
	public static function setAction($action)
	{
		return self::$action = Strings::toActionName($action);
	}
}
