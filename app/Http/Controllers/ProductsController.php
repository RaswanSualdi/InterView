<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class ProductsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $limit = $request->input("limit");
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $product = Product::create([
            "name"=> $request->name,
            "type"=> $request->type,
            "price"=> $request->price,
            "quantity" => $request->quantity,
            "uuid"=> 'TRX'.mt_rand(10000,99999).mt_rand(100,999),
        ]);

        if(!$product){
            return ResponseFormatter::error(null, "terjadi kesalahan", 400);
        }

        return ResponseFormatter::success($product, "berhasil membuat product",200);


    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($uuid)
    {
        $product = Product::where("uuid", $uuid)->firstOrFail();
        return ResponseFormatter::success($product, "sukses",200);
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
    public function update(Request $request, $uuid)
    {
        $product = Product::where("uuid", $uuid)->firstOrFail();
        $product->update([
            "name"=> $request->name,
            "type"=> $request->type,
            "price"=> $request->price,
            "quantity"=> $request->quantity,
        ]);

        return ResponseFormatter::success($product, "produk berhasil di update", 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $product = Product::find($id);
        $product->delete();

        return ResponseFormatter::success(null, "produk berhasil di hapus", 200);

    }
}
