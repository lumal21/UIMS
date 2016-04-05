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
     * @var NodeModel|null
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
     * @param NodeModel|null $node
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
     * @return string
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
     * @param bool $result
     */
    public function setResult($result)
    {
        $this->result = $result;
    }

    /**
     * Get Path Value
     *
     * @return string[]
     */
    public function getPathValue()
    {
        return $this->path_value;
    }

    /**
     * Get Node Model
     *
     * @return NodeModel|null
     */
    public function getNodeModel()
    {
        return $this->node_model;
    }

    /**
     * Set Node Model
     *
     * @param NodeModel|null $node_model
     */
    public function setNodeModel($node_model = null)
    {
        $this->node_model = $node_model;
    }
}
