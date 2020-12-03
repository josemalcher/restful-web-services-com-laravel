<?php

namespace App\Http\Controllers\API\V1;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Product;

class ProductController extends Controller
{
    private $product;
    private $totalPage = 5;
    /**
     * ProductController constructor.
     */
    public function __construct(Product $product)
    {
        $this->product = $product;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        //$products = $this->product->all();
        $products = $this->product->paginate($this->totalPage);
        return response()-> json(['data'=> $products]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
/*    public function create()
    {
        //
    }*/

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = $request->all();

        $validate = validator($data, $this->product->rules());
        if( $validate->fails() ) {
            $messages = $validate->messages();

            return response()->json(['validate.error', $messages], 422);
        }

        if( !$insert = $this->product->create($data) )
            return response()->json(['error' => 'error_insert'], 500);

        return response()->json(['data' => $insert], 201);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
//        $product = $this->product->find($id);
        //$product = $this->product->findOrFail($id);
        if(!$product = $this->product->find($id)){
            return response()->json(['data'=> 'not_found'],404);
        }
        return response()->json(['data'=> $product]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
/*    public function edit($id)
    {
        //
    }*/

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $data = $request->all();
        $validate = validator($data, $this->product->rules($id));

        if($validate->fails()){
            $messages = $validate->messages();
            return response()->json(['validate.error', $messages],422);
        }

        if(!$product = $this->product->find($id)){
            return response()->json(['data'=> 'product_not_found'],404);
        }

        if(!$update = $product->update($data)){
            return response()->json(['error'=> 'product_not_update'],500);
        }
        return response()->json(['data'=> $update],200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if(!$product = $this->product->find($id)){
            return response()->json(['data'=> 'product_not_found'],404);
        }


        if(!$delete = $product->delete()){
            return response()->json(['data'=> 'product_not_delete'],500);
        }
        return response()->json(['response'=> $delete]);

    }
    public function search(Request $request)
    {
        $data = $request->all();

        $validate = validator($data, $this->product->rulesSearch());
        if($validate->fails()){
            $messages = $validate->messages();
            return response()->json(['validate.error', $messages],422);
        }

        $products = $this->product->search($data, $this->totalPage);
        return response()->json(['data'=> $products]);
    }
}
