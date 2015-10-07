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
use PDOStatement;

/**
 * Class Adapter
 * @package UIoT\App\Core\Database
 */
final class Adapter
{
    /**
     * @var Handler
     */
    private $instance;

    /**
     * creates MySQL Connection
     */
    public function __construct()
    {
        $this->instance = (new Handler(json_decode(SETTINGS)->database));
    }

    /**
     * function fetch_array
     * fetch an array of query
     * @param PDOStatement $query
     * @return array
     */
    public function fetch_array(PDOStatement $query)
    {
        return $query->fetch(PDO::FETCH_ASSOC);
    }

    /**
     * function fetch_object
     * fetch an array of query
     * @param PDOStatement $query
     * @return object
     */
    public function fetch_object(PDOStatement $query)
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
    public function secure_query($query = '', $array = [])
    {
        if ($this->instance instanceof PDO) {
                    return $this->instance->prepare($query)->execute($array);
        }
        return null;
    }

    /**
     * function query
     * do a query ;)
     * @param string $query
     * @return PDOStatement
     */
    public function query($query = '')
    {
        if ($this->instance instanceof PDO) {
                    return $this->instance->query($query);
        }
        return null;
    }

    /**
     * function row_count
     * count number of fields
     * @param PDOStatement $query
     * @return int
     */
    public function row_count(PDOStatement $query)
    {
        return $query->rowCount();
    }
}
