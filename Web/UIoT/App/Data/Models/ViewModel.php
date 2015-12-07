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

use ReflectionClass;
use UIoT\App\Core\Layouts\Indexer as LIndexer;
use UIoT\App\Data\Interfaces\ViewInterface;

/**
 * Class View
 * @property string view
 * @property string vname
 * @package UIoT\App\Data\Models\Types
 */
class ViewModel implements ViewInterface
{
	/**
	 * Start View
	 */
	public function __construct()
	{
		$this->__name();
		$this->__layout();
	}

	/**
	 * Set Abstract Name
	 */
	public function __name()
	{
		$this->vname = (new ReflectionClass(self::class))->getShortName();
	}

	/**
	 * Set Layout
	 */
	public function __layout()
	{
		LIndexer::addLayout($this->vname, $this->vname);
	}

	/**
	 * Show Layout
	 */
	public function __show()
	{
		return LIndexer::getLayout($this->vname);
	}
}
