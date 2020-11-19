<?php

include_once '../bootstrap/start.php';


function login()
{

    $email = 'jose@josemalcher.net';
    $pass = '123456';

    $curl = curl_init();

    curl_setopt_array($curl, [
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_CUSTOMREQUEST => 'POST',
        CURLOPT_POSTFIELDS => [
            'email' => $email,
            'password' => $pass
        ],
        CURLOPT_URL => 'http://127.0.0.1:8000/api/V1/auth'
    ]);

    $response = json_decode(curl_exec($curl));
    curl_close($curl);

    return $response->token;
}

function products($token)
{
    $curl = curl_init();

    curl_setopt_array($curl, [
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_CUSTOMREQUEST => 'GET',
        CURLOPT_URL => 'http://127.0.0.1:8000/api/V1/products',
        CURLOPT_HTTPHEADER => [
            "Authorization: Bearer {$token}"
        ]
    ]);

    $response = json_decode(curl_exec($curl));
    curl_close($curl);

    return $response;
}

$token = login();
$produtos = products($token);

if (isset($produtos->data) && count($produtos->data) > 0) {
    $produtos = $produtos->data;
    foreach ($produtos->data as $produto) {
        echo "<p>Nome: {$produto->name}</p>";
        echo "<p>Descrição: {$produto->description}</p>";
        echo "<hr>";
    }
}
