<?php
require_once('../../config.php');
require_once($CFG->libdir . '/filelib.php');
require_once($CFG->libdir . '/tablelib.php');
require_login();

$PAGE->set_context(context_system::instance());
$PAGE->set_url('/local/ild_refugee/overview.php');
$PAGE->set_title(format_string(get_string('pluginname', 'local_ild_refugee')));
$PAGE->set_heading(format_string(get_string('pluginname', 'local_ild_refugee')));

$context = context_system::instance();
if (!has_capability('moodle/user:editprofile', $context)) {
    echo $OUTPUT->header();
    echo 'permission denied';
    echo $OUTPUT->footer();
    die();
}

$sql = 'SELECT u.id, u.firstname, u.lastname, u.email, up.* 
		  FROM mdl_user_preferences AS up, mdl_user AS u 
	     WHERE u.id = up.userid 
	       AND up.name = ? 
		   AND up.value = 0';
$params = array('local_ild_refugee');

$user_prefs = $DB->get_records_sql($sql, $params);

$fs = get_file_storage();

$table = new flexible_table(MODULE_TABLE);
$table->define_columns(array('name', 'email', 'image', 'confirm_reject')); // TODO: Spalte 'Abgelehnt!'
$table->define_headers(array(get_string('name'), get_string('email'), get_string('file'), get_string('confirm') . '/' . get_string('reject')));
$table->define_baseurl($CFG->wwwroot . '/local/ild_refugee/overview.php');
$table->set_attribute('class', 'admintable generaltable');
//$table->sortable(true, 'name', SORT_ASC);
$table->setup();

echo $OUTPUT->header();
echo $OUTPUT->heading(get_string('pluginname', 'local_ild_refugee'));

foreach ($user_prefs as $user_pref) {
    $usercontext = context_user::instance($user_pref->userid);
    $files = $fs->get_area_files($usercontext->id, 'local_ild_refugee', 'image');

    if (count($files) == 2) {
        foreach ($files as $file) {
            if ($file->get_filename() != '.') {
                $url = $CFG->wwwroot . '/local/ild_refugee/image.php?context=' . $usercontext->id . '&component=local_ild_refugee&area=image';
                $confirm_url = $CFG->wwwroot . '/local/ild_refugee/confirm.php?id=' . $user_pref->userid;
                $reject_url = $CFG->wwwroot . '/local/ild_refugee/confirm.php?id=' . $user_pref->userid . '&action=reject';
                $table->add_data(
                    array(
                        $user_pref->firstname . ' ' . $user_pref->lastname,
                        $user_pref->email,
                        //$user_pref->value,
                        '<a href="' . $url . '" target="_blank">' . get_string('show') . '</a>',
                        '<a href="' . $confirm_url . '" onclick="return confirm(\'' . get_string('confirmcheckfull', 'local_ild_refugee', $user_pref->firstname . ' ' . $user_pref->lastname) . '\');">' . get_string('confirm') . '</a> / ' .
                        '<a href="' . $reject_url . '" onclick="return confirm(\'' . get_string('rejectcheckfull', 'local_ild_refugee', $user_pref->firstname . ' ' . $user_pref->lastname) . '\');">' . get_string('reject') . '</a>'
                    )
                );
            }
        }
    }
}
$table->print_html();

echo $OUTPUT->footer();
?>