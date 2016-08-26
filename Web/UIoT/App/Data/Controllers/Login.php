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

namespace UIoT\App\Data\Controllers;

use UIoT\App\Core\Communication\Sessions\Indexer;
use UIoT\App\Data\Singletons\ControllerSingleton;

/**
 * Class Login
 * @package UIoT\App\Data\Controllers
 */
final class Login extends ControllerSingleton
{
    /**
     * This is an Example and Beta Code!
     *
     * @return string
     */
    public function actionMain()
    {
        return '<div class="large-6 columns"><h5>Login</h5><div class="row"><div class="small-10 columns"><label>Username<input type="email" id="email"  name="email" aria-describedby="userHelp" required>
        <span class="form-error">You need enter an E-mail</span></label><p class="help-text" id="userHelp">Enter an e-mail please.</p></div></div>
        <div class="row"><div class="small-10 columns"><label>Password Required<input type="password" id="password"  name="password" aria-describedby="passHelp" required>
        <span class="form-error">You need enter an Password</span></label><p class="help-text" id="passHelp">Enter a password please.</p></div></div>
        </div><div class="large-6 columns"><h5>Message to you.</h5><p>Welcome to UIoT administration panel.<br/> This section is restricted to registered users.</p><input class="secondary button" type="submit" name="submit" value="Login"/></div>';
    }

    /**
     * This is an Example and Beta Code!
     *
     * @return string
     */
    public function actionPost()
    {
        Indexer::add('user_name', $_POST['email']);
        return '<div class="row"><div class="large-12 columns"><h5 class="text-center">Welcome to UIoT!</h5><p class="text-center">We\'re loading the Workspace for you.</p><br/><img class="float-center" src="/Login/Resources/Ring.gif"/></div></div><meta http-equiv="refresh" content="5;URL=/home">';
    }
}
