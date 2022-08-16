<?php
session_start();
require 'vendor/autoload.php';
require 'config.php';

use GuzzleHttp\Client;

$client = new Client([
    'timeout' => 2.0,
    'verify' => __DIR__.'/cacert.pem',
]);


// try {

    $response = $client->request('GET', 'https://accounts.google.com/.well-known/openid-configuration');
    
    $discoveryEndPoint = json_decode((string)$response->getBody());
    $tokenEndpoint = $discoveryEndPoint->token_endpoint;
    $userInfoEndpoint = $discoveryEndPoint->userinfo_endpoint;
    
    // if ($_GET['state'] == $_SESSION['state']) {

        $response = $client->request('POST', $tokenEndpoint, [
            'form_params' => [
                'code' => $_GET['code'],
                'client_id' => GOOGLE_OAUTH_ID,
                'client_secret' => SECRET,
                'redirect_uri' => 'http://localhost/OAuth/connect.php',
                'grant_type' => 'authorization_code'
                ]
            ]);
            // }
            

    $accessToken = json_decode($response->getBody())->access_token;
    // print_r($accessToken);
        
    $response = $client->request('GET', $userInfoEndpoint, [
        'headers' => [
            'Authorization' => 'Bearer '.$accessToken
        ]
    ]);

    $response = json_decode($response->getBody());

    if ($response->email_verified === true) {
        echo "
        <img src='".$response->picture."' />
        <h2> Welcome <br><mark>".$response->name."</mark> from <mark>".$response->email."</mark><h2>
        ";
        exit();
    }
    

// } catch (\GuzzleHttp\Exception\ConnectException $except) {
//     var_dump($except);
//     die();
// } catch (\GuzzleHttp\Exception\ClientException $exception) {
//     var_dump($exception);
//     die();
// }


// var_dump((string)$response->getBody());
// die();