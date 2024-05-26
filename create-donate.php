<?php
function getAccessToken() {
    // $clientId = 'YOUR_CLIENT_ID';
    // $clientSecret = 'YOUR_CLIENT_SECRET';
    $clientId = '480046';
    $clientSecret = '5e101e1e6e2733ac434d34fb963cfd79';

    $ch = curl_init();

    curl_setopt($ch, CURLOPT_URL, "https://secure.payu.com/pl/standard/user/oauth/authorize");
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($ch, CURLOPT_POST, 1);
    curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query([
        'grant_type' => 'client_credentials',
        'client_id' => $clientId,
        'client_secret' => $clientSecret
    ]));

    curl_setopt($ch, CURLOPT_HTTPHEADER, [
        'Content-Type: application/x-www-form-urlencoded'
    ]);

    $response = curl_exec($ch);
    curl_close($ch);

    $responseData = json_decode($response, true);
    return $responseData['access_token'];
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $accessToken = getAccessToken();
    $url = 'https://secure.payu.com/api/v2_1/orders';

    $orderData = array(
        'notifyUrl' => 'https://yednist.it-volunteers.com/',
        'customerIp' => $_SERVER['REMOTE_ADDR'],
        'merchantPosId' => '480046',
        'description' => 'Donation',
        'currencyCode' => 'PLN',
        'totalAmount' => '15000',
        'extOrderId' => uniqid(),
        'validityTime' => '86400',
        'products' => array(
            array(
                'name' => 'Donation',
                'unitPrice' => '10000',
                'quantity' => '1'
            )
        ),
        'buyer' => array(
            'email' => 'john.doe@example.com',
            'phone' => '654111654',
            'firstName' => 'John',
            'lastName' => 'Doe'
        )
    );

    $ch = curl_init($url);
    curl_setopt($ch, CURLOPT_HTTPHEADER, array(
        'Content-Type: application/json',
        'Authorization: Bearer ' . $accessToken
    ));
    curl_setopt($ch, CURLOPT_POST, 1);
    curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($orderData));
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

    $response = curl_exec($ch);
    $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
    curl_close($ch);

    if ($httpCode == 302) {
        $responseJson = json_decode($response, true);
        $redirectUri = $responseJson['redirectUri'];
        header('Location: ' . $redirectUri);
        exit();
    } else {
        echo 'Error creating order: ' . $response;
    }
} else {
    echo 'Invalid request method';
}
?>