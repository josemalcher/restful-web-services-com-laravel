<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use GuzzleHttp\Client as Guzzle;
use GuzzleHttp\Exception\RequestException;
use App\Models\AuthApi;

class ProductController extends Controller
{
    private $token;


    public function __construct()
    {
        $auth = new AuthApi;
        $this->token = $auth->getToken();
    }
    
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $guzzle = new Guzzle;
        
        $result = $guzzle->get(env('URL_API').'products', [
            'headers' => [
                'Authorization' => "Bearer {$this->token}",
            ]
        ]);
                
        $products = json_decode($result->getBody())->data;
        
        $title = 'Listagem dinâmica dos produtos!';
        
        return view('tests-api.products.index', compact('products', 'title'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $title = 'Cadastrar Novo Produto no Web Service';
        
        return view('tests-api.products.create', compact('title'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $dataForm = $request->except('_token');
        
        $guzzle = new Guzzle;
        
        $result = $guzzle->request('POST', env('URL_API').'products', [
            'headers' => [
                'Authorization' => "Bearer {$this->token}",
            ],
            'form_params' => $dataForm,
        ]);
                
        return redirect()
                ->route('products.index')
                ->with('success', 'Cadastro realizado com sucesso!');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $guzzle = new Guzzle;
        
        $result = $guzzle->request('GET', env('URL_API')."products/{$id}", [
            'headers' => [
                'Authorization' => "Bearer {$this->token}",
            ],
        ]);
                
        $product = json_decode($result->getBody())->data;
        
        $title = "Detalhes Produto: {$product->name}";
        
        return view('tests-api.products.show', compact('title', 'product'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $guzzle = new Guzzle;
        
        $result = $guzzle->request('GET', env('URL_API')."products/{$id}", [
            'headers' => [
                'Authorization' => "Bearer {$this->token}",
            ],
        ]);
                
        $product = json_decode($result->getBody())->data;
        
        $title = "Editar Produto: {$product->name}";
        
        return view('tests-api.products.edit', compact('title', 'product'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $dataForm = $request->except('_token');
        
        $guzzle = new Guzzle;
        
        $result = $guzzle->request('PUT', env('URL_API')."products/{$id}", [
            'headers' => [
                'Authorization' => "Bearer {$this->token}",
            ],
            'form_params' => $dataForm,
        ]);
                
        return redirect()
                ->route('products.index')
                ->with('success', 'Dados Alterados com sucesso!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $guzzle = new Guzzle;
        
        $result = $guzzle->request('DELETE', env('URL_API')."products/{$id}", [
            'headers' => [
                'Authorization' => "Bearer {$this->token}",
            ],
        ]);
                
        return redirect()
                ->route('products.index')
                ->with('success', 'Produto deletado com sucesso!');
    }
    
    public function paginate($page)
    {
        $guzzle = new Guzzle;
        
        $result = $guzzle->get(env('URL_API')."products?page={$page}", [
            'headers' => [
                'Authorization' => "Bearer {$this->token}",
            ]
        ]);
                
        $products = json_decode($result->getBody())->data;
        
        $title = 'Listagem dinâmica dos produtos!';
        
        return view('tests-api.products.index', compact('products', 'title'));
    }
}
