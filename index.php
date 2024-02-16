<?php
function getCityByIP($ip)
{
    $apiKey = 'YOUR_API_KEY'; // Замените на ваш ключ API
    $url = "https://api.dadata.ru/v2/iplocate/address?ip=$ip";

    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_HTTPHEADER, [
        "Authorization: Token $apiKey",
        "Content-Type: application/json",
        "Accept: application/json",
    ]);

    $response = curl_exec($ch);
    curl_close($ch);

    $result = json_decode($response, true);

    if (isset($result['location']['data']['city'])) {
        return $result['location']['data']['city'];
    } else {
        return 'Город не найден';
    }
}

// Пример использования функции
$ip = $_SERVER['REMOTE_ADDR']; // Получаем IP-адрес пользователя
$city = getCityByIP($ip);
echo "Ваш город: $city";
