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

namespace UIoT\App\Core\Communication\Routing\Nodes;

use UIoT\App\Data\Models\Routing\NodeHandlerModel;
use UIoT\App\Data\Models\Routing\NodeModel;

/**
 * Class NodeIndexer
 * @package UIoT\App\Core\Communication\Routing\Path
 */
final class NodeIndexer
{
    /**
     * @var NodeModel[]
     */
    public $nodes = [];

    /**
     * Add a Node and return int Node Id
     *
     * @param array $nodeItemArray
     * @return integer|null
     */
    public function addNode(array $nodeItemArray)
    {
        $this->nodes[$this->getNodeSize() + 1] = new NodeModel($this->getNodeSize() + 1, $nodeItemArray['path'],
            $nodeItemArray['callback'], $nodeItemArray['priority'],
            $nodeItemArray['method'], $nodeItemArray['group']);
    }

    /**
     * Return Node Array Size - The count of NodeModel in $node
     *
     * @return integer|double
     */
    private function getNodeSize()
    {
        return sizeof($this->getNodes()) - 1;
    }

    /**
     * Return All Nodes
     *
     * @return NodeModel[]
     */
    public function getNodes()
    {
        return $this->nodes;
    }

    /**
     * Override Nodes
     *
     * @param NodeModel[] $nodes
     */
    public function setNodes($nodes)
    {
        $this->nodes = $nodes;
    }

    /**
     * Sort Nodes
     *
     * @param NodeModel $nodeA
     * @param NodeModel $nodeB
     * @return int
     */
    public function sortNodes(NodeModel $nodeA, NodeModel $nodeB)
    {
        return $nodeA->getPriority() != $nodeB->getPriority() ?
            (($nodeA->getPriority() < $nodeB->getPriority()) ? -1 : 1) : 0;
    }

    /**
     * Update NodeModel Node Ids
     *
     * @param int $nodeId
     * @param NodeModel $node
     * @return NodeModel
     */
    public function updateNodeIds($nodeId, NodeModel $node)
    {
        $node->setNodeId($nodeId);

        return $node;
    }

    /**
     * Sort all Nodes And Update they Node Ids
     */
    public function sort()
    {
        /* first sort the array by priority */
        usort($this->nodes, [$this, 'sortNodes']);

        /* update nodes ids also in the Node object and update the Node array */
        $this->setNodes(array_map([$this, 'updateNodeIds'], array_keys($this->nodes), $this->nodes));
    }

    /**
     * Return a Node by Path
     *
     * @param $path
     * @return NodeModel|null
     */
    public function getNodeByPath($path)
    {
        return NodeManipulation::nodeArrayPropertySearch($this->getNodes(), 'Path', $path);
    }

    /**
     * Return Node by Id
     *
     * @param int $nodeId
     * @return NodeModel|null
     */
    public function getNodeById($nodeId)
    {
        return NodeManipulation::nodeArrayPropertySearch($this->getNodes(), 'NodeId', $nodeId);
    }

    /**
     * Return all Nodes from a Specific Priority
     *
     * @param integer|NodeModel $priorityId
     * @return NodeModel[]
     */
    public function getNodesByPriorityId($priorityId)
    {
        return $this->getNodesByParameter('Priority', $priorityId, '==');
    }

    /**
     * Return Search by Parameter
     *
     * @param string $parameterName
     * @param mixed $parameterValue
     * @param string $expression
     * @return NodeModel[]
     */
    private function getNodesByParameter($parameterName, $parameterValue, $expression = '==')
    {
        return NodeManipulation::getArrayByLogicComparison($this->getNodes(),
            $parameterName, $parameterValue, $expression);
    }

    /**
     * Return All Nodes that Matched
     *
     * @return NodeModel[]
     */
    public function getNodesThatMatched()
    {
        return $this->getNodesByCallBackParameter('Status', true, '==');
    }

    /**
     * Return Search by Parameter
     *
     * @param string $parameterName
     * @param mixed $parameterValue
     * @param string $expression
     * @return NodeModel[]
     */
    private function getNodesByCallBackParameter($parameterName, $parameterValue, $expression = '==')
    {
        return NodeManipulation::getArrayByLogicComparison($this->getNodesCallBack(),
            $parameterName, $parameterValue, $expression);
    }

    /**
     * Get Nodes Callback Array
     *
     * @return NodeModel[]
     */
    public function getNodesCallBack()
    {
        return array_map(function(NodeModel $node) {
            return $node->getCallBack();
        }, $this->getNodes());
    }

    /**
     * Return All Nodes that was tested with Path
     *
     * @return NodeModel[]
     */
    public function getNodesWithPathValue()
    {
        return $this->getNodesByCallBackParameter('Path', [], '!=');
    }

    /**
     * Return Lowest Priority Id
     *
     * @return NodeModel|integer
     */
    public function getLowestNodePriorityId()
    {
        return min((!empty($o = $this->getNodesParameterByParameter('Priority')) ? $o : [1]));
    }

    /**
     * Return Search by Parameter
     *
     * @param string $parameterName
     * @return NodeModel[]
     */
    private function getNodesParameterByParameter($parameterName)
    {
        return NodeManipulation::getArrayObjectProperty($this->getNodes(), $parameterName);
    }

    /**
     * Check if Node Exists
     *
     * @param int $nodeId
     * @return bool
     */
    public function nodeExistsById($nodeId)
    {
        return (bool)NodeManipulation::nodeArrayPropertySearch($this->getNodes(), 'NodeId', $nodeId);
    }

    /**
     * Remove Nodes from NodeIndexer
     *
     * @param NodeModel $edge
     */
    public function removeNodesFromArray(NodeModel $edge)
    {
        $this->setNodes($this->getNodesByCallBack($this->getNodes(), $edge->getCallBack()));
    }

    /**
     * Remove each instance of an object within an array (matched on a given property, $prop)
     *
     * @param NodeModel[] $array
     * @param NodeHandlerModel $value
     * @return array
     */
    public function getNodesByCallBack(array $array, $value)
    {
        return array_filter($array, function(NodeModel $a) use ($value) {
            return get_class($a->getCallBack()) != get_class($value);
        });
    }

    /**
     * Perform NodeIndexer Changes List
     *
     * @param NodeHandlerModel $node
     */
    public function performCoreUpdate(NodeHandlerModel $node)
    {
        array_map([$this, 'removeNodesFromArray'], $this->getNodesByGroup($node->getNodeModel()->getNodeGroup()));
    }

    /**
     * Return all Nodes from a Specific Group
     *
     * @param string $nodeGroup
     * @return NodeModel[]
     */
    public function getNodesByGroup($nodeGroup)
    {
        return $this->getNodesByParameter('NodeGroup', $nodeGroup, '==');
    }
}
