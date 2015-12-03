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

namespace UIoT\App\Core\Communication\Routing\Nodes;

use UIoT\App\Core\Communication\Routing\RenderSelector;
use UIoT\App\Core\Controllers\Indexer;
use UIoT\App\Core\Helpers\Manipulation\Arrays;
use UIoT\App\Core\Helpers\Manipulation\Constants;
use UIoT\App\Core\Helpers\Manipulation\Strings;
use UIoT\App\Core\Resources\Render;
use UIoT\App\Data\Models\NodeHandlerModel;
use UIoT\App\Data\Models\NodeModel;

/**
 * Class ResourceFIleNode
 * @package UIoT\App\Core\Communication\Routing\Nodes
 */
class ResourceFileNode extends NodeHandlerModel
{
	/**
	 * ControllerNode constructor.
	 *
	 * @param NodeModel $node
	 */
	public function __construct(NodeModel $node = null)
	{
		parent::__construct($node);
	}

	/**
	 * Callback Function
	 */
	public function call()
	{
		$this->setResult(Indexer::controllerExists(Strings::toControllerName($this->getPathValue()[0])));

		$this->setResult(Arrays::inArrayAny(Arrays::toResourceName($this->getPathValue()), Constants::returnJsonConstant('RESOURCE_TYPES')));

		$file_name = [];

		foreach ($this->getPathValue() as $key => $value)
			$key == 0 || $file_name[] = Strings::toControllerName($value);

		echo RenderSelector::select(RenderSelector::instantiate(new Render(['controller' => Strings::toControllerName($this->getPathValue()[0]), 'file' => implode('/', $file_name)])));
	}
}