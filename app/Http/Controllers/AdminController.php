<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use DB;
use App\Models\City;
use App\Models\Township;
use App\Models\Product;
use App\Models\Category;
use App\Models\Post;
use App\Models\Stock;

class AdminController extends Controller
{
    public function dashboard() {
        return view('admin.dashboard');
    }

    public function branch() {
        //$branchs = User::where("role_id", 2)->get();
        $branchs = DB::table('users')
            ->join('cities', 'users.city_id', '=', 'cities.id')// joining the contacts table , where user_id and contact_user_id are same
            ->join('townships', 'users.township_id', '=', 'townships.id')
            ->where('status', 1)
            ->where('role_id', 2)
            ->select('users.*', 'cities.name as cityName', 'townships.name as townshipName')
            ->get();

        //dd($branchs);
        return view('branch.branch')->with("branchs", $branchs);
    }

    public function createBranch() {
        $citys = City::all();
        $townships = Township::all();
        return view('branch.create_branch')->with("citys", $citys)->with("townships", $townships);
    }

    public function getBranch($id) {
        $branch = User::find($id);
        $citys = City::all();
        $townships = Township::all();
        return view('branch.update_branch')->with("branch", $branch)->with("citys", $citys)->with("townships", $townships);
    }

    public function product(){
        $products = DB::table('products')
            ->join('categories', 'products.category_id', '=', 'categories.id')// joining the contacts table , where user_id and contact_user_id are same
            ->where('products.status', 1)
            ->select('products.*', 'categories.name as categoryName')
            ->get();
        return view('product.product')->with('products', $products);
    }

    public function createProduct() {
        $categories = Category::all();
        return view('product.create_product')->with('categories', $categories);
    }

    public function getProduct($id) {
        $categories = Category::all();
        $product = Product::find($id);
        return view('product.update_product')->with('product', $product)->with('categories', $categories);
    }

    public function post() {
        $posts = DB::table('posts')
        ->where('posts.status', 1)
        ->select('posts.*')
        ->get();
        return view('post.post')->with('posts', $posts);
    }

    public function createPost() {
        return view('post.create_post');
    }

    public function getPost($id) {
        $post = Post::find($id);
        return view('post.update_post')->with('post', $post);
    }

    public function stock() {
        $stocks = DB::table('stocks')
                    ->join('users', 'users.id', '=', 'stocks.branch_id')
                    ->select('users.id','users.username', DB::raw('COUNT(*) as productCount'), DB::raw('COUNT(CASE WHEN stocks.request_count != 0 THEN 1 END) as requestCount'))
                    ->groupBy('stocks.branch_id')
                    ->get();
        return view('admin.stock_list')->with("stocks", $stocks);
    }

    public function manageStock($id) {
        $stocks = DB::table('stocks')
        ->join('products', 'stocks.product_id', '=', 'products.id')
        ->join('categories', 'products.category_id', '=', 'categories.id')
        ->select('stocks.*', 'products.name as product_name', 'categories.name as category_name')
        ->where('stocks.branch_id', $id)
        ->get();
        $productNot = [];
        foreach($stocks as $stock) {
            $productNot[] = $stock->product_id;
        }
        //$products = Product::all();

        $products = DB::table('products')
        ->whereNotIn('id', $productNot)
        ->select('products.*')
        ->get();
        $branch = User::find($id);
        
        //dd($stocks);
        return view('admin.manage_stock')->with('options', $products)->with('branch', $branch)->with('stocks', $stocks);
    }

    public function addStock(Request $request) {
        //dd($request);
        foreach($request->productIds as $productId) {
            $stock = Stock::create([
                'branch_id' => $request->branchId,
                'product_id' => $productId,
                'stock_level' => 50,
                'request_count' => 0
            ]);
        }
        return redirect('/admin/manage-stock/'.$request->branchId)->with('success','Product has been added successfully.');
    }

    public function acceptStockRequest(Request $request) {
        $id = $request->stockId;
        $stock = Stock::find($id);
        $new_stock = $stock->stock_level + $stock->request_count;
        $stock->request_count = 0;
        
        Stock::where("id", $id)->first()->update(array('stock_level'=>$new_stock, 'request_count'=>$stock->request_count));
        return redirect('/admin/manage-stock/'.$stock->branch_id)->with('success','Stock request has been approved successfully.');
    }



}
