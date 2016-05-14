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

use UIoT\App\Data\Interfaces\Routing\NodeHandlerInterface;

/**
 * Class NodeHandlerModel
 * @package UIoT\App\Data\Models
 */
class NodeHandlerModel implements NodeHandlerInterface
{
    /**
     * @var NodeModel|null
     */
    protected $nodeModel;

    /**
     * @var bool
     */
    protected $result = false;

    /**
     * @var string[]
     */
    protected $pathValue = [];

    /**
     * @var string
     */
    protected $resultContent = '';

    /**
     * NodeHandlerModel constructor.
     *
     * @param NodeModel|null $node
     */
    public function __construct(NodeModel $node = null)
    {
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
        foreach ($arguments as $argument)
            $this->pathValue[] = $argument;

        $this->call();

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
        return $this->resultContent;
    }

    /**
     * Set Result Content
     *
     * @param null|string $resultContent
     * @return mixed|void
     */
    public function setResultContent($resultContent)
    {
        $this->resultContent = $resultContent;
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
     * @return mixed|void
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
        return $this->pathValue;
    }

    /**
     * Get Node Model
     *
     * @return NodeModel|null
     */
    public function getNodeModel()
    {
        return $this->nodeModel;
    }

    /**
     * Set Node Model
     *
     * @param NodeModel|null $nodeModel
     * @return mixed|void
     */
    public function setNodeModel($nodeModel = null)
    {
        $this->nodeModel = $nodeModel;
    }
}
