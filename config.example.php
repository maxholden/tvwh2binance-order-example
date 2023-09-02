<?php
/**
 * Here is a config of script
 * just copy this file to config.php and change the values
 * script will use config.php instead of this file
 *
 * Это конфиг скрипта
 * просто скопируй этот файл в config.php и измени значения на свои
 * скрипт будет использовать config.php вместо этого файла
 */
return [
    // Binance API key
    'binance_api_key' => 'xxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxx',
    // Binance API secret
    'binance_api_secret' => 'xxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxx',
    // binance base url
    'binance_base_url' => 'https://fapi.binance.com',
    // open order quantity
    // На какую сумму открывать ордер (если меняешь на 0.1, то будет открывать ордер на 0.1 USDT)
    // но обычно минимальная сумма для открытия ордера - 5-10 USDT
    'order_quantity' => 5,
];
