<?php

namespace App\Http\Controllers\Api;

use App\Models\Product;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\ProductResource;
use Illuminate\Support\Facades\Validator;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = Product::latest()->paginate(10);

        return new ProductResource(true, 'List Products', $data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'price' => 'required',
        ]);

        if($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        $store = Product::create([
            'name' => $request->name,
            'desc' => $request->desc,
            'price' => $request->price,
            'qty' => $request->qty
        ]);

        return new ProductResource(true, 'Data Saved', $store);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $data = Product::findOrFail($id);

        return new ProductResource(true, 'Find Product', $data);
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
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'price' => 'required',
        ]);

        if($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }
        $up = Product::findOrFail($id);
        $up->name = $request->name;
        $up->desc = $request->desc;
        $up->price = $request->price;
        $up->qty = $request->qty;
        $up->update();

        return new ProductResource(true, 'Data Updated', $up);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $del = Product::findOrFail($id);
        $del->delete();

        return new ProductResource(true, 'Data Deleted', $del);
    }
}
