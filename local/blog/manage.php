<?php

require_once(__DIR__ . '/../../config.php');

global $DB;

require_login();
$context = context_system::instance();
require_capability('local/blog:managenews', $context);

$PAGE->set_url(new moodle_url('/local/blog/manage.php'));
$PAGE->set_context(\context_system::instance());
$PAGE->set_title(get_string('manage_news', 'local_blog'));
$PAGE->set_heading(get_string('manage_news', 'local_blog'));
$PAGE->requires->js_call_amd('local_blog/confirm');
$PAGE->requires->css('/local/blog/styles.css');

$messages = $DB->get_records('local_blog', null, 'id');

echo $OUTPUT->header();
$templatecontext = (object)[
    'messages' => array_values($messages),
    'editurl' => new moodle_url('/local/blog/edit.php'),
];

echo $OUTPUT->render_from_template('local_blog/manage', $templatecontext);

echo $OUTPUT->footer();
