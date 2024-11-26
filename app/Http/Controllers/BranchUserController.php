<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Stock;
use App\Models\Product;
use App\Models\Order;
use DB;
use App\Models\User;
use Carbon\Carbon;
use App\Mail\PushMail;
use Illuminate\Support\Facades\Mail;

class BranchUserController extends Controller
{
    public function dashboard(Request $request) {
        $startDate = $request->input('start_date') ? $request->input('start_date') : Carbon::now()->startOfMonth()->toDateString();
        $endDate = $request->input('end_date') ? $request->input('end_date') : Carbon::now()->endOfMonth()->toDateString();
        $branchId = auth()->user()->id;
        $salesReport = DB::table('order_items')
        ->join('products', 'order_items.product_id', '=', 'products.id')
        ->join('orders', 'order_items.order_id', '=', 'orders.id')
        ->whereBetween('orders.created_at', [$startDate, $endDate])
        ->where('orders.branch_id', $branchId)
        ->where('orders.status', 4)
        ->select('products.name', DB::raw('SUM(order_items.count) as total_quantity'), DB::raw('SUM(order_items.price * order_items.count) as total_sales'))
        ->groupBy('products.name')
        ->get();
        //dd($salesReport);
        
        $productsNotOrdered = DB::table('stocks')
    ->join('products', 'stocks.product_id', '=', 'products.id')
    ->where('stocks.branch_id', $branchId)
    ->select('products.name', 'stocks.stock_level as stock_quantity')
    ->groupBy('products.name', 'stocks.stock_level')
    ->get();
    // Example criteria to exclude specific product names
 // Example product names to exclude
$excludedProducts = $salesReport->pluck('name');
$excludedProducts = $excludedProducts->toArray();
$productsNotOrdered = $productsNotOrdered->reject(function ($product) use ($excludedProducts) {
    return in_array($product->name, $excludedProducts);
});
    //dd($productsNotOrdered);


        return view('branch_user.dashboard')->with("saleReport", $salesReport)->with("productNotOrder", $productsNotOrdered);
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
        //dd($request);
        Stock::where("id", $request->id)->first()->update(array('request_count'=>$request->requestStock));
        $title = 'You have new stock request';
        $body = 'Please check stock request from your branch. you have new stock request from your branch!';
        $user = User::find(5);
        $details = [
            'title' => $title,
            'message' => $body
        ];
    
        Mail::to($user->email)->send(new PushMail($details));
        return redirect('/branch-user/stock/')->with('success','Stock has been requested successfully.');
    }

    public function orders() {
        $id = auth()->user()->id;
        $orders = DB::table('orders')
        ->join('users', 'users.id', '=', 'orders.user_id')
        ->select('orders.*', 'users.username')
        ->where('orders.branch_id', $id)
        ->get();
        return view("branch_user.order")->with("orders", $orders);
    }

    public function orderDetail($id) {
        $branch_id = auth()->user()->id;
        $orderDetail = DB::table('orders')
        ->join('users', 'users.id', '=', 'orders.user_id')
        ->leftjoin('order_items', 'orders.id', '=', 'order_items.order_id')
        ->select('orders.*', 'orders.status as orderStatus','users.username', 'users.address','users.phone', 'order_items.*')
        ->where('orders.id', $id)
        ->get();

        $order_items = DB::table('order_items')
        ->leftjoin('products', 'products.id', '=', 'order_items.product_id')
        ->join('categories', 'categories.id', '=', 'products.category_id')
        ->select('order_items.*', 'products.name','products.image','products.description','categories.name as category',
        DB::raw('products.price * order_items.count as price'))
        ->where('order_items.order_id', $id)
        ->get();

        $item_count = DB::table('order_items')
        ->select(DB::raw('COUNT(order_items.id) as item_count'))
        ->where('order_items.order_id', $id)
        ->get();
        //dd($orderDetail[0]);
        //dd($item_count[0]);
        return view("branch_user.order_detail")->with("order", $orderDetail[0])->with('order_items', $order_items)->with("item_count", $item_count[0]);
    }

    public function updateOrder(Request $request) {
        //dd($request);
        Order::where("id", $request->orderId)->first()->update(array('status'=>$request->status));
        return redirect('/branch-user/order')->with('success','Order status has been updated successfully.');
    }

    public function salesReport(Request $request) {
        $startDate = $request->input('start_date');
        $endDate = $request->input('end_date');
        $salesReport = DB::table('order_items')
        ->join('products', 'order_items.product_id', '=', 'products.id')
        ->join('orders', 'order_items.order_id', '=', 'orders.id')
        ->whereBetween('orders.created_at', [$startDate, $endDate])
        ->select('products.name', DB::raw('SUM(order_items.count) as total_quantity'), DB::raw('SUM(order_items.price * order_items.count) as total_sales'))
        ->groupBy('products.name')
        ->get();

        return view('sales_report', ['salesReport' => $salesReport]);
    }
}
