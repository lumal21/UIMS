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
use UIoT\App\Core\Communication\Routing\Nodes\Manager;
use UIoT\App\Data\Models\Routing\NodeModel;

/**
 * Class PathFinder
 * @package UIoT\App\Core\Communication\Routing\Path
 */
final class PathFinder
{
    /**
     * @var Manager
     */
    private $nodeIndexer = null;

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
        $this->setNodeIndexer(new Manager);
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
            $this->mountRouterEdges($router, $node, false);
        }, $this->getNodeIndexer()->getNodesByPriorityId($this->getNodeIndexer()->getLowestNodePriorityId()));
    }

    /**
     * Mount Router Edges
     *
     * @param IRouter|null $router
     * @param NodeModel|null $node
     * @param bool $recursively
     */
    public function mountRouterEdges(IRouter $router, NodeModel $node, $recursively)
    {
        /** @var NodeModel $edge */
        foreach ($this->getNodeIndexer()->getNodesByGroup($node->getNodeGroup()) as $edge) {
            $edge->getCallBack()->setNodeModel($edge);

            /* don't repeat same items if is recursively */
            if (($edge->getPriority() <= $node->getPriority()) && $recursively) {
                continue;
            }

            $this->mountRouterNode($router, $edge);

            $router->{$edge->getMethod()}($edge->getPath(), [$edge->getCallBack(), 'callValue']);
        }
    }

    /**
     * Return Node Indexer Instance
     *
     * @return Manager
     */
    public function getNodeIndexer()
    {
        return $this->nodeIndexer;
    }

    /**
     * Set Node Indexer Instance
     *
     * @param Manager $nodeIndexer
     */
    public function setNodeIndexer(Manager $nodeIndexer)
    {
        $this->nodeIndexer = $nodeIndexer;
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
            $this->mountRouterEdges($router, $node, true);
        });
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
            $edge->getCallBack()->setNodeModel($edge);
        });
    }
}
