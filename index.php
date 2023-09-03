<?php
/**
 * TradingView Webhook to Binance order v0.1
 *
 * This is a simple script which is used to handle http request of tradingview webhook.
 * in the body of the request, there is a json string which contains the tradingview alert data.
 * this script will open a market order on binance based on the alert data.
 *
 * Это простой скрипт, который используется для обработки http-запроса веб-хука tradingview.
 * в теле запроса есть json-строка, которая содержит данные торгового сигнала tradingview.
 * этот скрипт откроет рыночный ордер на бинансе на основе данных сигнала.
 */

// load binance api
require __DIR__ . '/BinanceApi.php';
require __DIR__ . '/SidesEnum.php';
require __DIR__ . '/PositionSidesEnum.php';

// load config
$config = require __DIR__ . '/config.php';

/*
get alert data from request body
alert data is a json string, it contains the following fields:

получить данные сигнала из тела запроса
данные сигнала - это строка json, она содержит следующие поля:

{
    "symbol": "BTCUSDT",
    "position": "SHORT" // на продажу, LONG - на покупку
    "quantity": 5 // необязательно количество USDT, на которое открыть ордер
}
*/
$alertData = json_decode(file_get_contents('php://input'), true);

// Some validation
if(!$alertData) {
    die('no alert data');
}
if(!isset($alertData['symbol'])) {
    die('no symbol');
}
if(!isset($alertData['position'])) {
    die('no position');
}
if(!in_array($alertData['position'], [PositionSidesEnum::LONG, PositionSidesEnum::SHORT])) {
    die('invalid position');
}

// create binance api instance
$binanceApi = new BinanceApi(
    $config['binance_api_key'],
    $config['binance_api_secret'],
    $config['binance_base_url'],
);

// if quantity is passed in alert data, use it instead of config value
$quantity = $alertData['quantity'] ?? $config['order_quantity'];

// open market order
$result = $binanceApi->openMarketOrder(
    $alertData['symbol'],
    $alertData['position'],
    $quantity
);

echo '<pre>';
print_r($result);
