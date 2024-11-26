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
use App\Models\Comment;
use App\Models\Stock;
use DB;
use App\Mail\PushMail;
use Illuminate\Support\Facades\Mail;
class UserController extends Controller
{
    public function home() {
        $posts = DB::table('posts')
    ->where('posts.status', 1)
    ->select('posts.*', DB::raw('SUBSTRING(posts.description, 1, 200) as short_description'))
    ->get();
        return view('user.home')->with('posts', $posts);
    }

    public function about () {
        return view('about');
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

    public function productDetail($branch_id, $id) {
        //$branchs = User::where("role_id", 2)->get();
        $product = DB::table('products')
            ->join('categories', 'products.category_id', '=', 'categories.id')// joining the contacts table , where user_id and contact_user_id are same
            ->where('products.status', 1)
            ->where('products.id', $id)
            ->select('products.*', 'categories.name as categoryName')
            ->get()->first();
        
            $comment_count = DB::table('comments')
            ->select(DB::raw('COUNT(comments.id) as comment_count'))
            ->where('comments.product_id', $id)
            ->get()->first();
            $comments = DB::table('comments')
            ->join('users', 'users.id', '=', 'comments.user_id')
            ->select('comments.*', 'users.username as username')
            ->where('comments.product_id', $id)
            ->get();
        return view('user.product_detail')->with("product", $product)->with("branchId", $branch_id)->with('comment', $comment_count)->with('comments', $comments);
    }

    public function addToCard(Request $request) {
        $productId = $request->product_id;
        $branchId = $request->branch_id;
        $count = $request->count;
        $stock = Stock::where('branch_id', $branchId)
              ->where('product_id', $productId)
              ->first();
        if($stock->stock_level < $count) {
            return back()->with('error', 'Sorry! Your item count exceed the our stock level. The maximun amount you can order is '+ $stock->stock_level);
        }

        $userId = auth()->user()->id;
        
        $count = $request->count;
        $post = Card::create([
            'product_id' => $productId,
            'branch_id' => $branchId,
            'user_id' => $userId,
            'count' => $count
        ]);
        return back()->with('success', 'Item have been successfully added.');
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

            $stock = Stock::where('branch_id', $branchId)
              ->where('product_id', $product['id'])
              ->first();
              $new_stock = $stock->stock_level - $product['quantity'];
              $stock->stock_level = $new_stock;
              $stock->save();
        }
        DB::table('cards')->where('user_id', '=', $userId)->delete();
        $title = 'You have new order placement';
        $body = 'Please check order request of your branch. you have new order placement in your branch!';
        $user = User::find($branchId);
        $details = [
            'title' => $title,
            'message' => $body
        ];
        
        Mail::to($user->email)->send(new PushMail($details));
        return redirect('/orders')->with('success', 'Your order have been placed successfully.');
    }

    public function orderList() {
        $id = auth()->user()->id;
        $orders = DB::table('orders')
        ->join('users', 'users.id', '=', 'orders.user_id')
        ->leftJoin('order_items', 'orders.id', '=', 'order_items.order_id')
        ->select('orders.*', 'users.username', DB::raw('COUNT(order_items.id) as itemCount'))
        ->where('orders.user_id', $id)
        ->groupBy('orders.id', 'users.username')
        ->get();
    
        //dd($orders);
        return view('user.order_list')->with('orders', $orders);
    }

    public function orderDetail($id) {
        $user_id = auth()->user()->id;
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
        return view("user.order_detail")->with("order", $orderDetail[0])->with('order_items', $order_items)->with("item_count", $item_count[0]);
    }

    public function comment(Request $request) {
        //dd($request);
        $user_id = auth()->user()->id;
        $order = Comment::create([
            'user_id' => $user_id,
            'product_id' => $request->product_id,
            'comment' => $request->comment,
            'status' => 1,
        ]);
        return back()->with('success', 'Comment have been successfully saved.');
    }
}
