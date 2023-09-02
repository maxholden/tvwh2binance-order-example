<?php

class BinanceApi
{

    public function __construct(
        public string $apiKey,
        public string $secretKey,
        public string $apiBaseUrl,
    )
    {
    }

    public function openMarketOrder(string $symbol, string $side, float $quantity)
    {
        $timestamp = $this->getTimestamp();
        $url = '/order';
        $params = [
            'symbol' => $symbol,
            'side' => $side === PositionSidesEnum::SHORT ? SidesEnum::SELL : SidesEnum::BUY,
            'type' => 'MARKET',
            'positionSide' => $side,
            'quantity' => $quantity,
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



}
