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
//* 
require_once('../../config.php');
//require_once(dirname(__FILE__).'/lib.php');
require_once($CFG->dirroot . '/local/ild_refugee/confirm_refugee_form.php');
require_once($CFG->libdir . '/filelib.php');
require_login();

$PAGE->set_context(context_system::instance());
$PAGE->set_url('/local/ild_refugee/index.php');
$PAGE->set_title(format_string(get_string('pluginname', 'local_ild_refugee')));
$PAGE->set_heading(format_string(get_string('pluginname', 'local_ild_refugee')));


$confirm_form = new confirm_refugee_form();

global $DB, $USER, $COURSE;

$context = context_user::instance($USER->id);

$out = '';

if ($data = $confirm_form->get_data()) {
    file_save_draft_area_files($data->image, $context->id, 'local_ild_refugee', 'image', 0, array('subdirs' => 0, 'maxbytes' => $COURSE->maxbytes, 'maxfiles' => 1));
    if ($refugee_pref = $DB->get_record('user_preferences', array('userid' => $USER->id, 'name' => 'local_ild_refugee'))) {
        //
    } else {
        $refugee_pref = new stdClass();
        $refugee_pref->userid = $USER->id;
        $refugee_pref->name = 'local_ild_refugee';
        $refugee_pref->value = 0;
        $DB->insert_record('user_preferences', $refugee_pref);
    }
    //$out = '<div><br />'.get_string('thankyou', 'local_ild_refugee').'<br /><br /></div>';
    $out = html_writer::div('<br />' . get_string('thankyou', 'local_ild_refugee') . '<br /><br />');
} else if ($confirm_form->is_cancelled()) {
    redirect($CFG->wwwroot . '/my/');
}

echo $OUTPUT->header();

echo $out;

$draftitemid = file_get_submitted_draft_itemid('image');

file_prepare_draft_area($draftitemid, $context->id, 'local_ild_refugee', 'image', 0,
    array('subdirs' => 0, 'maxbytes' => $COURSE->maxbytes, 'maxfiles' => 1));

$image = new stdClass();
$image->id = 0;
$image->image = $draftitemid;

$confirm_form->set_data($image);
$confirm_form->display();

echo $OUTPUT->footer();
//*/

?>
