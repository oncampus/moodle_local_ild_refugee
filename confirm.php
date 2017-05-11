<?php

require_once('../../config.php');
require_once($CFG->dirroot.'/user/profile/lib.php');
require_login();

$context = context_system::instance();
if (!has_capability('moodle/user:editprofile', $context)) {
	echo $OUTPUT->header();
	echo 'permission denied';
	echo $OUTPUT->footer();
	die();
}

global $DB;
$userid = optional_param('id', 0, PARAM_INT);
$action = optional_param('action', '', PARAM_RAW);

if ($action == '') {
	if ($user_pref = $DB->get_record('user_preferences', array('userid' => $userid, 'name' => 'local_ild_refugee'))) {
		$user_pref->value = 1;
		$DB->update_record('user_preferences', $user_pref);
		// Profilfeld setzen
		$user = new stdClass();
		$user->id = $userid;
		profile_load_data($user);
		//print_object($user);
		$user->profile_field_refugee = 1;
		profile_save_data($user);
		$user = $DB->get_record('user', array('id' => $userid));
		$from = new stdClass();
		$from->firstname = $CFG->supportname;
		$from->lastname = '';
		$from->email = $CFG->noreplyaddress;
		
		// nur übergangsweise bis zum mooin-/moodle-update
		$user->department = 'ild_refugee';
		$DB->update_record('user', $user);
		//////////////////////////////////////////////////
		
		email_to_user($user, $from, get_config('local_ild_refugee', 'email_subject'), get_config('local_ild_refugee', 'email_text'), get_config('local_ild_refugee', 'email_text'));
		//print_object($from);die();
		redirect($CFG->wwwroot.'/local/ild_refugee/overview.php');
	}
	echo $OUTPUT->header();
	echo 'error';
	echo $OUTPUT->footer();
	die();
}
else if ($action == 'reject') {
	if ($user_pref = $DB->get_record('user_preferences', array('userid' => $userid, 'name' => 'local_ild_refugee'))) {
		$DB->delete_records('user_preferences', array('id' => $user_pref->id));
		$user = $DB->get_record('user', array('id' => $userid));
		$from = new stdClass();
		$from->firstname = $CFG->supportname;
		$from->lastname = '';
		$from->email = $CFG->noreplyaddress;
		email_to_user($user, $from, get_config('local_ild_refugee', 'email_rejected_subject'), get_config('local_ild_refugee', 'email_rejected_text'), get_config('local_ild_refugee', 'email_rejected_text'));
		redirect($CFG->wwwroot.'/local/ild_refugee/overview.php');
	}
	echo $OUTPUT->header();
	echo 'error';
	echo $OUTPUT->footer();
	die();
}
else {
	echo $OUTPUT->header();
	echo 'error';
	echo $OUTPUT->footer();
	die();
}

?>