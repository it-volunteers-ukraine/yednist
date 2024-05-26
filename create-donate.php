<?php
require_once($_SERVER['DOCUMENT_ROOT'] . '/wp-load.php');

function getAccessToken() {
    $clientId = get_field('oauth_protocol_-_client_id', 'options');
    $clientSecret = get_field('oauth_protocol_-_client_secret', 'options');
    
    $ch = curl_init();

    curl_setopt($ch, CURLOPT_URL, "https://secure.snd.payu.com/pl/standard/user/oauth/authorize");
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
    if (isset($responseData['access_token'])) {
        return $responseData['access_token'];
    } else {
        throw new Exception('Error getting access token: ' . $response);
    }
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    try {
        if (!isset($_POST['donation_amount']) || !is_numeric($_POST['donation_amount'])) {
            throw new Exception('Invalid donation amount');
        }

        $donationAmount = floatval($_POST['donation_amount']) * 100;
        $merchantPosId = get_field("pos_id_pos_id", "options"); 
        $accessToken = getAccessToken();
        $url = 'https://secure.snd.payu.com/api/v2_1/orders';

        $orderData = array(
            'notifyUrl' => 'https://yednist.it-volunteers.com/',
            'customerIp' => $_SERVER['REMOTE_ADDR'],
            'merchantPosId' => $merchantPosId,
            'description' => 'Donation',
            'currencyCode' => 'PLN',
            'totalAmount' => strval($donationAmount),
            'extOrderId' => uniqid(),
            'validityTime' => '86400',
            'products' => array(
                array(
                    'name' => 'Donation',
                    'unitPrice' => strval($donationAmount),
                    'quantity' => '1'
                )
            ),
            // 'buyer' => array(
            //     'email' => 'john.doe@example.com',
            //     'phone' => '654111654',
            //     'firstName' => 'John',
            //     'lastName' => 'Doe'
            // )
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
    } catch (Exception $e) {
        echo 'Error: ' . $e->getMessage();
    }
} else {
    echo 'Invalid request method';
}
?>