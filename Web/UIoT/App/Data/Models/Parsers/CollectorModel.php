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

namespace UIoT\App\Data\Models\Parsers;

use UIoT\App\Data\Interfaces\Parsers\CollectorInterface;

/**
 * Class CollectorModel
 *
 * @package UIoT\App\Data\Models
 */
class CollectorModel implements CollectorInterface
{
    /**
     * Requested Data
     *
     * @var mixed
     */
    protected $request;

    /**
     * Parse Request Collecting Data
     *
     * @param $collectorModel mixed
     *
     * @return $this
     */
    public function passRequest($collectorModel)
    {
        /* save request data */
        $this->request = $collectorModel;

        /* return class instance */
        return $this;
    }

    /**
     * Call Handler to Handle Request
     *
     * @param $handlerModel HandlerModel
     *
     * @return mixed
     */
    public function passHandler($handlerModel)
    {
        /* handle request */
        $handlerModel->handleRequest($this->request);

        /* return response */
        return $handlerModel->returnResponse();
    }
}
