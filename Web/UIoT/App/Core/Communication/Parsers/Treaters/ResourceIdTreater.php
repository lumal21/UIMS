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

namespace UIoT\App\Core\Communication\Parsers\Treaters;

use UIoT\App\Data\Singletons\RequestSingleton;

/**
 * Class ResourceIdTreater
 * @package UIoT\App\Core\Communication\Parsers\Treaters
 */
class ResourceIdTreater extends RequestSingleton
{
    /**
     * @var RequestSingleton
     */
    protected static $requestInstance = null;

    /**
     * Parse Request Data or Do Request
     *
     * @param mixed $requestContent
     * @return void
     */
    public function parse($requestContent)
    {
        if (is_object($requestContent)) {
            $raiseObjectTreater = ResourceObjectTreater::getInstance();
            $raiseObjectTreater->parse($requestContent);

            if ($raiseObjectTreater->getDone()) {
                $this->setResponse($raiseObjectTreater->getResponse());
                $this->setDone($raiseObjectTreater->getDone());
                return;
            }
        } elseif (is_array($requestContent) && property_exists($requestContent[0], 'ID')) {
            $this->setResponse($requestContent[0]->ID);
            $this->setDone(false);
            return;
        }
    }
}
