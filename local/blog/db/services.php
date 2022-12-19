<?php
$functions = array(
    'local_blog_delete_news' => array(         //web service function name
        'classname'   => 'local_blog_external',  //class containing the external function OR namespaced class in classes/external/XXXX.php
        'methodname'  => 'delete_news',          //external function name
        'classpath'   => 'local/blog/externallib.php',  //file containing the class/external function - not required if using namespaced auto-loading classes.
        'description' => 'Deletes a news',    //human readable description of the web service function
        'type'        => 'write',                  //database rights of the web service function (read, write)
        'ajax' => true,        // is the service available to 'internal' ajax calls.
        'capabilities' => '', // comma separated list of capabilities used by the function.
    ),
);
