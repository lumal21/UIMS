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

namespace UIoT\App\Classes\Communication\Sessions;

use SessionHandler;

/**
 * Class Handler
 * @package UIoT\App\Classes\Communication\Sessions
 */
final class Handler extends SessionHandler
{
    /**
     * string @var
     */
    private $key;

    /**
     * int @var
     */
    private $time_out;

    /**
     * Initialize Session Handler
     *
     * @param string $key (24 letters)
     * @param int $time_out
     */
    public function __construct($key, $time_out)
    {
        $this->key      = $key;
        $this->time_out = $time_out;
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
        if (self::check_time_out($id)) Indexer::removeKey($id);

        /* return session data */
        return mcrypt_decrypt(MCRYPT_3DES, $this->key, $data, MCRYPT_MODE_ECB);
    }

    /**
     * Check if Time out is Gotta
     *
     * @param $id
     * @return bool
     */
    private function check_time_out($id)
    {
        return (parent::read("time-{$id}") > time());
    }

    /**
     * Write Session
     *
     * @param string $id
     * @param string $data
     * @return bool
     */
    public function write($id, $data)
    {
        /* encrypt data */
        $data = mcrypt_encrypt(MCRYPT_3DES, $this->key, $data, MCRYPT_MODE_ECB);

        /* store time out */
        self::time_out($id);

        /* write session */
        return parent::write($id, $data);
    }

    /**
     * Put a Time Out
     *
     * @param $id
     */
    private function time_out($id)
    {
        /* create time string */
        $time = time() + $this->time_out;

        /* write the time */
        parent::write("time-{$id}", $time);
    }
}