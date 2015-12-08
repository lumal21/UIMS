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

use UIoT\App\Data\Interfaces\NodeInterface;

/**
 * Class NodeModel
 * @package UIoT\App\Data\Models
 */
class NodeModel implements NodeInterface
{
	/**
	 * Node Path
	 *
	 * @var string
	 */
	protected $path = null;

	/**
	 * Node Group
	 *
	 * @var string
	 */
	protected $node_group = 'default';

	/**
	 * Node Id
	 *
	 * @var int
	 */
	protected $node_id = null;

	/**
	 * Node Callback
	 *
	 * @var NodeHandlerModel
	 */
	protected $callback = null;

	/**
	 * Item Priority
	 *  Can be:
	 *  1,2,3.....N
	 *
	 * @var int
	 */
	protected $priority = 0;

	/**
	 * Item Router Call Function
	 *  Can be:
	 *  get,post,put,delete,set404,mount,before,options,patch
	 *
	 * @var string
	 */
	protected $method = 'get';

	/**
	 * Node constructor.
	 *
	 * @param int $node_id
	 * @param string $path
	 * @param $callback
	 * @param int $priority
	 * @param string $method
	 * @param string $group
	 */
	public function __construct($node_id, $path, $callback, $priority, $method, $group)
	{
		$this->setNodeId($node_id);

		$this->setPath($path);

		$this->setCallback($callback);

		$this->setPriority($priority);

		$this->setMethod($method);

		$this->setNodeGroup($group);
	}

	/**
	 * Return if is Absolute Path
	 *
	 * @return bool
	 */
	public function isAbsolute()
	{
		return false;
	}

	/**
	 * Get Node Path
	 *
	 * @return string
	 */
	public function getPath()
	{
		return $this->path;
	}

	/**
	 * Set Node Path
	 *
	 * @param string $path
	 */
	public function setPath($path)
	{
		$this->path = $path;
	}

	/**
	 * Get Call Back Function
	 *
	 * @return NodeHandlerModel
	 */
	public function getCallback()
	{
		return $this->callback;
	}

	/**
	 * Set Call Back Function
	 *
	 * @param NodeHandlerModel
	 */
	public function setCallback($callback)
	{
		$this->callback = $callback;
	}

	/**
	 * Get Method
	 *
	 * @return string
	 */
	public function getMethod()
	{
		return $this->method;
	}

	/**
	 * Set Method
	 *
	 * @param string $method
	 */
	public function setMethod($method)
	{
		$this->method = $method;
	}

	/**
	 * Get Priority
	 *
	 * @return int
	 */
	public function getPriority()
	{
		return $this->priority;
	}

	/**
	 * Set Priority
	 *
	 * @param int $priority
	 */
	public function setPriority($priority)
	{
		$this->priority = $priority;
	}

	/**
	 * Get Node Id
	 *
	 * @return int
	 */
	public function getNodeId()
	{
		return $this->node_id;
	}

	/**
	 * Set Node Id
	 *
	 * @param int $node_id
	 */
	public function setNodeId($node_id)
	{
		$this->node_id = $node_id;
	}

	/**
	 * Get Node Group
	 *
	 * @return string
	 */
	public function getNodeGroup()
	{
		return $this->node_group;
	}

	/**
	 * Set Node Group
	 *
	 * @param string $node_group
	 */
	public function setNodeGroup($node_group)
	{
		$this->node_group = $node_group;
	}
}
