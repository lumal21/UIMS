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

use UIoT\App\Core\Helpers\Manipulators\Constants as C;

/**
 * UIoTcms Settings
 * Please be Careful at configuring the settings
 */

C::__addJConstant('SETTINGS', [
    // database settings (not really necessary, because the cms doesn't uses database connection
    // but you can set and enable cms database connection if you want
    'database' =>
        [
            'host' => 'localhost',
            'port' => 3306,
            'user' => 'root',
            'pass' => 'latitude',
            'name' => 'cms',
        ],
    'raise' =>
        [
            // host (ip, dns, etc.) (not url!)
            'host' => 'rest_uiot',
            // base path (if the api is in sub directory likely host/sub-folder/ (default: empty)
            'base_path' => '',
            // port, is totally necessary (default: 80)
            'port' => 82,
            // ssl connection (default: false)
            'ssl' => false,
        ],
    'security' =>
        [
            // session encrypt (mb-encrypt, bcrypt) salt, must be 24 length salt string.
            'session_handler_salt' => 'uniform-internetofthings',
            // session expire (seconds)
            'session_time_out' => 960,
            // white list ip to access security items and complete exceptions stack trace, debug tools etc.
            'white_ip_list' =>
                [
                    '127.0.0.1',
                    'localhost'
                ],
        ]
], JSON_FORCE_OBJECT);