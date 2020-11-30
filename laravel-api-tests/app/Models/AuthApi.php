<?php

namespace App\Models;

use GuzzleHttp\Client as Guzzle;
use GuzzleHttp\Exception\RequestException;
use Illuminate\Database\Eloquent\Model;

class AuthApi extends Model
{
    private $token;

    /**
     * AuthApi constructor.
     */
    public function __construct()
    {
        $guzzle = new Guzzle;

        try {
            $response = $guzzle->request('POST', env('URL_API') . 'auth', [
                'form_params' => [
                    'email' => env('EMAIL_API'),
                    'password' => env('PASS')
                ]
            ]);

            $this->token = json_decode($response->getBody())->token;

        } catch (RequestException $e) {
            dd($e);
        }
    }

    public function getToken()
    {
        return $this->token;
    }
}
