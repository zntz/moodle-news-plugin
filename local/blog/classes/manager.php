<?php

namespace local_blog;

use dml_exception;
use stdClass;

class manager {

    public function create_news(string $news_title, string $news_description, int $news_enable): bool
    {
        global $DB;
        $created = time();
        if($news_enable == null) {
            $news_enable = 0;
        }
        $record_to_insert = new stdClass();
        $record_to_insert->newstitle = $news_title;
        $record_to_insert->newsdescription = $news_description;
        $record_to_insert->newsenable = $news_enable;
        $record_to_insert->created = $created;

        try {
            return $DB->insert_record('local_blog', $record_to_insert, false);
        } catch (dml_exception $e) {
            return false;
        }
    }

    public function get_all_news(): array {
        global $DB;
        return $DB->get_records('local_blog');
    }

    public function get_a_news(int $newsid)
    {
        global $DB;
        return $DB->get_record('local_blog', ['id' => $newsid]);
    }

    public function update_news(int $newsid, string $news_title, string $news_description, int $news_enable): bool
    {
        global $DB;
        $object = new stdClass();
        if(!$news_enable) {
            $news_enable = 0;
        }
        $object->id = $newsid;
        $object->newstitle = $news_title;
        $object->newsdescription = $news_description;
        $object->newsenable = $news_enable;
        return $DB->update_record('local_blog', $object);
    }

    public function delete_news($news_id)
    {
        global $DB;
        $transaction = $DB->start_delegated_transaction();
        try {
            $deletedMessage = $DB->delete_records('local_blog', ['id' => $news_id]);
        } catch (dml_exception $e) {
            return false;
        }
        if ($deletedMessage) {
            $DB->commit_delegated_transaction($transaction);
        }
        return true;
    }
}
