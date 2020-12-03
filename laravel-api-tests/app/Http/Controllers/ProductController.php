<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\AuthApi;
use GuzzleHttp\Client as Guzzle;
use GuzzleHttp\Exception\RequestException;

class ProductController extends Controller
{
    private $token;
    /**
     * ProductController constructor.
     */
    public function __construct()
    {
        $auth = new AuthApi();
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
        $result = $guzzle->get(env('URL_API').'products',[
            'headers' => [
                'Authorization' => "Bearer {$this->token}",
            ]
        ]);

        $products = json_decode($result->getBOdy())->data;

        $title = "Listagem Dinâmica dos produtos";

        return view('tests-api.produtos.index', compact('products', 'title'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $title = "Cadastrar Novo Produto no Web Service";
        return view('tests-api.produtos.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //dd($request->all());
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
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function paginate($page)
    {
        $guzzle = new Guzzle;
        $result = $guzzle->get(env('URL_API')."products?page={$page}",[
            'headers' => [
                'Authorization' => "Bearer {$this->token}",
            ]
        ]);

        $products = json_decode($result->getBOdy())->data;

        $title = "Listagem Dinâmica dos produtos";

        return view('tests-api.produtos.index', compact('products', 'title'));
    }
}
