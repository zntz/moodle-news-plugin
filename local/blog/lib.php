<?php

use local_blog\manager;

function local_blog_before_footer() {
    global $USER;

    if (!get_config('local_blog', 'enabled')) {
        return;
    }
}
