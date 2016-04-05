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

namespace UIoT\App\Helpers\Manipulation;

use UIoT\App\Data\Models\Routing\NodeHandlerModel;
use UIoT\App\Data\Models\Routing\NodeModel;
use UIoT\App\Helpers\Manipulation\Structures\NodeFilter;
use UIoT\App\Helpers\Manipulation\Structures\NodeProperty;

/**
 * Class NodesArray
 *
 * @package UIoT\App\Helpers\Manipulation
 */
class NodesArray extends Arrays
{
    /**
     *
     * Node filter structure
     *
     * @var NodeFilter
     */
    protected static $nodeFilter;

    /**
     *
     * Node parameter structure
     *
     * @var NodeProperty
     */
    protected static $nodeParameter;

    /**
     *
     * Return Search by Parameter
     *
     * @param NodeHandlerModel[]|NodeModel[] $nodeArray
     * @param string $parameterName
     * @param mixed $parameterValue
     * @param string $expression
     *
     * @return array
     */
    public static function getArrayByLogicComparsion(array $nodeArray, $parameterName = '', $parameterValue, $expression = '==')
    {
        self::$nodeFilter = new NodeFilter($parameterName, $parameterValue, $expression);

        return array_filter($nodeArray, [__CLASS__, 'nodeFilterByLogicComparsion']);
    }

    /**
     *
     * Return Object by Search for Property
     *
     * @param array $nodeArray
     * @param integer $index
     * @param mixed $value
     *
     * @return null|NodeModel
     */
    public static function nodeArrayPropertySearch($nodeArray, $index, $value)
    {
        foreach ($nodeArray as $arrayInf)
            if ($arrayInf->{'get' . $index}() == $value)
                return $arrayInf;
        return null;
    }

    /**
     *
     * Return node model array properties
     *
     * @param NodeHandlerModel[]|NodeModel[] $nodeArray
     * @param string $parameterName
     *
     * @return array
     */
    public static function getArrayObjectProperty($nodeArray, $parameterName)
    {
        self::$nodeParameter = new NodeProperty($parameterName);

        return array_map([__CLASS__, 'getNodeModelProperty'], $nodeArray);
    }

    /**
     *
     * Return node model property
     *
     * @param NodeHandlerModel|NodeModel $nodeElement
     *
     * @return mixed
     */
    protected final static function getNodeModelProperty($nodeElement)
    {
        return $nodeElement->{'get' . self::$nodeParameter->parameterName}();
    }

    /**
     *
     * Filter node array elements by matching logic comparsion check
     *
     * @param NodeModel $nodeElement
     *
     * @return bool
     */
    protected final static function nodeFilterByLogicComparsion($nodeElement)
    {
        $variable = empty(self::$nodeFilter->parameterName) ? get_class($nodeElement->getCallback()) : $nodeElement->{'get' . self::$nodeFilter->parameterName}();

        switch (self::$nodeFilter->comparsionExpression):
            default:
                return $variable == self::$nodeFilter->parameterValue;
            case '!=':
                return $variable != self::$nodeFilter->parameterValue;
        endswitch;
    }
}
