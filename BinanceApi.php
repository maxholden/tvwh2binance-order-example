<?php

class BinanceApi
{

    public string $apiKey;
        public string $secretKey;
        public string $apiBaseUrl;

    public function __construct(
        string $apiKey,
        string $secretKey,
        string $apiBaseUrl
    )
    {
        $this->apiKey = $apiKey;
        $this->secretKey = $secretKey;
        $this->apiBaseUrl = $apiBaseUrl;
    }

    public function openMarketOrder(string $symbol, string $side, float $quantity)
    {
        //$timestamp = $this->getTimestamp();
        $markPriceInfo = $this->getMarkPriceInfo($symbol);
        $markPrice = $markPriceInfo['markPrice'];
        $timestamp = $markPriceInfo['time'];

        // calculate quantity based on mark price
        $quantityInSymbol = round($quantity / $markPrice);
        // In case if price is greater than quantity, increase precision
        $precision = 1;
        while ($quantityInSymbol == 0) {
            $precision++;
            $quantityInSymbol = round($quantity / $markPrice, $precision);
        }

        echo 'markPrice: ' . $markPrice . PHP_EOL;
        echo 'quantity in USDT: ' . $quantity . PHP_EOL;
        echo 'quantity in SYMBOL: ' . $quantityInSymbol . PHP_EOL;

        $url = '/order';
        $params = [
            'symbol' => $symbol,
            'side' => $side === PositionSidesEnum::SHORT ? SidesEnum::SELL : SidesEnum::BUY,
            'type' => 'MARKET',
            'positionSide' => $side,
            'quantity' => $quantityInSymbol,
            'timestamp' => $timestamp,
        ];
        $params['signature'] = $this->getSignature($params);
        return $this->sendRequest('POST', $url, $params);
    }

    public function sendRequest(string $method, string $url, array $params = []): ?array
    {
        $curl = curl_init();
        $curlParams = [
            CURLOPT_URL => $this->apiBaseUrl . $url . '?' . http_build_query($params),
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_HTTPHEADER => [
                'X-MBX-APIKEY: ' . $this->apiKey,
            ],
        ];
        if($method === 'POST') {
            $curlParams[CURLOPT_POST] = true;
        }
        curl_setopt_array($curl, $curlParams);
        $response = curl_exec($curl);
        curl_close($curl);
        return json_decode($response, true);
    }

    private function getTimestamp(): int
    {
        $url = '/time';
        $response = $this->sendRequest('GET', $url);
        return $response['serverTime'];
    }

    private function getSignature(array $request_data): string
    {
        $query = http_build_query($request_data);
        return hash_hmac('sha256', $query, $this->secretKey);
    }

    public function getMarkPriceInfo(string $symbol): ?array
    {
        $url = '/premiumIndex';
        $params = [
            'symbol' => $symbol,
        ];

        return  $this->sendRequest('GET', $url, $params);
    }


}
