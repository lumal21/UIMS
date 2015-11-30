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

use Httpful\Http;
use UIoT\App\Core\Communication\Requesting\Raise;
use UIoT\App\Data\Models\CollectorModel;
use UIoT\App\Data\Models\HandlerModel;

/**
 * Class DataCollector
 * @package UIoT\App\Core\Communication\Parsers
 */
class DataCollector
{
	/**
	 * @var array
	 */
	private static $collectors;

	/**
	 * Start the Handler
	 */
	public function __construct()
	{
		$this->startCollectors();
	}

	/**
	 * Register Httpful UIoT Data Collectors
	 * Methods: GET, POST, PUT, DELETE
	 * Default Handlers: Gettable, Postable, Puttable, Deletable
	 */
	private static function registerCollectors()
	{
		self::$collectors = [
			Http::GET => new Collectors\GetCollector(),
			Http::POST => new Collectors\PostCollector(),
			Http::PUT => new Collectors\PutCollector(),
			Http::DELETE => new Collectors\DeleteCollector(),
		];
	}

	/**
	 * Start Indexing all Collectors
	 * Start the Handler, and register everything
	 */
	public static function startCollectors()
	{
		self::registerCollectors();
	}

	/**
	 * Do the REST request
	 *
	 * @return array|mixed|null|object|string
	 */
	public static function doRequest()
	{
		return Raise::doRequest(DataManager::getController() . '/');
	}

	/**
	 * Return Collector and Handler
	 *
	 * @param CollectorModel|null $collector
	 * @param string|HandlerModel $handler
	 * @return CollectorModel
	 */
	public static function initCollector(CollectorModel $collector = null, $handler = '')
	{
		return ($collector === null) || $collector->passRequest(self::doRequest())->passHandler($handler);
	}

	/**
	 * Return all Collectors
	 *
	 * @return mixed
	 */
	public static function getCollectors()
	{
		return self::$collectors;
	}
}
