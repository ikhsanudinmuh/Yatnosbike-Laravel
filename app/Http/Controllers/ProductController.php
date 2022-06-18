<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ProductController extends Controller
{
    public function index() {
        $bicycles = DB::table('products')
                    ->orderBy('rate', 'desc')
                    ->where('category', '=', 'sepeda')
                    ->limit(3)
                    ->get();

        $parts = DB::table('products')
                    ->orderBy('rate', 'desc')
                    ->where('category', '=', 'part')
                    ->limit(3)
                    ->get();

        $accessories = DB::table('products')
                    ->orderBy('rate', 'desc')
                    ->where('category', '=', 'aksesoris')
                    ->limit(3)
                    ->get();

        return view('index', ['bicycles' => $bicycles , 'parts' => $parts, 'accessories' => $accessories]);
    }

    public function indexBicycle() {
        $bicycles = DB::table('products')
                    ->orderBy('rate', 'desc')
                    ->where('category', '=', 'sepeda')
                    ->get();

        return view('indexBicycle', ['bicycles' => $bicycles]);
    }

    public function indexPart() {
        $parts = DB::table('products')
                    ->orderBy('rate', 'desc')
                    ->where('category', '=', 'part')
                    ->get();

        return view('indexPart', ['parts' => $parts]);
    }

    public function indexAccessories() {
        $accessories = DB::table('products')
                    ->orderBy('rate', 'desc')
                    ->where('category', '=', 'aksesoris')
                    ->get();
        
        return view('indexAccessories', ['accessories' => $accessories]);
    }

    public function search(Request $request) {
        $search = $request->search;

        $products = DB::table('products')
                ->where('name', 'like', '%'.$search.'%')
                ->orderBy('rate', 'desc')
                ->get();

        return view('indexSearch', ['products' => $products, 'search' => $search]);
    }

    public function detail($id) {
        $product = DB::table('products')
                    ->where('id', '=', $id)
                    ->first();

        $review = DB::table('reviews')
                    ->leftJoin('users', 'reviews.user_id', '=', 'users.id')
                    ->select('reviews.*', 'users.name')
                    ->where('product_id', '=', $id)
                    ->get();

        return view('productDetail', ['product' => $product, 'reviews' => $review]);
    }

    public function productManagement() {
        $products = Product::all();
        return view('productManagement', ['products' => $products]);
    }

    public function store(Request $request) {
        $data = $request->all();

        $image = time(). '_P.' .$request->file('gambar')->extension();

        $request->merge([
            'image' => $image
        ]);
        $request->gambar->move(public_path('assets'), $image);

        $product = new Product();
        $product->name = $data['name'];
        $product->image = $image;
        $product->description = $data['description'];
        $product->category = $data['category'];
        $product->price = $data['price'];
        $product->stock = $data['stock'];
        $product->save();

        return redirect('/products')->with('success', 'Berhasil menambahkan produk');
        
    }
    
    public function edit(Request $request, $id) {
        $data = $request->all();
        
        $product = Product::findOrFail($id);
        
        if ($request->hasFile('gambar')) {
            $image = time(). '_P.' .$request->file('gambar')->extension();
            
            $request->merge([
                'image' => $image
            ]);
            $request->gambar->move(public_path('assets'), $image);
            $product->image = $image;            
        }
        
        $product->name = $data['name'];
        $product->description = $data['description'];
        $product->category = $data['category'];
        $product->price = $data['price'];
        $product->stock = $data['stock'];
        $product->save();

        return redirect('/products')->with('success', 'Berhasil mengubah produk');
    }

    public function destroy($id) {
        $product = DB::table('products')
                    ->where('id', '=', $id)
                    ->delete();

        return redirect('/products')->with('success', 'Berhasil menghapus produk');

    }
}
