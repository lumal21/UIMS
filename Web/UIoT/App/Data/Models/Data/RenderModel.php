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

namespace UIoT\App\Data\Models\Data;

use UIoT\App\Data\Interfaces\Parsers\RenderInterface;
use UIoT\App\Helpers\Manipulation\Strings;

/**
 * Class RenderModel
 * @package UIoT\App\Data\Models\Data
 */
class RenderModel implements RenderInterface
{
    /**
     * @var string Controller Name
     */
    protected $className;

    /**
     * @var string Controller Action
     */
    protected $classMethod;

    /**
     * Set Class Name / Method Name
     *
     * @param $className
     * @param $methodName
     */
    public function __construct($className, $methodName)
    {
        $this->className = Strings::toLower($className);
        $this->classMethod = Strings::toLower($methodName);
    }

    /**
     * Show the Rendered Content
     *
     * @return mixed
     */
    public function showContent()
    {
        return '';
    }
}
