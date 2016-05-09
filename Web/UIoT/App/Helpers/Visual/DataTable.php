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

namespace UIoT\App\Helpers\Visual;

/**
 * Class DataTable
 * @package UIoT\App\Helpers\Visual
 */
class DataTable
{
    /**
     * @var string Data Table Data
     */
    private $tableData = '';

    /**
     * @var array Header Content
     */
    private $headersArray = [];

    /**
     * @var array Body Content
     */
    private $bodyArray = [];

    /**
     * Instantiate new DataTable
     *
     * @param $tableName
     */
    public function __construct($tableName = 'Default Table')
    {
        $this->tableData = "<h3>$tableName</h3><br>";
    }

    /**
     * Add Header to Headers
     *
     * @param string $headerTitle
     */
    public function addHeader($headerTitle)
    {
        array_push($this->headersArray, $headerTitle);
    }

    /**
     * Add a Body segment to Body Array
     *
     * @param array $bodyArray
     */
    public function addBody($bodyArray = [])
    {
        array_push($this->bodyArray, $bodyArray);
    }

    public function showContent()
    {
        $this->createTable();

        return $this->tableData;
    }

    /**
     * Create Data Table
     */
    private function createTable()
    {
        $this->tableData .= '<table><thead><tr>';

        $this->createHeader();

        $this->tableData .= '</tr></thead><tbody>';

        $this->createBody();

        $this->tableData .= '</tbody></table>';
    }

    /**
     * Create Header Segment
     */
    private function createHeader()
    {
        foreach($this->headersArray as $header) {
            $this->tableData .= "<th>{$header}</th>";
        }
    }

    /**
     * Create Body
     */
    private function createBody()
    {
        foreach($this->bodyArray as $body) {
            $this->tableData .= "<tr>{$this->createBodyValue($body)}</tr>";
        }
    }

    /**
     * Create Body Value Segment
     *
     * @param array $bodyValue
     * @return string
     */
    private function createBodyValue($bodyValue = [])
    {
        $returnString = '';

        foreach($bodyValue as $value) {
            $returnString .= "<td>$value</td>";
        }

        return $returnString;
    }
}
