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

namespace UIoT\App\Exception;

use UIoT\App\Core\Helpers\Manipulation\Constants;
use UIoT\App\Core\Helpers\System\Settings;
use UIoT\App\Exception\Template\Handler;

/**
 * Class Manager
 * Exception Manager
 *
 * @package UIoT\App\Exception
 */
final class Manager
{
	/**
	 * Create Instance of Everything
	 *
	 * Manager constructor.
	 */
	public function __construct()
	{
		$this->setClasses();
		$this->setSettings();
		$this->registerHandler();
	}

	/**
	 * Set Classes
	 */
	private function setClasses()
	{
		Register::setHandler(new Handler);
		Register::setRunner(new Collector);
	}

	/**
	 * Set Page Handler Settings
	 */
	private function setSettings()
	{
		Register::setErrorLevels(Settings::getSetting('exceptions')->error_reporting_levels);
		Register::addResourcePath(Constants::returnConstant('RESOURCE_FOLDER') . Settings::getSetting('exceptions')->error_resource_folder . '/');
		Register::setPageTitle(Settings::getSetting('exceptions')->error_page_title);
	}

	/**
	 * Register Page Handler
	 */
	private function registerHandler()
	{
		Register::pushHandler();
		Register::registerHandler();
	}
}
