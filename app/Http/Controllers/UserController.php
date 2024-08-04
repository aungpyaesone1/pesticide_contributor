<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Card;
use App\Models\Product;
use App\Models\User;
use App\Models\Branch;
use App\Models\Township;
use App\Models\Post;
use App\Models\Order;
use App\Models\OrderItem;
use DB;
class UserController extends Controller
{
    public function home() {
        $posts = DB::table('posts')
    ->where('posts.status', 1)
    ->select('posts.*', DB::raw('SUBSTRING(posts.description, 1, 200) as short_description'))
    ->get();
        return view('user.home')->with('posts', $posts);
    }

    public function postDetail($id) {
        $post = Post::find($id);
        return view('user.post_detail')->with('post', $post);
    }

    public function branch(Request $request) {
        $searchTerm = "%".$request->keyword."%";
        if($request->township == null || $request->township == 'all') {
            $branchs = DB::table('users')
            ->join('cities', 'users.city_id', '=', 'cities.id')// joining the contacts table , where user_id and contact_user_id are same
            ->join('townships', 'users.township_id', '=', 'townships.id')
            ->where('status', 1)
            ->where('role_id', 2)
            ->where('users.username', 'like', $searchTerm) 
            ->select('users.*', 'cities.name as cityName', 'townships.name as townshipName')
            ->get();
        }
        else {
            $branchs = DB::table('users')
            ->join('cities', 'users.city_id', '=', 'cities.id')// joining the contacts table , where user_id and contact_user_id are same
            ->join('townships', 'users.township_id', '=', 'townships.id')
            ->where('status', 1)
            ->where('role_id', 2)
            ->where('users.username', 'like', $searchTerm) 
            ->where('townships.id', $request->township)
            ->select('users.*', 'cities.name as cityName', 'townships.name as townshipName')
            ->get();
        }
        //$branchs = User::where("role_id", 2)->get();
        
        
        $townships = Township::all();
        //dd($branchs);
        return view('user.branch')->with("branchs", $branchs)->with("townships", $townships);
    }

    public function branchDetail($id) {
        //$branchs = User::where("role_id", 2)->get();
        $branch = DB::table('users')
            ->join('cities', 'users.city_id', '=', 'cities.id')// joining the contacts table , where user_id and contact_user_id are same
            ->join('townships', 'users.township_id', '=', 'townships.id')
            ->where('status', 1)
            ->where('role_id', 2)
            ->where('users.id', $id)
            ->select('users.*', 'cities.name as cityName', 'townships.name as townshipName')
            ->get();
        $products = DB::table('stocks')
            ->join('products', 'stocks.product_id', '=', 'products.id')// joining the contacts table , where user_id and contact_user_id are same
            ->where('stocks.branch_id', $id)
            ->select('stocks.stock_level', 'products.*', DB::raw('SUBSTRING(products.description, 1, 200) as short_description'))
            ->get();
        //dd($branch);
        return view('user.branch_detail')->with("branch", $branch[0])->with("products", $products);
    }

    public function addToCard(Request $request) {
        
        $productId = $request->product_id;
        $branchId = $request->branch_id;
        $userId = auth()->user()->id;
        
        $count = $request->count;
        $post = Card::create([
            'product_id' => $productId,
            'branch_id' => $branchId,
            'user_id' => $userId,
            'count' => 1
        ]);
        return back()->withErrors([
            'success' => 'Item have been successfully added.',
        ]);
    }

    public function cards() {
        //select card joining with product, branch, where userid= 1
        $userId = auth()->user()->id;
        $branchId = "";
        $cards = DB::table('cards')
            ->join('products', 'cards.product_id', '=', 'products.id')// joining the contacts table , where user_id and contact_user_id are same
            ->join('users', 'users.id', '=', 'cards.branch_id')
            ->where('cards.user_id', $userId)
            ->select('products.id', 'products.name','products.price','products.image','users.username as branchName', 'cards.count', 'cards.branch_id as branch_id',
            DB::raw('products.price * cards.count as total_price'))
            ->get();
        $total = 0;
        foreach($cards as $card) {
            $branchId = $card->branch_id;
            $total = $total + $card->total_price;
        }
        return view('user.shopping_card')->with('cards', $cards)->with('total', $total)->with('branch_id', $branchId);
    }

    public function removeItem($id) {
        DB::table('cards')->where('id', '=', $id)->delete();
        return redirect('/cards')->with('success', 'Item have been deleted successfully');
    }

    public function checkOut(Request $request) {
        //dd($request);
        $userId = auth()->user()->id;
        $branchId = $request->branch_id;
        $totalPrice = $request->total_price;
        $order = Order::create([
            'user_id' => $userId,
            'branch_id' => $branchId,
            'total_price' => $totalPrice,
            'status' => 1
        ]);
        $products = $request->products;
        foreach($products as $product) {
            OrderItem::create([
                'order_id' => $order->id,
                'product_id' => $product['id'],
                'count' => $product['quantity'],
                'price' => $product['price'],
                'status' => 1
            ]);
        }
        return view('user.order_list');
    }

    public function orderList() {
        return view('user.order_list');
    }
}
