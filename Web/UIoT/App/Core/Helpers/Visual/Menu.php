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

namespace UIoT\App\Core\Helpers\Visual;

/**
 * Class Menu
 * @package UIoT\App\Core\Helpers\Visual
 */
final class Menu
{
    /**
     * Final Menu
     *
     * @var string
     */
    private $content = '';

    /**
     * Add Menu Item
     *
     * @param string $url
     * @param string $div_class
     * @param string $div_id
     * @param string $text
     * @param string $ref_label
     */
    public function __addItem($url = '', $div_class = '', $div_id = '', $text = '', $ref_label = '')
    {
        $this->content .= '<li class="' . $ref_label . '"><a href="' . $url . '" ><i class="' . $div_class . '" id="' . $div_id . '"></i > ' . $text . '</a ></li >';
    }

    /**
     * Add Menu Label
     *
     * @param string $text
     * @param string $icon
     */
    public function __addLabel($text = '', $icon = '')
    {
        $this->content .= '<li class="heading"><i class="' . $icon . '"></i>  ' . $text . '</li>';
    }

    /**
     * Return Content
     */
    public function __returnItems()
    {
        echo $this->content;
    }
}
