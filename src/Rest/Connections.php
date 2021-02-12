<?php
namespace UbexPay\Rest;

class Connections
{
    /**
     * Makes the API request
     * @param string $url  Request url
     * @param string $method Request method POST or GET
     * @param mixed  $payload Request Body
     * @param mixed  $headers|null Request Headers
     *
     * @return mixed Server response
     */
    public function execute($url, $method, $payload, $headers = null) {
        $ch = curl_init();

        curl_setopt_array($ch, array(
            CURLOPT_URL            => $url,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_FOLLOWLOCATION => true,
        ));

        if (strtoupper($method) == "POST") {
            curl_setopt($ch, CURLOPT_POST, true);
            curl_setopt($ch, CURLOPT_POSTFIELDS, $payload);
        }
        if ($headers != null) {
            curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        }

        $result = curl_exec($ch);
        curl_close($ch);
        return $result;
    }
}
