<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Review;
use App\Models\Transaction;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class TransactionController extends Controller
{
    public function index() {
        $transactions = DB::table('transactions')
                            ->leftJoin('users', 'transactions.user_id', '=', 'users.id')
                            ->leftJoin('products', 'transactions.product_id', '=', 'products.id')
                            ->select('transactions.*', 'users.name as user_name', 'products.name as product_name', 'products.image as product_image')
                            ->get();

        return view('transactionAdmin', ['transactions' => $transactions]);
    }

    public function show($id) {
        $transactions = DB::table('transactions')
                        ->leftJoin('users', 'transactions.user_id', '=', 'users.id')
                        ->leftJoin('products', 'transactions.product_id', '=', 'products.id')
                        ->select('transactions.*', 'users.name as user_name', 'products.name as product_name', 'products.image as product_image')
                        ->where('transactions.user_id', '=', $id)
                        ->get();

        return view('transactionUser', ['transactions' => $transactions]);
    }

    public function store(Request $request, $product_id) {
        $transaction = new Transaction();
        $transaction->quantity = $request->quantity;
        $transaction->address = $request->address;
        $transaction->price = $request->price;
        $transaction->shipping_option = $request->shipping_option;
        $transaction->payment_option = $request->payment_option;
        $transaction->product_id = $product_id;
        $transaction->user_id = session('user_id');
        $transaction->status = 'pending';
        
        $transaction->save();

        return redirect('/transactions/users/' . session('user_id'))->with('success', 'Berhasil menambahkan transaksi');
    }
    
    public function uploadPaymentProof(Request $request, $id) {
        $transaction = Transaction::findOrFail($id);
        
        $image = time(). '_PP.' .$request->file('gambar')->extension();
        
        $request->merge([
            'image' => $image
        ]);
        $request->gambar->move(public_path('assets'), $image);
        
        $transaction->payment_proof = $request->image;
        $transaction->status = 'check';
        $transaction->save();
        
        
        return redirect('/transactions/users/' . session('user_id'))->with('success', 'Berhasil mengupload bukti transaksi');
    }
    
    public function check($id, $product_id) {
        $transaction = Transaction::findOrFail($id);
        $product = Product::findOrFail($product_id);
        
        $transaction->status = 'paid';        
        $transaction->save();
        
        $product->stock = $product->stock - $transaction->quantity;
        $product->sold = $product->sold + $transaction->quantity;
        $product->save();

        return redirect('/transactions')->with('success', 'Berhasil menerima transaksi');
    }

    public function cancel($id) {
        $transaction = Transaction::findOrFail($id);

        $transaction->status = 'cancelled';

        $transaction->save();

        return redirect('/transactions')->with('success', 'Berhasil menolak transaksi');
    }

    public function process($id) {
        $transaction = Transaction::findOrFail($id);

        $transaction->status = 'process';

        $transaction->save();

        return redirect('/transactions')->with('success', 'Berhasil memproses transaksi');
    }

    public function deliver($id) {
        $transaction = Transaction::findOrFail($id);

        $transaction->status = 'delivering';

        $transaction->save();

        return redirect('/transactions')->with('success', 'Berhasil mengubah status transaksi');
    }

    public function delivered($id) {
        $transaction = Transaction::findOrFail($id);

        $transaction->status = 'delivered';

        $transaction->save();

        return redirect('/transactions/users/' . session('user_id'))->with('success', 'Berhasil mengubah status transaksi');
    }

    public function rating(Request $request, $id, $product_id) {
        $review = new Review();
        $review->review_text = $request->review_text;
        $review->rate = $request->rate;
        $review->product_id = $product_id;
        $review->user_id = session('user_id');
        $review->transaction_id = $id;
        $review->save();

        $transaction = Transaction::findOrFail($id);
        $transaction->status = 'done';
        $transaction->save();

        $total_rate = DB::table('reviews')->where('product_id', '=', $product_id)->sum('rate');
        $count = DB::table('reviews')->where('product_id', '=', $product_id)->count();
        
        $product = Product::findOrFail($product_id);
        $product->rate = $total_rate / $count;
        $product->save();

        return redirect('/transactions/users/' . session('user_id'))->with('success', 'Berhasil memberi ulasan pada transaksi');
    }

    public function destroy($id) {
        $transaction = Transaction::findOrFail($id);
        $transaction->delete();

        return redirect('/transactions/users/' . session('user_id'))->with('success', 'Berhasil menghapus transaksi');
    }
}
