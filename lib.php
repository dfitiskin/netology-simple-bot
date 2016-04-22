<?php

function call($command, $params = []) 
{
    $token = getenv('BOT_TOKEN');
    $url = 'https://api.telegram.org/bot' . $token . '/' . $command;
    
    if ($params) {
        $url .= '?' . http_build_query($params);
    }
    
    $content = file_get_contents($url);
    $data = json_decode($content, true);
    if (!$data['ok']) die('Произошла ошабка');
    return $data['result'];
}

function send($chat, $message) 
{
    $params = [
        'chat_id'   => $chat,
        'text'      => $message,
    ];
    
    return call('sendMessage', $params);
}
