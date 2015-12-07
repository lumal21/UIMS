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

namespace UIoT\App\Data\Interfaces;

use UIoT\App\Data\Models\NodeModel;

/**
 * Interface NodeHandlerInterface
 * @package UIoT\App\Data\Interfaces
 */
interface NodeHandlerInterface
{
	public function __construct(NodeModel $node);

	public function callValue(...$arguments);

	public function call();

	public function getResult();

	public function setResult($result);

	public function getPathValue();

	public function getNodeModel();

	public function setNodeModel($node_model);

	public function setResultContent($result_content);

	public function getResultContent();
}
