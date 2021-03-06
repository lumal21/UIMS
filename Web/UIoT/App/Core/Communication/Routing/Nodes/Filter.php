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

/**
 * Class Filter
 * @package UIoT\App\Core\Communication\Routing\Nodes
 */
final class Filter
{
    /**
     * @var string
     */
    public $parameterName;

    /**
     * @var string
     */
    public $parameterValue;

    /**
     * @var string
     */
    public $comparisonExpression;

    /**
     * NodeFilterStructure constructor.
     *
     * @param string $parameterName
     * @param string $parameterValue
     * @param string $comparisonExpression
     */
    public function __construct($parameterName, $parameterValue, $comparisonExpression)
    {
        $this->parameterName = $parameterName;
        $this->parameterValue = $parameterValue;
        $this->comparisonExpression = $comparisonExpression;
    }
}
