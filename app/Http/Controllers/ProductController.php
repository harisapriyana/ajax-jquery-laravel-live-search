<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $products = Product::orderBy('name', 'asc')->paginate(5);
        if ($request->ajax()) {
            
            return view('product/fetchproducts', compact('products'))->render();
        }
    }

    public function search(Request $request){
        if($request->ajax()){
            $query = $request->post('query');
            if($query != ''){
                $products = Product::orderBy('name', 'asc')
                        ->where('name','like','%' . $query . '%')
                        ->orWhere('detail','like','%' . $query . '%')
                        ->orWhere('stock','like','%' . $query . '%')
                        ->orWhere('price','like','%' . $query . '%')
                        ->paginate(20);
            } else {
                $products = Product::orderBy('name', 'asc')->paginate(5);
            }
            return view('product/fetchproducts', compact('products'))->render();
        }

        // $output = '';
        // $totalRow = $products->count();
        // if($totalRow > 0 ){
        //     return response()->json([
        //         'status' => 200,
        //         'totalData' => $totalRow,
        //         'products' => $products
        //         ])->render();
        // } else {
        //     return response()->json([
        //         'status' => 404,
        //         'totalData' => $totalRow,
        //         'message' => 'No Data Found'
        //     ]);
        // }
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
        $validator = Validator::make($request->all(),[
                        'name' => 'required|max:255',
                        'slug' => 'required',
                        'detail' => 'required',
                        'stock' => 'required',
                        'price' => 'required',
        ]);
                    
        if($validator->fails()){
            return response()->json([
            'status' => 400,
            'errors' =>$validator->messages()
            ]);
        } else {
            $product = new Product;
            $product->name = $request->input('name');
            $product->slug = $request->input('slug');
            $product->detail = $request->input('detail');
            $product->stock = $request->input('stock');
            $product->price = $request->input('price');
            $product->save();
            return response()->json([
            'status' =>200,
            'message' => 'New Product added successfully'
            ]);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $product = Product::findOrFail($id);
        if($product){
            return response()->json([
                'status' => 200,
                'product' => $product
            ]);
        } else {
            return response()->json([
                'status' => 404,
                'message' => 'Product not found'
            ]);
        }
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
        $validator = Validator::make($request->all(),[
            'name' => 'required|max:255',
            'slug' => 'required',
            'detail' => 'required',
            'stock' => 'required',
            'price' => 'required',
        ]);
                
        if($validator->fails()){
            return response()->json([
            'status' => 400,
            'errors' =>$validator->messages()
            ]);
        } else {
            $product = Product::findOrFail($id);
            if($product){
                $product->name = $request->input('name');
                $product->slug = $request->input('slug');
                $product->detail = $request->input('detail');
                $product->stock = $request->input('stock');
                $product->price = $request->input('price');
                $product->update();
                return response()->json([
                'status' =>200,
                'message' => 'Product Updated successfully'
                ]);
            } else {
                return response()->json([
                    'status' => 404,
                    'message' => 'Product not found'
                ]);
            }
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $product = Product::findOrFail($id);
        $product->delete();
        return response()->json([
            'status' =>200,
            'message' => 'Product Deleted successfully'
        ]);
    }
}
