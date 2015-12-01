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

use UIoT\App\Security\Manager as SHandler;
use Whoops\Exception\Formatter;
use Whoops\Handler\PrettyPageHandler;

/*
 * Create A PrettyPageHandler Instance
 * (Little Edited)
 */

/**
 * Class Handler
 * Exception Template Handler
 *
 * @package UIoT\App\Exception\Template
 */
class Handler extends PrettyPageHandler
{
	/**
	 * Template Helper
	 *
	 * @var Helper
	 */
	private $helper;

	/**
	 * Handler constructor.
	 */
	public function __construct()
	{
		$this->setHelper(new Helper);

		parent::__construct();
	}

	/**
	 * This Function Override PrettyPageHandler Handler
	 * Override @parent handle();
	 * This void makes a good Pretty Handling ;)
	 *
	 * @return int
	 */
	public function handle()
	{
		$this->getHelper()->execute($this);
	}

	/**
	 * Get Resource
	 *
	 * @param string $resource
	 * @return string
	 */
	public function getPublicResource($resource = '')
	{
		return parent::getResource($resource);
	}

	/**
	 * Get Helper
	 *
	 * @return Helper
	 */
	public function getHelper()
	{
		return $this->helper;
	}

	/**
	 * Set Helper
	 *
	 * @param Helper $helper
	 */
	public function setHelper(Helper $helper)
	{
		$this->helper = $helper;
	}

	/**
	 * Return Resources for Handler
	 *
	 * @return array
	 */
	public function hResources()
	{
		return ['header' => $this->getResource('Layouts/header.html.php'),
		        'stylesheet' => $this->getResource('Stylesheet/whoops.base.css'),
		        'zepto' => $this->getResource('Scripts/zepto.min.js'),
		        'javascript' => $this->getResource('Scripts/whoops.base.js'),
		        'frame_list' => $this->getResource('Layouts/frame_list.html.php'),
		        'frame_code' => $this->getResource('Layouts/frame_code.html.php'),
		        'env_details' => $this->getResource('Layouts/env_details.html.php')];
	}

	/**
	 * Return Settings
	 *
	 * @return array
	 */
	public function hSettings()
	{
		return ['handlers' => $this->getRun()->getHandlers(),
		        'name' => explode('\\', $this->getInspector()->getExceptionName()),
		        'message' => $this->getInspector()->getException()->getMessage(),
		        'code' => $this->getInspector()->getException()->getCode(),
		        'plain_exception' => Formatter::formatExceptionPlain($this->getInspector())];
	}

	/**
	 * Return Other Variables
	 *
	 * @return array
	 */
	public function hVariables()
	{
		return ['page_title' => $this->getPageTitle(),
		        'title' => $this->getPageTitle(),
		        'nothing' => ((!SHandler::checkDeveloperMode() && SHandler::checkWhiteListIp() && ($frames = $this->getInspector()->getFrames())) || ($frames = [])),
		        'tables' => array_map('UIoT\App\Core\Helpers\Manipulation\Json::isInstanceOfClosure', $this->getDataTables()),
		        'frames' => $frames,
		        'has_frames' => !!count($frames),
		        'handler' => $this];
	}
}
