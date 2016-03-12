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

namespace UIoT\App\Core\Helpers\Manipulation\Structures;

/**
 * Class NodeFilter
 *
 * @package UIoT\App\Core\Helpers\Manipulation\Structures
 */
final class NodeFilter
{
    /**
     *
     * Parameter name
     *
     * @var string
     */
    public $parameterName;

    /**
     *
     * Parameter value
     *
     * @var string
     */
    public $parameterValue;

    /**
     *
     * Comparsion expression
     *
     * @var string
     */
    public $comparsionExpression;

    /**
     *
     * NodeFilterStructure constructor.
     *
     * @param string $parameterName
     * @param string $parameterValue
     * @param string $comparsionExpression
     */
    public final function __construct($parameterName, $parameterValue, $comparsionExpression)
    {
        $this->parameterName = $parameterName;
        $this->parameterValue = $parameterValue;
        $this->comparsionExpression = $comparsionExpression;
    }
}
