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

namespace UIoT\App\Data\Interfaces;

/**
 * Interface NodeInterface
 * @package UIoT\App\Data\Interfaces
 */
interface NodeInterface
{
    public function __construct($node_id, $path, $callback, $priority, $method, $group);

    public function isAbsolute();

    public function getPath();

    public function setPath($path);

    public function getCallback();

    public function setCallback($callback);

    public function getMethod();

    public function setMethod($method);

    public function getPriority();

    public function setPriority($priority);

    public function getNodeGroup();

    public function setNodeGroup($node_group);
}
