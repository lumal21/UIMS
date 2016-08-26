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
class DataTable extends Html
{
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
        $this->htmlBuffer = "<h3>$tableName</h3><br>";
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
     * @param array $properties
     */
    public function addBody($bodyArray = [], array $properties = [])
    {
        $bodyArray = (array)$bodyArray;

        foreach ($bodyArray as $key => $value) {
            if (!in_array($key, $properties)) {
                unset($bodyArray[$key]);
            }
        }

        array_push($this->bodyArray, $bodyArray);
    }

    /**
     * Add Link Interaction
     *
     * @param string $tablePosition
     * @param mixed $interactionContent
     */
    public function addLinkInteraction($tablePosition, $interactionContent)
    {
        $this->bodyInteractions[$tablePosition] = "<a href='$interactionContent={{value}}'>{{value}}</a>";
    }

    /**
     * Show Content
     *
     * @return string
     */
    public function showContent()
    {
        $this->createTable();

        return Format::format($this->htmlBuffer);
    }

    /**
     * Create Data Table
     */
    private function createTable()
    {
        $this->htmlBuffer .= '<table class="hover stack"><thead><tr>';

        $this->createHeader();

        $this->htmlBuffer .= '</tr></thead><tbody>';

        $this->createBody();

        $this->htmlBuffer .= '</tbody></table>';
    }

    /**
     * Create Header Segment
     */
    private function createHeader()
    {
        foreach ($this->headersArray as $header) {
            $this->htmlBuffer .= "<th>{$header}</th>";
        }
    }

    /**
     * Create Body
     */
    private function createBody()
    {
        foreach ($this->bodyArray as $body) {
            $this->htmlBuffer .= "<tr>{$this->createBodyValue($body)}</tr>";
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

        foreach ($bodyValue as $index => $value) {

            $interactionContent = $this->getInteraction($index);

            if (empty($interactionContent)) {
                $interactionContent = $value;
            } else {
                $interactionContent = str_ireplace('{{value}}', $value, $interactionContent);
            }

            $returnString .= "<td>$interactionContent</td>";
        }

        return $returnString;
    }
}
