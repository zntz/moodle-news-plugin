<?php

defined('MOODLE_INTERNAL') || die();

use local_blog\manager;
require_once($CFG->libdir . "/externallib.php");

class local_blog_external extends external_api  {

    public static function delete_news_parameters() {
        return new external_function_parameters(
            ['newsid' => new external_value(PARAM_INT, 'id of news')]
        );
    }

    public static function delete_news($newsid): string {
        $params = self::validate_parameters(self::delete_news_parameters(), array('newsid'=>$newsid));

        require_capability('local/blog:managenews', context_system::instance());

        $manager = new manager();
        return $manager->delete_news($newsid);
    }

    public static function delete_news_returns() {
        return new external_value(PARAM_BOOL, 'True if the news was successfully deleted.');
    }
}
