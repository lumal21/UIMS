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

use Bramus\Router\Router as IRouter;
use UIoT\App\Data\Models\NodeModel;

/**
 * Class PathFinder
 * @package UIoT\App\Core\Communication\Routing\Path
 */
final class PathFinder
{
    /**
     * Node Indexer Instance
     *
     * @var NodeIndexer
     */
    private $node_indexer = null;

    /**
     * PathFinder constructor.
     */
    public function __construct()
    {
        $this->mountNodeIndexer();
    }

    /**
     *  Set Node Indexer Instances
     */
    private function mountNodeIndexer()
    {
        $this->setNodeIndexer(new NodeIndexer);
    }

    /**
     * Mount Router
     *
     * @param IRouter|null $router
     */
    public function mountRouter(IRouter $router)
    {
        /* get all primary nodes (Nodes with the Lowest Priority Identification, Default: 0 */
        array_map(function ($node) use ($router) {
            $this->mountRouterCoreNode($router, $node);
        }, $this->getNodeIndexer()->getNodesByPriorityId($this->getNodeIndexer()->getLowestNodePriorityId()));
    }

    /**
     * Mount Router Core Node
     *
     * @param IRouter|null $router
     * @param NodeModel|null $node
     */
    public function mountRouterCoreNode(IRouter $router, NodeModel $node)
    {
        /** @var NodeModel $edge */
        foreach ($this->getNodeIndexer()->getNodesByGroup($node->getNodeGroup()) as $edge):

            /* serialize edge data to the callback */
            $edge->getCallback()->setNodeModel($edge);

            /* serialize all nodes from that group starting by the first node from the group (the lowest priority node */
            $this->mountRouterNode($router, $edge);

            /* serialize router node */
            $router->{$edge->getMethod()}($edge->getPath(), [$edge->getCallback(), 'callValue']);

        endforeach;
    }

    /**
     * Return Node Indexer Instance
     *
     * @return NodeIndexer
     */
    public function getNodeIndexer()
    {
        return $this->node_indexer;
    }

    /**
     * Set Node Indexer Instance
     *
     * @param NodeIndexer $node_indexer
     */
    public function setNodeIndexer(NodeIndexer $node_indexer)
    {
        $this->node_indexer = $node_indexer;
    }

    /**
     * Mount Router Node
     *
     * @param IRouter|null $router
     * @param NodeModel|null $node
     */
    public function mountRouterNode(IRouter $router, NodeModel $node)
    {
        /* mount the node edges */
        $router->mount($node->getPath(), function () use ($router, $node) {
            $this->mountRouterEdges($router, $node);
        });
    }

    /**
     * Mount Router Edges
     *
     * @param IRouter|null $router
     * @param NodeModel|null $node
     */
    public function mountRouterEdges(IRouter $router, NodeModel $node)
    {
        /** @var NodeModel $edge */
        foreach ($this->getNodeIndexer()->getNodesByGroup($node->getNodeGroup()) as $edge):

            /* serialize edge data to the callback */
            $edge->getCallback()->setNodeModel($edge);

            /* don't repeat same items */
            if ($edge->getPriority() <= $node->getPriority())
                continue;

            /* serialize router edge */
            $router->{$edge->getMethod()}($edge->getPath(), [$edge->getCallback(), 'callValue']);

        endforeach;
    }

    /**
     * Serialize Call Back Data
     *
     * @param array $nodes
     */
    public function serializeCallBacks(array $nodes)
    {
        /* serialize all call backs data */
        array_walk_recursive($nodes, function (NodeModel $edge) {
            $edge->getCallback()->setNodeModel($edge);
        });
    }
}