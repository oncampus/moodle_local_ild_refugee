<?php
// This file is part of Moodle - http://moodle.org/
//
// Moodle is free software: you can redistribute it and/or modify
// it under the terms of the GNU General Public License as published by
// the Free Software Foundation, either version 3 of the License, or
// (at your option) any later version.
//
// Moodle is distributed in the hope that it will be useful,
// but WITHOUT ANY WARRANTY; without even the implied warranty of
// MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
// GNU General Public License for more details.
//
// You should have received a copy of the GNU General Public License
// along with Moodle.  If not, see <http://www.gnu.org/licenses/>.

/**
 * Local Refugee
 *
 * This Plugin allows refugees to upload copy of a certicate to confirm, that they are refugees
 * in order to get a refugee-flag (profile field), so they can enter some courses for free
 *
 * @package    local
 * @subpackage local_ild_refugee
 * @copyright  2016 Jan Rieger
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

$plugin->version = 2016122500;
$plugin->requires = 2011033010;
$plugin->release = '1.0 (Build: 2016122500)';
$plugin->maturity = MATURITY_STABLE;
$plugin->component = 'local_ild_refugee';
