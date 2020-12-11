<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use GuzzleHttp\Client as Guzzle;
use GuzzleHttp\Exception\RequestException;

class AuthApi extends Model
{
    private $token;
    
    public function __construct()
    {
        $guzzle = new Guzzle;
        try{
            $response = $guzzle->request('POST', env('URL_API').'auth', [
                'form_params' => [
                    'email'      => env('EMAIL_API'),
                    'password'   => env('PASSWORD_API'),
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