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

use Httpful\Http;

/**
 * Class Forms
 * @package UIoT\App\Helpers\Visual
 */
class Forms extends Html
{
    /**
     * Instantiate HTML Form Handler
     *
     * @param string $formName
     * @param string $formMethod
     * @param string $formAction
     * @param string $formId
     */
    public function __construct($formName = 'Default Html Form', $formAction = '/', $formMethod = Http::POST, $formId = 'DefaultForm')
    {
        $this->htmlBuffer = "<h3>$formName</h3><form id='$formId' method='$formMethod' action='$formAction'>";
    }

    /**
     * Add Form Header
     *
     * @param string $headerText
     * @param string $headerSubText
     */
    public function addHeader($headerText, $headerSubText = '')
    {
        $this->htmlBuffer .= "<h4>$headerText</h4>";

        if (!empty($headerSubText)) {
            $this->htmlBuffer .= "<h5>$headerSubText</h5><br>";
        }
    }

    /**
     * Add Text Input Without Value
     *
     * @param string $inputName
     * @param string $inputLabel
     * @param array $inputClasses
     */
    public function addTextInput($inputName, $inputLabel, $inputClasses = ['id' => '', 'class' => ''])
    {
        $this->addInput($inputName, 'text', $inputLabel, $inputClasses);
    }

    /**
     * Add Input
     *
     * @param string $inputName
     * @param string $inputType
     * @param string $inputLabel
     * @param array $inputClasses
     * @param array $inputValues
     */
    public function addInput($inputName = 'default_input', $inputType = 'text', $inputLabel = 'Default Input', $inputClasses = ['id' => '', 'class' => ''], $inputValues = ['value' => '', 'placeholder' => ''])
    {
        $this->addFormInput('input', $inputName, $inputType, $inputLabel, $inputClasses, $inputValues);
    }

    /**
     * Add HTML Form Tag
     *
     * @param string $inputTag
     * @param string $inputName
     * @param string $inputType
     * @param string $inputLabel
     * @param array $inputClasses
     * @param array $inputValues
     * @param string $innerInputData
     */
    private function addFormInput($inputTag = 'input', $inputName = 'default_input', $inputType = 'text', $inputLabel = 'Default Input', $inputClasses = ['id' => '', 'class' => ''], $inputValues = ['value' => '', 'placeholder' => ''], $innerInputData = '')
    {
        $this->htmlBuffer .= '<div class="row"><div class="small-3 columns"><label for="middle-label" class="text-right middle">' . $inputLabel . '</label></div>';

        $inputContent = "<$inputTag name='$inputName' type='$inputType' placeholder='{$inputValues['placeholder']}' id='{$inputClasses['id']}' class='{$inputClasses['class']}' value='{$inputValues['value']}'>$innerInputData</$inputTag>";

        $this->htmlBuffer .= '<div class="small-9 columns">' . $inputContent . '</div></div>';
    }

    /**
     * Add Text Input with Value
     *
     * @param string $inputName
     * @param string $inputLabel
     * @param array $inputClasses
     * @param array $inputValues
     */
    public function addTextInputWithValue($inputName, $inputLabel, $inputClasses = ['id' => '', 'class' => ''], $inputValues = ['value' => '', 'placeholder' => ''])
    {
        $this->addInput($inputName, 'text', $inputLabel, $inputClasses, $inputValues);
    }

    /**
     * Add Password Input Without Value
     *
     * @param string $inputName
     * @param string $inputLabel
     * @param array $inputClasses
     */
    public function addPasswordInput($inputName, $inputLabel, $inputClasses = ['id' => '', 'class' => ''])
    {
        $this->addInput($inputName, 'password', $inputLabel, $inputClasses);
    }

    /**
     * Add Password Input with Value
     *
     * @param string $inputName
     * @param string $inputLabel
     * @param array $inputClasses
     * @param array $inputValues
     */
    public function addPasswordInputWithValue($inputName, $inputLabel, $inputClasses = ['id' => '', 'class' => ''], $inputValues = ['value' => '', 'placeholder' => ''])
    {
        $this->addInput($inputName, 'password', $inputLabel, $inputClasses, $inputValues);
    }

    /**
     * Add Hidden Input with Value
     *
     * @param string $inputName
     * @param string $inputLabel
     * @param array $inputClasses
     * @param array $inputValues
     */
    public function addHiddenInput($inputName, $inputLabel, $inputClasses = ['id' => '', 'class' => ''], $inputValues = ['value' => '', 'placeholder' => ''])
    {
        $this->addInput($inputName, 'hidden', $inputLabel, $inputClasses, $inputValues);
    }

    /**
     * Add HTML Select Input
     *
     * @param string $inputName
     * @param string $inputLabel
     * @param array $inputClasses
     * @param array $inputValues
     * @param array $selectData (Value => Text)
     */
    public function addSelect($inputName, $inputLabel, $inputClasses = ['id' => '', 'class' => ''], $inputValues = ['value' => '', 'placeholder' => ''], $selectData = [])
    {
        $selectHtml = '';

        foreach ($selectData as $valueText => $friendlyText) {
            $selectHtml .= "<option value='$valueText'>$friendlyText</option>";
        }

        $this->addFormInput('select', $inputName, '', $inputLabel, $inputClasses, $inputValues, $selectHtml);
    }

    /**
     * Show Content
     *
     * @return string
     */
    public function showContent()
    {
        $this->htmlBuffer .= '</form>';

        return Format::format($this->htmlBuffer);
    }
}
