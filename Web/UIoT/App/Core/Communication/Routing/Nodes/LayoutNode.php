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
use UIoT\App\Core\Helpers\Manipulation\Constants;
use UIoT\App\Core\Helpers\Manipulation\Strings;
use UIoT\App\Core\Layouts\Indexer;
use UIoT\App\Core\Templates\Render;
use UIoT\App\Data\Models\NodeHandlerModel;
use UIoT\App\Data\Models\NodeModel;

/**
 * Class LayoutNode
 * @package UIoT\App\Core\Communication\Routing\Nodes
 */
class LayoutNode extends NodeHandlerModel
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
		$this->setResult(Indexer::layoutExists($this->getPathValue()[0]));

		$this->setResultContent(RenderSelector::select(RenderSelector::instantiate(new Render(['controller' => Strings::toControllerName($this->getPathValue()[0]), 'action' => Constants::returnConstant('DEFAULT_CONTROLLER_ACTION')]))));
	}
}
