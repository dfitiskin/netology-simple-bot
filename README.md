# Simple Telegram Bot implementation

[Telegram](https://telegram.org) Bot written on php via lets-code session at [Netology Online University](http://netology.ru/). Beginners guide.

## Requirements

1. PHP 5.5
2. HTTPS public web-server (only for web-hook)

## Configuration

1. Create a Bot messaging with [@BotFather](https://telegram.me/botfather)
2. Send command `/newbot`, and follow instructions. 
3. Retrive token
4. Set token as enviroment variable `BOT_TOKEN`
5. Set base url as enviroment variable `BOT_HOOK_BASE` (only for web-hook)

## Usage

### Testing

```bash
#!bash
$ php -f bot.php
```

### Get and process updates

```bash
#!bash
$ php -f updates.php
```

### Process your own commands

Open `update.php`, find function `processCommand`, and add `case-break` statement:

```php
#!php
case '/mycommand':
    send($chat, 'Arrr!');
    break;
```

### Process all messages

Open `update.php`, find function `process`, and replace this `echo-bot` code block:

```php
#!php

$chat = $message['chat']['id'];
$user = $message['from']['first_name'];
$text = $message['text'];
echo 'Message from ' . $user . '. Text: ' . $text . PHP_EOL;

send($chat, $text);
```
