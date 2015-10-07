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

namespace UIoT\App\Core\Database;

use PDO;
use stdClass;

/**
 * Class Handler
 * @package UIoT\App\Core\Database
 */
final class Handler
{
    /**
     * Open a Persistent Socket with MySQL Database
     * @author Claudio Santoro
     *
     * @param stdClass $c Connection Details
     */
    public function __construct(stdClass $c)
    {
        return (new PDO("mysql:host={$c->host};port={$c->port};dbname={$c->name}", ($c->user), ($c->pass)));
    }
}