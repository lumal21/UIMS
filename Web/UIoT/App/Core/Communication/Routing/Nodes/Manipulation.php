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
use UIoT\App\Helpers\Manipulation\Arrays;

/**
 * Class Manipulation
 * @package UIoT\App\Core\Communication\Routing\Nodes
 */
class Manipulation extends Arrays
{
    /**
     * @var Filter
     */
    protected $nodeFilter;

    /**
     * @var Properties
     */
    protected $nodeParameter;

    /**
     * Return Search by Parameter
     *
     * @param NodeHandlerModel[]|NodeModel[] $nodeArray
     * @param string $parameterName
     * @param mixed $parameterValue
     * @param string $expression
     * @return array
     */
    public function getArrayByLogicComparison(array $nodeArray, $parameterName = '', $parameterValue, $expression = '==')
    {
        $this->nodeFilter = new Filter($parameterName, $parameterValue, $expression);

        return array_filter($nodeArray, [__CLASS__, 'nodeFilterByLogicComparison']);
    }

    /**
     * Return Object by Search for Property
     *
     * @param array $nodeArray
     * @param integer $index
     * @param mixed $value
     * @return null|NodeModel
     */
    public function nodeArrayPropertySearch($nodeArray, $index, $value)
    {
        foreach ($nodeArray as $arrayInf) {
            if ($arrayInf->{'get' . $index}() == $value) {
                return $arrayInf;
            }
        }

        return null;
    }

    /**
     * Return node model array properties
     *
     * @param NodeHandlerModel[]|NodeModel[] $nodeArray
     * @param string $parameterName
     * @return array
     */
    public function getArrayObjectProperty($nodeArray, $parameterName)
    {
        $this->nodeParameter = new Properties($parameterName);

        return array_map([__CLASS__, 'getNodeModelProperty'], $nodeArray);
    }

    /**
     * Return node model property
     *
     * @param NodeHandlerModel|NodeModel $nodeElement
     * @return mixed
     */
    final protected function getNodeModelProperty($nodeElement)
    {
        return $nodeElement->{'get' . $this->nodeParameter->parameterName}();
    }

    /**
     * Filter node array elements by matching logic comparison check
     *
     * @param NodeModel $nodeElement
     * @return bool
     */
    final protected function nodeFilterByLogicComparison($nodeElement)
    {
        $variable = empty($this->nodeFilter->parameterName) ?
            get_class($nodeElement->getCallBack()) : $nodeElement->{'get' . $this->nodeFilter->parameterName}();

        if ($this->nodeFilter->comparisonExpression == '!=') {
            return $variable != $this->nodeFilter->parameterValue;
        }

        return $variable == $this->nodeFilter->parameterValue;
    }
}
