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
 * @copyright University of Brasília
 */

namespace UIoT\App\Core\Database;

use PDO;
use PDOStatement;

/**
 * Class Adapter
 * @property PDO instance
 * @package UIoT\App\Core\Database
 */
final class Adapter
{
    /**
     * creates MySQL Connection
     */
    function __construct()
    {
        $this->instance = (new Handler(json_decode(SETTINGS)->database));
    }

    /**
     * function fetch_array
     * fetch an array of query
     * @param PDOStatement $query
     * @return array
     */
    function fetch_array(PDOStatement $query)
    {
        return $query->fetch(PDO::FETCH_ASSOC);
    }

    /**
     * function fetch_object
     * fetch an array of query
     * @param PDOStatement $query
     * @return object
     */
    function fetch_object(PDOStatement $query)
    {
        return $query->fetch(PDO::FETCH_OBJ);
    }

    /**
     * function secure_query
     * do a query ;)
     * @param string $query
     * @param array $array
     * @return PDOStatement
     */
    function secure_query($query = '', $array = [])
    {
        return $this->instance->prepare($query)->execute($array);
    }

    /**
     * function query
     * do a query ;)
     * @param string $query
     * @return PDOStatement
     */
    function query($query = '')
    {
        return $this->instance->query($query);
    }

    /**
     * function row_count
     * count number of fields
     * @param PDOStatement $query
     * @return int
     */
    function row_count(PDOStatement $query)
    {
        return $query->rowCount();
    }
}
