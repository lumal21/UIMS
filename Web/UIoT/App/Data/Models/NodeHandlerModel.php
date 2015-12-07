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

use UIoT\App\Data\Interfaces\NodeHandlerInterface;

/**
 * Class NodeHandlerModel
 * @package UIoT\App\Data\Models
 */
class NodeHandlerModel implements NodeHandlerInterface
{
	/**
	 * Node Model
	 *
	 * @var NodeModel
	 */
	protected $node_model;

	/**
	 * Result of Callback
	 *
	 * @var bool
	 */
	protected $result = false;

	/**
	 * Path Value
	 *
	 * @var string[]
	 */
	protected $path_value = [];

	/**
	 * CallBack Content Result
	 *
	 * @var string
	 */
	protected $result_content = '';

	/**
	 * NodeHandlerModel constructor.
	 *
	 * @param NodeModel $node
	 */
	public function __construct(NodeModel $node = null)
	{
		/* optional set node model */
		$this->setNodeModel($node);
	}

	/**
	 * CallBack Function
	 *
	 * @param string[] $arguments
	 * @return null|string
	 */
	public function callValue(...$arguments)
	{
		/* foreach arguments */
		foreach ($arguments as $argument)
			$this->path_value[] = $argument;

		/* call callback function */
		$this->call();

		/* return rendered content */
		echo $this->getResultContent();
	}

	/**
	 * CallBack Function
	 */
	public function call()
	{

	}

	/**
	 * Get Result Content
	 *
	 * @return null|string
	 */
	public function getResultContent()
	{
		return $this->result_content;
	}

	/**
	 * Set Result Content
	 *
	 * @param null|string $result_content
	 */
	public function setResultContent($result_content)
	{
		$this->result_content = $result_content;
	}

	/**
	 * Get Result
	 *
	 * @return bool
	 */
	public function getResult()
	{
		return $this->result;
	}

	/**
	 * Set Result
	 *
	 * @param bool
	 */
	public function setResult($result)
	{
		$this->result = $result;
	}

	/**
	 * Get Path Value
	 *
	 * @return mixed
	 */
	public function getPathValue()
	{
		return $this->path_value;
	}

	/**
	 * Get Node Model
	 *
	 * @return NodeModel
	 */
	public function getNodeModel()
	{
		return $this->node_model;
	}

	/**
	 * Set Node Model
	 *
	 * @param NodeModel $node_model
	 */
	public function setNodeModel($node_model)
	{
		$this->node_model = $node_model;
	}
}
