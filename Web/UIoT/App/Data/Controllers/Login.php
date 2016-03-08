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
 * @developer Igor Moraes
 * @copyright University of Brasília
 */

namespace UIoT\App\Data\Controllers;

use UIoT\App\Data\Models\ControllerModel;

/**
 * Class Login
 * @package UIoT\App\Data\Controllers
 */
final class Login extends ControllerModel
{
    /**
     *
     * This is an Example and Beta Code!
     *
     * @return string
     */
    public function __actionMain()
    {
        $c = '<div class="row"><div class="large-10 columns"><label>Username:<input type="text" name="user" /></label></div></div>';
        $c .= '<div class="row"><div class="large-10 columns"><label>Password:<input type="password" name="password" /></label></div></div>';
        return $c;
    }

    /**
     *
     * This is an Example and Beta Code!
     *
     * @return string
     */
    public function __actionPost()
    {
        $message = ['text' => 'Hello! testing message system ;)'];
        $c = '<div class="row"><div class="large-10 columns"><label class="error">Username:<input type="text" name="user" class="error"/></label><small class="error">' . $message['text'] . "</small></div></div>";
        $c .= '<div class="row"><div class="large-10 columns"><label class="error">Password:<input type="password" name="password" class="error"/></label><small class="error">' . $message['text'] . "</small></div></div>";
        return $c;
    }
}
