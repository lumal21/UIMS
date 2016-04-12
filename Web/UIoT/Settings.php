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

/*  License
 *  <UIoT CMS is the default content management system of uiot's
 *  architecture and environment of the client-side.>
    Copyright (C) <2015>  <University of Bras�lia>

    This program is free software: you can redistribute it and/or modify
    it under the terms of the GNU General Public License as published by
    the Free Software Foundation, either version 3 of the License, or
    (at your option) any later version.

    This program is distributed in the hope that it will be useful,
    but WITHOUT ANY WARRANTY; without even the implied warranty of
    MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
    GNU General Public License for more details.

    You should have received a copy of the GNU General Public License
    along with this program.  If not, see <http://www.gnu.org/licenses/>.
 */

namespace UIoT;

use UIoT\App\Core\Settings\Register;

/**
 * UIoTcms Settings
 * Please be Careful at configuring the settings
 */

Register::prepareSettings();

Register::addSettingsBlock('raise', [
    'raiseHost' => 'localhost',
    'raiseBasePath' => '',
    'raisePort' => 8080,
    'raiseSsl' => false
]);

Register::addSettingsBlock('security', [
    // session encrypt (mb-encrypt, bcrypt) salt, must be 24 length salt string.
    'sessionHandlerSalt' => 'uniform-internetofthings',
    // session expire (seconds)
    'sessionTimeOut' => 960,
    // white list ip to access security items and complete exceptions stack trace, debug tools etc.
    'whiteIpList' =>
        [
            '127.0.0.1',
            'localhost'
        ]
]);

Register::addSettingsBlock('exceptions', [
    // set error page title
    'errorPageTitle' => 'Houston, we have a problem!',
    // set reporting php error level
    'errorReportingLevels' => (E_ALL ^ E_WARNING),
    // set query_string developer access mode
    'errorDeveloperCode' => 'de',
    // set whoops resource folder
    'errorResourceFolder' => 'Whoops'
]);

Register::addSettingsBlock('resources', [
    'enableCaching' => true
]);

Register::runSettings();
