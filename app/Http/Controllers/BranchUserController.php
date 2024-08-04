<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Stock;
use App\Models\Product;
use DB;

class BranchUserController extends Controller
{
    public function dashboard() {
        return view('branch_user.dashboard');
    }

    public function stock() {
        $id = auth()->user()->id;
        $stocks = DB::table('stocks')
        ->join('products', 'stocks.product_id', '=', 'products.id')
        ->join('categories', 'products.category_id', '=', 'categories.id')
        ->select('stocks.*', 'products.name as product_name', 'categories.name as category_name')
        ->where('stocks.branch_id', $id)
        ->get();
        //dd($stocks);
        return view('branch_user.stock')->with('stocks', $stocks);
    }

    public function requestStock(Request $request) {
        Stock::where("id", $request->id)->first()->update(array('request_count'=>$request->requestStock));
        return redirect('/branch-user/stock/')->with('success','Stock has been requested successfully.');
    }

}
