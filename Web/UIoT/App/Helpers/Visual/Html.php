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
 * Class Html
 * @package UIoT\App\Helpers\Visual
 */
class Html
{
    /**
     * @var string Html Buffer
     */
    protected $htmlBuffer = '';

    /**
     * Add Text Callout
     *
     * @param string $calloutName
     * @param string $calloutContent
     * @param array $calloutClasses
     */
    public function addTextCallout($calloutName, $calloutContent, $calloutClasses = ['id' => '', 'class' => ''])
    {
        $this->addCallout($calloutName, "<p>$calloutContent</p>", $calloutClasses);
    }

    /**
     * Add Callout
     *
     * @param string $calloutName
     * @param string $calloutContent
     * @param array $calloutClasses
     */
    public function addCallout($calloutName, $calloutContent, $calloutClasses = ['id' => '', 'class' => ''])
    {
        $this->htmlBuffer .= "<div class='callout {$calloutClasses['class']}' id='{$calloutClasses['id']}'><h5>$calloutName</h5>$calloutContent</div>";
    }

    /**
     * Show Content
     *
     * @return string
     */
    public function showContent()
    {
        return Format::format($this->htmlBuffer);
    }
}
