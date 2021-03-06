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

namespace UIoT\App\Data\Models\Requesting;

use UIoT\App\Data\Interfaces\Requesting\RequestInterface;

/**
 * Class RequestModel
 * @package UIoT\App\Data\Models\Requesting
 */
class RequestModel implements RequestInterface
{
    /**
     * @var bool Job Status
     */
    private $jobStatus = false;

    /**
     * @var mixed Response Content
     */
    private $responseData = '';

    /**
     * Parse Request Data or Do Request
     *
     * @param mixed|null $data
     * @return void
     */
    public function parse($data = null)
    {
        $this->setStatus(true);

        $this->setData($data);
    }

    /**
     * Set Job Status
     *
     * @param boolean $jobStatus
     * @return bool
     */
    public function setStatus($jobStatus)
    {
        return $this->jobStatus = $jobStatus;
    }

    /**
     * Set Response Content
     *
     * @param mixed $responseContent
     * @return void
     */
    public function setData($responseContent)
    {
        $this->responseData = $responseContent;
    }

    /**
     * Check if Job is Done
     *
     * @SuppressWarnings(PHPMD.BooleanGetMethodName)
     *
     * @return boolean
     */
    public function getStatus()
    {
        return $this->jobStatus;
    }

    /**
     * Get Response Content
     *
     * @return mixed
     */
    public function getData()
    {
        return $this->responseData;
    }
}
