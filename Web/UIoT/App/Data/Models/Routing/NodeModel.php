<?php

/**
 * UIoTuims
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
 * @app UIoT User-Friendly Management System
 * @author UIoT
 * @developer Claudio Santoro
 * @developer Igor Moraes
 * @copyright University of Brasília
 */

namespace UIoT\App\Data\Models\Routing;

use UIoT\App\Data\Interfaces\Routing\NodeInterface;

/**
 * Class NodeModel
 * @package UIoT\App\Data\Models
 */
class NodeModel implements NodeInterface
{
    /**
     * @var string
     */
    protected $path = null;

    /**
     * @var string
     */
    protected $nodeGroup = 'default';

    /**
     * @var int
     */
    protected $nodeId = null;

    /**
     * @var NodeHandlerModel
     */
    protected $callBack = null;

    /**
     * @var int
     */
    protected $priority = 0;

    /**
     * @var string
     */
    protected $method = 'get';

    /**
     * Node constructor.
     *
     * @param int $nodeId
     * @param string $path
     * @param $callBack
     * @param int $priority
     * @param string $method
     * @param string $group
     */
    public function __construct($nodeId, $path, $callBack, $priority, $method, $group)
    {
        $this->setNodeId($nodeId);

        $this->setPath($path);

        $this->setCallBack($callBack);

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
     * @return mixed|void
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
    public function getCallBack()
    {
        return $this->callBack;
    }

    /**
     * Set Call Back Function
     *
     * @param NodeHandlerModel
     * @return mixed|void
     */
    public function setCallBack($callBack)
    {
        $this->callBack = $callBack;
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
     * @return mixed|void
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
     * @return mixed|void
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
        return $this->nodeId;
    }

    /**
     * Set Node Id
     *
     * @param int $nodeId
     */
    public function setNodeId($nodeId)
    {
        $this->nodeId = $nodeId;
    }

    /**
     * Get Node Group
     *
     * @return string
     */
    public function getNodeGroup()
    {
        return $this->nodeGroup;
    }

    /**
     * Set Node Group
     *
     * @param string $nodeGroup
     * @return mixed|void
     */
    public function setNodeGroup($nodeGroup)
    {
        $this->nodeGroup = $nodeGroup;
    }
}
