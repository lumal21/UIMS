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

namespace UIoT\App\Core\Communication\Routing\Path;

use UIoT\App\Core\Helpers\Manipulation\NodesArray;
use UIoT\App\Data\Models\NodeHandlerModel;
use UIoT\App\Data\Models\NodeModel;

/**
 * Class NodeIndexer
 * @package UIoT\App\Core\Communication\Routing\Path
 */
final class NodeIndexer
{
    /**
     *
     * Array of Nodes
     *
     * @var NodeModel[]
     */
    public $nodes = [];

    /**
     *
     * Add a Node and return int Node Id
     *
     * @param array $node_item_array
     *
     * @return integer|null
     */
    public function addNode(array $node_item_array)
    {
        $this->nodes[$this->getNodeSize() + 1] = new NodeModel($this->getNodeSize() + 1, $node_item_array['path'], $node_item_array['callback'], $node_item_array['priority'], $node_item_array['method'], $node_item_array['group']);
    }

    /**
     *
     * Return Node Array Size - The count of NodeModel in $node
     *
     * @return integer|double
     */
    private function getNodeSize()
    {
        return sizeof($this->getNodes()) - 1;
    }

    /**
     *
     * Return All Nodes
     *
     * @return NodeModel[]
     */
    public function getNodes()
    {
        return $this->nodes;
    }

    /**
     *
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
     * @param NodeModel $node_a
     * @param NodeModel $node_b
     *
     * @return int
     */
    public function sortNodes(NodeModel $node_a, NodeModel $node_b)
    {
        return $node_a->getPriority() != $node_b->getPriority() ? (($node_a->getPriority() < $node_b->getPriority()) ? -1 : 1) : 0;
    }

    /**
     *
     * Update NodeModel Node Ids
     *
     * @param int $node_id
     * @param NodeModel $node
     *
     * @return NodeModel
     */
    public function updateNodeIds($node_id, NodeModel $node)
    {
        /* set new node unique identification */
        $node->setNodeId($node_id);

        /* return node */
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
     *
     * Return a Node by Path
     *
     * @param $path
     *
     * @return NodeModel|null
     */
    public function getNodeByPath($path)
    {
        return NodesArray::nodeArrayPropertySearch($this->getNodes(), 'Path', $path);
    }

    /**
     *
     * Return Node by Id
     *
     * @param int $node_id
     *
     * @return NodeModel|null
     */
    public function getNodeById($node_id)
    {
        return NodesArray::nodeArrayPropertySearch($this->getNodes(), 'NodeId', $node_id);
    }

    /**
     *
     * Return all Nodes from a Specific Priority
     *
     * @param integer $priority_id
     *
     * @return NodeModel[]
     */
    public function getNodesByPriorityId($priority_id)
    {
        return $this->getNodesByParameter('Priority', $priority_id, '==');
    }

    /**
     *
     * Return Search by Parameter
     *
     * @param string $parameter_name
     * @param mixed $parameter_value
     * @param string $expression
     *
     * @return NodeModel[]
     */
    private function getNodesByParameter($parameter_name, $parameter_value, $expression = '==')
    {
        return NodesArray::getArrayByLogicComparsion($this->getNodes(), $parameter_name, $parameter_value, $expression);
    }

    /**
     *
     * Return All Nodes that Matched
     *
     * @return NodeModel[]
     */
    public function getNodesThatMatched()
    {
        return $this->getNodesByCallBackParameter('Result', true, '==');
    }

    /**
     *
     * Return Search by Parameter
     *
     * @param string $parameter_name
     * @param mixed $parameter_value
     * @param string $expression
     *
     * @return NodeModel[]
     */
    private function getNodesByCallBackParameter($parameter_name, $parameter_value, $expression = '==')
    {
        return NodesArray::getArrayByLogicComparsion($this->getNodesCallBack(), $parameter_name, $parameter_value, $expression);
    }

    /**
     *
     * Get Nodes Callback Array
     *
     * @return NodeModel[]
     */
    public function getNodesCallBack()
    {
        return array_map(function (NodeModel $node) {
            return $node->getCallback();
        }, $this->getNodes());
    }

    /**
     *
     * Return All Nodes that was tested with Path
     *
     * @return NodeModel[]
     */
    public function getNodesWithPathValue()
    {
        return $this->getNodesByCallBackParameter('PathValue', [], '!=');
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
     * @param string $parameter_name
     *
     * @return NodeModel[]
     */
    private function getNodesParameterByParameter($parameter_name)
    {
        return NodesArray::getArrayObjectProperty($this->getNodes(), $parameter_name);
    }

    /**
     *
     * Check if Node Exists
     *
     * @param int $node_id
     *
     * @return bool
     */
    public function nodeExistsById($node_id)
    {
        return (bool)NodesArray::nodeArrayPropertySearch($this->getNodes(), 'NodeId', $node_id);
    }

    /**
     *
     * Remove Nodes from NodeIndexer
     *
     * @param NodeModel $edge
     */
    public function removeNodesFromArray(NodeModel $edge)
    {
        $this->setNodes($this->getNodesByCallBack($this->getNodes(), $edge->getCallback()));
    }

    /**
     *
     * Remove each instance of an object within an array (matched on a given property, $prop)
     *
     * @param NodeModel[] $array
     * @param NodeHandlerModel $value
     *
     * @return array
     */
    public function getNodesByCallBack(array $array, $value)
    {
        return array_filter($array, function (NodeModel $a) use ($value) {
            return get_class($a->getCallback()) != get_class($value);
        });
    }

    /**
     *
     * Perform NodeIndexer Changes List
     *
     * @param NodeHandlerModel $node
     */
    public function performCoreUpdate(NodeHandlerModel $node)
    {
        array_map([$this, 'removeNodesFromArray'], $this->getNodesByGroup($node->getNodeModel()->getNodeGroup()));
    }

    /**
     *
     * Return all Nodes from a Specific Group
     *
     * @param string $node_group
     *
     * @return NodeModel[]
     */
    public function getNodesByGroup($node_group)
    {
        return $this->getNodesByParameter('NodeGroup', $node_group, '==');
    }
}
