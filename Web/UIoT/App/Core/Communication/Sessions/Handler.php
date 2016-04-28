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

namespace UIoT\App\Core\Communication\Sessions;

use SessionHandler;

/**
 * Class Handler
 * @package UIoT\App\Core\Communication\Sessions
 */
final class Handler extends SessionHandler
{
    /**
     * @var string
     */
    private $key;

    /**
     * @var int
     */
    private $timeOut;

    /**
     * Initialize Session Handler
     *
     * @param string $key (24 letters)
     * @param int $timeOut
     */
    public function __construct($key, $timeOut)
    {
        $this->key = $key;
        $this->timeOut = $timeOut;
    }

    /**
     * Read Session
     *
     * @param string $id
     * @return string
     */
    public function read($id)
    {
        /* read parent data */
        $data = parent::read($id);

        /* check if session timed-out, if yes, erase session */
        !self::checkTimeOut($id) || Indexer::removeKey($id);

        /* return session data */
        return mcrypt_decrypt(MCRYPT_3DES, $this->key, $data, MCRYPT_MODE_ECB);
    }

    /**
     * Check if Time out is Gotta
     *
     * @param string $id
     *
     * @return boolean
     */
    private function checkTimeOut($id)
    {
        return parent::read("time-{$id}") > time();
    }

    /**
     * Write Session
     *
     * @param string $id
     * @param string $data
     * @return boolean
     */
    public function write($id, $data)
    {
        /* encrypt data */
        $data = mcrypt_encrypt(MCRYPT_3DES, $this->key, $data, MCRYPT_MODE_ECB);

        /* store time out */
        self::timeOut($id);

        /* write session */
        return parent::write($id, $data);
    }

    /**
     * Put a Time Out
     *
     * @param string $id
     */
    private function timeOut($id)
    {
        /* create time string */
        $time = time() + $this->timeOut;

        /* write the time */
        parent::write("time-{$id}", $time);
    }
}
