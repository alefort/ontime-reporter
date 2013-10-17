<?php

include_once 'config.php';
include_once 'cls/rest_request.php';
include_once 'cls/ontime_api.php';
$ontime = new Ontime_API();
$work_logs = $ontime->get( 'work_logs' );
var_dump( $work_logs );
