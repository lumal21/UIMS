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

namespace UIoT\App\Core\Controllers;

use UIoT\App\Core\Helpers\Manipulators\Arrays;
use UIoT\App\Core\Helpers\Manipulators\Constants;
use UIoT\App\Core\Helpers\Manipulators\Strings;
use UIoT\App\Exception\Register;

/**
 * Class Commander
 * @property array controller_actions
 * @property string controller_name
 * @property \UIoT\App\Data\Models\IController controller
 * @package UIoT\App\Core\Controllers
 */
final class Commander
{
    /**
     * Start Controller Data
     *
     * @param string $controller_name
     * @param $action_name
     */
    public function __construct($controller_name, $action_name = 'main')
    {
        /* if is non abstract controller or is an abstract controller */
        if (Indexer::controllerExists($controller_name)):
            $this->controller = (Indexer::getController($controller_name));
            $this->controller_actions = (Arrays::staticToArray($controller_name));
            $this->controller_name = $controller_name;
        else:
            $c = (new Controllable($controller_name, $action_name));
            $this->controller = $c->c_data;
            $this->controller_actions = (Arrays::abstractToArray($c->c_s_array));
            $this->controller_name = (Strings::toControllerName($controller_name));
        endif;
    }

    /**
     * Enable Action
     *
     * @param string $action_name
     * @return mixed
     */
    public function setAction($action_name)
    {
        /* check if action exists, if not we have problem! */
        ($this->checkActionExistence($action_name)) || (Register::getRunner()->errorMessage(902,
            "Stop! That Action Doesn't Exists!",
            'Details: ',
            [
                'What Happened?' => "You're trying to Call an nonexistent Action",
                'What Action?' => "Action with name: {$action_name}",
                'From the Controller:' => "{$this->controller_name}",
                'Resolution:' => "Stop trying to call nonexistent actions.",
                'What Actions can i Call?' => "You can Call UIoT's Abstract Actions (Handlers), and the Built-In Controllers Actions",
                'Are you the developer?' => 'You can open this same error Page with Developer Code, only need put ?de on the Url'
            ]
        ));

        /* if not call action */
        $this->refineControllerData($this->controller->{Strings::toActionMethodName($action_name)}());
    }

    /**
     * Check if Action Exists
     *
     * @param string $action_name
     * @return bool
     */
    public function checkActionExistence($action_name)
    {
        return (in_array((Strings::toActionName($action_name)), $this->controller_actions));
    }

    /**
     * Refine Controller Code
     *
     * @param mixed|string $returned_code
     */
    public function refineControllerData($returned_code = '')
    {
        Constants::addConstant('CONTROLLER_CONTENT', $returned_code);
    }
}