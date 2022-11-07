<?php

// namespace App\Http\Controllers;

// use Illuminate\Http\Request;
// use App\Models\Product;
// use Illuminate\Support\Facades\Validator;

// class ProductController_ extends Controller
// {
//     public function index(Request $request)
//     {
//         // $product = Product::all();
//         $product = Product::orderBy('name', 'asc')->paginate(5);
//         if ($request->ajax()) {
            
//             return view('product/fetchproducts')->with([
//                 'products' => $product
//             ])->render();
//         }else {
//             return view('product/fetchproducts')->with([
//                 'products' => $product
//             ]);
//         }
//     }

//     public function store(Request $request)
//     {
//         $validator = Validator::make($request->all(),[
//             'name' => 'required|max:255',
//             'slug' => 'required',
//             'detail' => 'required',
//             'stock' => 'required',
//             'price' => 'required',
//         ]);
        
//         if($validator->fails()){
//             return response()->json([
//                 'status' => 400,
//                 'errors' =>$validator->messages()
//             ]);
//         } else {
//             $product = new Product;
//             $product->name = $request->input('name');
//             $product->slug = $request->input('slug');
//             $product->detail = $request->input('detail');
//             $product->stock = $request->input('stock');
//             $product->price = $request->input('price');
//             $product->save();
//             return response()->json([
//                 'status' =>200,
//                 'message' => 'New Product added successfully'
//             ]);
//         }
//     }
// }
