<?php

if ($hassiteconfig) { // needs this condition or there is error on login page

    $ADMIN->add('localplugins', new admin_category('local_blog_category', get_string('pluginname', 'local_blog')));

    $settings = new admin_settingpage('local_blog', get_string('pluginname', 'local_blog'));
    $ADMIN->add('local_blog_category', $settings);

    $settings->add(new admin_setting_configcheckbox('local_blog/enabled',
        get_string('setting_enable', 'local_blog'), get_string('setting_enable_desc', 'local_blog'), '1'));

    $ADMIN->add('local_blog_category', new admin_externalpage('local_blog_manage', get_string('manage', 'local_blog'),
        $CFG->wwwroot . '/local/blog/manage.php'));
}
