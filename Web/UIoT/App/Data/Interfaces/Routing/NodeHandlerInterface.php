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

namespace UIoT\App\Data\Interfaces\Routing;

use UIoT\App\Data\Models\Routing\NodeModel;

/**
 * Interface NodeHandlerInterface
 * @package UIoT\App\Data\Interfaces\Routing
 */
interface NodeHandlerInterface
{
    /**
     * NodeHandlerInterface constructor.
     *
     * @param NodeModel $node
     */
    public function __construct(NodeModel $node);

    /**
     * @param array ...$arguments
     * @return mixed
     */
    public function callValue(...$arguments);

    /**
     * @return mixed
     */
    public function getStatus();

    /**
     * @param $result
     * @return mixed
     */
    public function setStatus($result);

    /**
     * @return mixed
     */
    public function getPath();

    /**
     * @return mixed
     */
    public function getNodeModel();

    /**
     * @param $nodeModel
     * @return mixed
     */
    public function setNodeModel($nodeModel);

    /**
     * @param $resultContent
     * @return mixed
     */
    public function setData($resultContent);

    /**
     * @return mixed
     */
    public function getResultContent();
}
