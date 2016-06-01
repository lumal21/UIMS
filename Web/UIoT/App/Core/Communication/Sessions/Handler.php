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
     * Initialize Session Handler
     *
     * @param string $key (24 letters)
     */
    public function __construct($key)
    {
        $this->key = $key;
    }

    /**
     * Read Session
     *
     * @param string $sessionId
     * @return string
     */
    public function read($sessionId)
    {
        /* read parent data */
        $data = parent::read($sessionId);

        /* return session data */
        return mcrypt_decrypt(MCRYPT_3DES, $this->key, $data, MCRYPT_MODE_ECB);
    }

    /**
     * Write Session
     *
     * @param string $sessionId
     * @param string $data
     * @return boolean
     */
    public function write($sessionId, $data)
    {
        /* encrypt data */
        $data = mcrypt_encrypt(MCRYPT_3DES, $this->key, $data, MCRYPT_MODE_ECB);

        /* write session */
        return parent::write($sessionId, $data);
    }
}
