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

defined('MOODLE_INTERNAL') || die;

if ($hassiteconfig) {
    //global $CFG, $USER, $DB;

    //$moderator = get_admin();
    //$site = get_site();

    $settings = new admin_settingpage('local_ild_refugee', get_string('pluginname', 'local_ild_refugee'));
    $ADMIN->add('localplugins', $settings);

    $name = 'local_ild_refugee/confirm_text';
    $title = get_string('confirm_text', 'local_ild_refugee');
    $description = get_string('confirm_text_desc', 'local_ild_refugee');
    $setting = new admin_setting_confightmleditor($name, $title, $description, get_string('default_confirm_text', 'local_ild_refugee'));
    $settings->add($setting);

    $name = 'local_ild_refugee/email_subject';
    $title = get_string('email_subject_title', 'local_ild_refugee');
    $description = get_string('email_subject_desc', 'local_ild_refugee');
    $setting = new admin_setting_configtext($name, $title, $description, get_string('default_email_subject', 'local_ild_refugee'));
    $settings->add($setting);

    $name = 'local_ild_refugee/email_text';
    $title = get_string('email_text', 'local_ild_refugee');
    $description = get_string('email_text_desc', 'local_ild_refugee');
    $setting = new admin_setting_confightmleditor($name, $title, $description, get_string('default_email_text', 'local_ild_refugee'));
    $settings->add($setting);

    $name = 'local_ild_refugee/email_rejected_subject';
    $title = get_string('email_rejected_subject', 'local_ild_refugee');
    $description = get_string('email_rejected_subject_desc', 'local_ild_refugee');
    $setting = new admin_setting_configtext($name, $title, $description, get_string('default_email_rejected_subject', 'local_ild_refugee'));
    $settings->add($setting);

    $name = 'local_ild_refugee/email_rejected_text';
    $title = get_string('email_rejected_text', 'local_ild_refugee');
    $description = get_string('email_rejected_text_desc', 'local_ild_refugee');
    $setting = new admin_setting_confightmleditor($name, $title, $description, get_string('default_email_rejected_text', 'local_ild_refugee'));
    $settings->add($setting);
}

