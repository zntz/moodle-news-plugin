<?php

use local_blog\form\edit;
use local_blog\manager;

require_once(__DIR__ . '/../../config.php');

require_login();
$context = context_system::instance();
require_capability('local/blog:managenews', $context);

$PAGE->set_url(new moodle_url('/local/blog/edit.php'));
$PAGE->set_context(\context_system::instance());
$PAGE->set_title('Edit');
$PAGE->set_heading(get_string('new_form', 'local_blog'));

$newsid = optional_param('newsid', null, PARAM_INT);

// We want to display our form.
$mform = new edit();

if ($mform->is_cancelled()) {
    // Go back to manage.php page
    redirect($CFG->wwwroot . '/local/blog/manage.php', get_string('cancelled_form', 'local_blog'));

} else if ($fromform = $mform->get_data()) {
    $manager = new manager();

    if($fromform->newsenable == null) {
        $fromform->newsenable = 0;
    }

    if ($fromform->id) {
        // We are updating an existing message.
        $manager->update_news($fromform->id, $fromform->newstitle, $fromform->newsdescription, $fromform->newsenable);
        redirect($CFG->wwwroot . '/local/blog/manage.php', get_string('updated_form', 'local_blog') . $fromform->newstitle);
    }

    $manager->create_news($fromform->newstitle, $fromform->newsdescription, $fromform->newsenable);

    // Go back to manage.php page
    redirect($CFG->wwwroot . '/local/blog/manage.php', get_string('created_form', 'local_blog') . $fromform->newstitle);
}

if ($newsid) {
    // Add extra data to the form.
    global $DB;
    $manager = new manager();
    $message = $manager->get_a_news($newsid);
    if (!$message) {
        throw new invalid_parameter_exception('The news not found');
    }
    $mform->set_data($message);
}

echo $OUTPUT->header();
$mform->display();
echo $OUTPUT->footer();
