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

namespace UIoT\App\Core\Controllers;

use RuntimeException;
use UIoT\App\Core\Communication\Parsers\DataManager;
use UIoT\App\Core\Helpers\Manipulators\Strings;
use UIoT\App\Data\Models\IControllerModel;

/**
 * Class IControllable
 * @package UIoT\App\Core\Controllers
 */
class IControllable
{
	/**
	 * @var string
	 */
	public $c_name = '';
	/**
	 * @var string
	 */
	public $a_name = '';
	/**
	 * @var array
	 */
	public $c_s_array = [];
	/**
	 * @var array
	 */
	public $c_array = [];
	/**
	 * @var IControllerModel
	 */
	public $c_data;

	/**
	 * Enable the Instance
	 *
	 * @param array $array
	 */
	protected function enableController($array = [])
	{
		/* if is not array we have problem */
		is_array($array) || new RuntimeException('Fail! The IController Array is empty!');

		/* store array */
		$this->c_s_array = $array;

		/* call methods */
		$this->addInstance();
		$this->addMethods();
	}

	/**
	 * Create Controller Instance
	 */
	private function addInstance()
	{
		$this->c_data = (new IControllerModel);
	}

	/**
	 * Add Controller Abstract Methods
	 */
	private function addMethods()
	{
		foreach ($this->c_s_array as $method => $request)
			$this->c_data->{Strings::toActionMethodName($method)} = function () use ($method) {
				return DataManager::getInstance($method);
			};
	}
}
