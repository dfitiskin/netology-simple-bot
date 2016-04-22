<?php

require('lib.php');

function process($message) 
{
    if (isset($message['entities'])) {
        foreach ($message['entities'] as $entity) {
            if ('bot_command' !== $entity['type']) continue;
            
            $command = substr($message['text'], $entity['offset'], $entity['length']);
            return processCommand($command, $message);
        }
    }
    
    $chat = $message['chat']['id'];
    $user = $message['from']['first_name'];
    $text = $message['text'];
    echo 'Получено сообщение от ' . $user . ' с текстом: ' . $text . PHP_EOL;
    
    send($chat, $text);
}

function processCommand($cmd, $message)
{
    $chat = $message['chat']['id'];
    switch ($cmd) {
    case '/post':
        sendRandomPost($chat);
        break;
    case '/start':
        $user = $message['from']['first_name'];
        send($chat, 'Привет, ' . $user);
        break;
    case '/test':
        send($chat, 'Бот работае. Все хорошо.');
        break;
    default:
        send($chat, 'Неизвестная команда');
        break;
    }
}

function sendRandomPost($chat) 
{
    $content = file_get_contents('http://netology.ru/blog/rss.xml');
    $xml = new SimpleXMLElement($content);
    
    $post = $xml->channel->item[rand(0, count($xml->channel->item) - 1)];
    
    send($chat, 'Рекомендую прочитать заметку «' . $post->title  . '» ' .$post->link);
}

if ('cli' == php_sapi_name()) {
    
    $params = [];
    if (is_file('bot.lock')) {
        $params['offset'] = file_get_contents('bot.lock');
    }
    
    $result = call('getUpdates', $params);
} else {
    $request = file_get_contents('php://input');
    $data = json_decode($request, true);
    $result = [$data];
}


foreach ($result as $update) {
    $last = $update['update_id'];
    process($update['message']);
}

file_put_contents('bot.lock', ++$last);

echo PHP_EOL;
