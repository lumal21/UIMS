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

use UIoT\App\Core\Helpers\Manipulation\Arrays;
use UIoT\App\Core\Helpers\Manipulation\Constants;
use UIoT\App\Core\Layouts\Indexer;
use UIoT\App\Data\Models\NodeHandlerModel;
use UIoT\App\Data\Models\NodeModel;
use UIoT\App\Exception\Register;

/**
 * Class ResourceTypeNode
 * @package UIoT\App\Core\Communication\Routing\Nodes
 */
class ResourceTypeNode extends NodeHandlerModel
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

		$this->setResult(Arrays::inArrayAny(Arrays::toResourceName($this->getPathValue()), Constants::returnJsonConstant('RESOURCE_TYPES')));

		!$this->getResult() || $this->setResult(Arrays::inArrayAny(Arrays::toResourceName($this->getPathValue()), ['Bower', 'Npm']));

		!$this->getResult() || Register::getRunner()->errorMessage(906,
			"400!",
			'Details: ',
			[
				'What Happened?' => "Sorry but you cannot access this file! Because is an invalid Url!.",
				'Solution:' => "Go Back to Home Page.",
				'Are you the developer?' => 'You can open this same error Page with Developer Code, only need put ?de on the Url'
			]
		);
	}
}
