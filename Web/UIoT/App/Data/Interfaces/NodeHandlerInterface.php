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

namespace UIoT\App\Data\Interfaces;

use UIoT\App\Data\Models\NodeModel;

/**
 * Interface NodeHandlerInterface
 * @package UIoT\App\Data\Interfaces
 */
interface NodeHandlerInterface
{
    /**
     * NodeHandlerInterface constructor.
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
    public function call();

    /**
     * @return mixed
     */
    public function getResult();

    /**
     * @param $result
     * @return mixed
     */
    public function setResult($result);

    /**
     * @return mixed
     */
    public function getPathValue();

    /**
     * @return mixed
     */
    public function getNodeModel();

    /**
     * @param $node_model
     * @return mixed
     */
    public function setNodeModel($node_model);

    /**
     * @param $result_content
     * @return mixed
     */
    public function setResultContent($result_content);

    /**
     * @return mixed
     */
    public function getResultContent();
}
