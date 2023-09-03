== Simple TradingView Webhook handler ==
This is a simple webhook handler for TradingView alerts.
Written by request of my friend, who couldn't find anything suitable on the Internet.
Do not use it in production, it's just a simple example.

Requirements:
- php 7.4 or higher with curl extension

Installation:
- clone this repo to your server
- copy `config.php.example` to `config.php`
- change `config.php` to your needs
- create a webhook in TradingView with `https://yourdomain.com/webhook/index.php` url
- add alerts to your TradingView chart
- profit!

Это простой обработчик вебхуков для алертов TradingView.
Написан по просьбе моего друга, который не смог найти ничего подходящего в интернете.
Не используйте его в продакшене, это просто пример.

Требования:
- php 7.4 или выше с расширением curl

Установка:
- клонируйте этот репозиторий на ваш сервер
- скопируйте `config.php.example` в `config.php`
- измените `config.php` под ваши нужды
- создайте вебхук в TradingView с url `https://yourdomain.com/webhook/index.php`

== Supported alerts ==
- symbol: required symbol name
- position: required position name (LONG or SHORT)
```json
{
  "symbol": "BTCUSDT",
  "position": "SHORT"
}
```
