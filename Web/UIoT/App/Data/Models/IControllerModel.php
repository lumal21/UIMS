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

namespace UIoT\App\Data\Models;

use stdClass;
use UIoT\App\Core\Templates\Render;
use UIoT\App\Data\Interfaces\IControllerInterface;

/**
 * Class IController
 * @package UIoT\App\Data\Models\Types
 */
class IControllerModel extends stdClass implements IControllerInterface
{
	/**
	 * Init Abstract Controller
	 * And set to Template Render that does'nt need to show the View (Because does'nt exists View for Abstract Controllers,
	 * Only Layouts)
	 */
	public function __construct()
	{
		Render::showControllerLayout(false);
	}

	/**
	 * Return the Dynamic Method Call Value
	 * (Call Abstract Controllers Methods)
	 *
	 * @param $key
	 * @param $params
	 * @return mixed
	 */
	public function __call($key, $params)
	{
		return (call_user_func_array($this->{$key}, $params));
	}
}
