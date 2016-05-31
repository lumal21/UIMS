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

/*
 *
 *              (C) 2016 UIoT
 *
 *                oo
 *
 *       dP    dP dP 88d8b.d8b. .d8888b.
 *       88    88 88 88'`88'`88 Y8ooooo.
 *       88.  .88 88 88  88  88       88
 *       `88888P' dP dP  dP  dP `88888P'
 *
 *     Smart IoT Network Management System
 *
 */

/*  License
    <UIoT CMS is the default content management system of uiot's
    architecture and environment of the client-side.>
    Copyright (C) <2016>  <University of Brasília>

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

if(!file_exists(__DIR__ . '/UIoT/Vendor/autoload.php')) {
    throw new RuntimeException('UIoTuims needs Composer to Work. Please install Composer by clicking <a href="http://getcomposer.org">here</a>.');
}

(require_once __DIR__ . '/UIoT/Vendor/autoload.php');
(require_once __DIR__ . '/UIoT/Settings.php');
(require_once __DIR__ . '/UIoT/Constants.php');
(require_once __DIR__ . '/UIoT/Mime.php');
(require_once __DIR__ . '/UIoT/Register.php');

/* start environment */
(new UIoT\App\Init);
