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

use UIoT\App\Helpers\Manipulation\Constants as C;

/*
 * Global Variable (Mime Types)
 * Extension / Content-Type
 */
C::addJsonConstant('MIME_TYPES', array(
    'pdf' => 'application/pdf',
    'zip' => 'application/zip',
    'gif' => 'image/gif',
    'png' => 'image/png',
    'jpeg' => 'image/jpg',
    'jpg' => 'image/jpg',
    'mp3' => 'audio/mpeg',
    'wav' => 'audio/x-wav',
    'mpeg' => 'video/mpeg',
    'mpg' => 'video/mpeg',
    'mpe' => 'video/mpeg',
    'mov' => 'video/quicktime',
    'avi' => 'video/x-msvideo',
    '3gp' => 'video/3gpp',
    'css' => 'text/css',
    'jsc' => 'application/javascript',
    'js' => 'application/javascript',
    'json' => 'text/json',
    'svg' => 'image/svg+xml'
));
