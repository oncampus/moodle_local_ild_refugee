<?php

require_once('../../config.php');
require_once($CFG->libdir . '/filelib.php');
require_login();

$context = context_system::instance();
if (!has_capability('moodle/user:editprofile', $context)) {
    echo $OUTPUT->header();
    echo 'permission denied';
    echo $OUTPUT->footer();
    die();
}

$context = optional_param('context', 0, PARAM_INT);
$component = optional_param('component', '', PARAM_RAW);
$area = optional_param('area', '', PARAM_RAW);

$fs = get_file_storage();
$files = $fs->get_area_files($context, $component, $area);

if (count($files) == 2) {
    foreach ($files as $file) {
        if ($file->get_filename() != '.') {
            //echo $file->get_filename();
            //send_stored_file($file, null, 0, true);
            send_stored_file($file);
            die();
        }
    }
}

echo $OUTPUT->header();
echo 'File not found';
echo $OUTPUT->footer();

?>