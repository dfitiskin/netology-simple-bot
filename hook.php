<?php

require('lib.php');

$url = getenv('BOT_HOOK_BASE') . '/updates.php';
$result = call('setWebhook', ['url' => $url]);

var_dump($result);
