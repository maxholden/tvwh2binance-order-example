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
    'binance_base_url' => 'https://fapi.binance.com/fapi/v1',
    // open order quantity
    // How much to open order (if you change to 0.1, then it will open order for 0.1 USDT)
    // but usually the minimum amount to open an order is 5-10 USDT
    // If a value is passed in the alert, it will be used instead of this
    // На какую сумму открывать ордер (если меняешь на 0.1, то будет открывать ордер на 0.1 USDT)
    // но обычно минимальная сумма для открытия ордера - 5-10 USDT
    // Если будет передано значение в алерте, то оно будет использовано вместо этого
    'order_quantity' => 5,
];
