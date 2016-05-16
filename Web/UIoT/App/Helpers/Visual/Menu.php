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
 * Class Menu
 * @package UIoT\App\Helpers\Visual
 */
final class Menu extends Html
{
    /**
     * Menu constructor.
     */
    public function __construct()
    {
        $this->htmlBuffer = '';
    }

    /**
     * Add Menu Item
     *
     * @param string $url
     * @param string $text
     * @param string $divClass
     */
    public function addItem($url = '', $text = '', $divClass = '')
    {
        $this->htmlBuffer .= "<li class='$divClass'><a href='$url'>$text</a ></li >";
    }

    /**
     * Add Menu Label
     *
     * @param string $text
     * @param string $icon
     */
    public function addLabel($text = '', $icon = '')
    {
        $this->htmlBuffer .= '<li class="heading"><i class="' . $icon . '"></i>  ' . $text . '</li>';
    }
}
