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

namespace UIoT\App\Data\Models;

use UIoT\App\Data\Interfaces\ControllerInterface;

/**
 * Class ControllerModel
 * @package UIoT\App\Data\Models
 */
class ControllerModel implements ControllerInterface
{
	/**
	 * Init Controller
     *
	 * ControllerModel constructor.
	 */
	public function __construct()
	{
		/* nothing to do */
	}

	/**
	 * Default Action
	 */
	public function __actionMain()
	{
		/* nothing to do */
	}
}
