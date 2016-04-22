<html>
    <head>
        <meta charset="UTF-8">
    </head>
    <body>
        
<?php

require('lib.php');

$result = call('getMe');

$name = $result['first_name'];
$user = $result['username'];

echo 'Привет, моё имя ' . $name . ', пишите мне в <a href="https://telegram.me/' . $user . '">@' . $user . '</a>';
?>
    </body>
</html>