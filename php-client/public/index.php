<?php

include_once '../bootstrap/start.php';

login();


function login(){

    $email = 'jose@josemalcher.net';
    $pass = '123456';

    $curl = curl_init();

    curl_setopt_array($curl, [
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_CUSTOMREQUEST => 'POST',
        CURLOPT_POSTFIELDS => [
            'email'=> $email,
            'password'=> $pass
        ],
        CURLOPT_URL => 'http://127.0.0.1:8000/api/V1/auth'
    ]);

    $response = json_decode(curl_exec($curl));
    curl_close($curl);

    return $response->token;

}