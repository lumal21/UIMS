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

use UIoT\App\Data\Interfaces\LayoutInterface;

/**
 * Class Layout
 * @package UIoT\App\Data\Models\Types
 */
class LayoutModel implements LayoutInterface
{
	/**
	 * Start Layout
	 */
	public function __construct()
	{
		$this->__resources();
		$this->__configuration();
		$this->__templates();
	}

	/**
	 * Define Resources
	 */
	public static function __resources()
	{
		/* not implemented */
	}

	/**
	 * Define Settings
	 */
	public function __configuration()
	{
		/* not implemented */
	}

	/**
	 * Define Templates
	 */
	public function __templates()
	{
		/* not implemented */
	}

	/**
	 * Return Layout Code
	 */
	public function __show()
	{
		/* not implemented */
	}
}
