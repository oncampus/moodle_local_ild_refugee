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

defined('MOODLE_INTERNAL') || die();

require_once($CFG->libdir . '/formslib.php');

class confirm_refugee_form extends moodleform {

    public function definition() {
        global $USER, $CFG, $COURSE;

        $mform = $this->_form;

        $mform->addElement('static', 'cofirm_text', '', get_config('local_ild_refugee', 'confirm_text'));

        $mform->addElement('filemanager', 'image', get_string('file'), '0',
            array('maxbytes' => $COURSE->maxbytes, 'accepted_types' => array('.jpg', '.png'), 'maxfiles' => 1));
        $mform->addRule('image', get_string('required'), 'required', null, 'client');

        // Dateiupload

        //$mform->addElement('submit', 'submit', get_string('delete'));
        $this->add_action_buttons(true, get_string('submit'));
    }
}
