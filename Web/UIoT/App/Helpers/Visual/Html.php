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
     * @var array Item Interactions
     */
    protected $bodyInteractions = [];

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
     * Add Button with OnClick Tag
     *
     * @param string $buttonName
     * @param string $buttonType
     * @param string $buttonValue
     * @param string $onClick
     * @param array $buttonClasses
     */
    public function addOnClickButton($buttonName, $buttonType, $buttonValue, $onClick, $buttonClasses = ['id' => '', 'class' => ''])
    {
        $this->addButton($buttonName, $buttonType, $buttonValue, $buttonClasses, "onclick='{$onClick}'");
    }

    /**
     * Add Button
     *
     * @param string $buttonName
     * @param string $buttonType
     * @param string $buttonValue
     * @param array $buttonClasses
     * @param string $properties
     */
    public function addButton($buttonName, $buttonType, $buttonValue, $buttonClasses = ['id' => '', 'class' => ''], $properties = '')
    {
        $this->htmlBuffer .= "<button type='$buttonType' name='$buttonName' id='{$buttonClasses['id']}' class='{$buttonClasses['class']} button' $properties>$buttonValue</button>";
    }

    /**
     * Add Interaction
     *
     * @param int $tablePosition
     * @param mixed $interactionContent
     */
    public function addInteraction($tablePosition, $interactionContent)
    {
        $this->bodyInteractions[$tablePosition] = $interactionContent;
    }

    /**
     * Add Interactions
     *
     * @param array $interactionArray
     */
    public function addInteractions(array $interactionArray)
    {
        foreach($interactionArray as $tablePosition => $interactionContent) {
            $this->bodyInteractions[$tablePosition] = $interactionContent;
        }
    }

    /**
     * Get Interaction
     *
     * @param int $tablePosition
     * @return mixed|string
     */
    public function getInteraction($tablePosition)
    {
        if(array_key_exists($tablePosition, $this->bodyInteractions)) {
            return $this->bodyInteractions[$tablePosition];
        }

        return '';
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
