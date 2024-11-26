<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Hash;
use Session;
use DB;

class ProductController extends Controller
{
    public function view() {
        return view('product');
    }

    public function createForm() {
        return view('create_product');
    }

    public function createProduct(Request $request) {
        if (!Auth::check()) {
            return redirect("login")->withSuccess('You are not allowed to access');
        }
        $request->validate([
            'name' => 'required',
            'price' => 'required',
            'description' => 'required'
        ]);

        $imagePath = $request->file('image')->getRealPath();
        $result = $this->uploadToImgBB($imagePath);

        // Handle the response as needed
        $imageUrl = $result['data']['url'];
        
        $user = Product::create([
            'name' => $request->name,
            'price' => $request->price,
            'description' => $request->description,
            'category_id' => $request->categoryId,
            'image' => $imageUrl,
            'status' => 1
        ]);
        return redirect('/admin/product')->with('success','Product has been created successfully.');
    }

    public function updateForm() {
        return view('update_product');
    }

    public function updateProduct(Request $request) {
        $imagePath = $request->file('image')->getRealPath();
        $result = $this->uploadToImgBB($imagePath);

        // Handle the response as needed
        $imageUrl = $result['data']['url'];
        Product::where("id", $request->id)->first()->update(array('name'=>$request->name, 'price'=>$request->price, 'description'=>$request->description, 'image'=>$imageUrl, 'category_id'=>$request->categoryId));
        return redirect('/admin/product')->with('success','Product has been created successfully.');
    }

    public function deleteProduct(Request $request) {
        DB::table('products')->where('id', '=', $request->id)->delete();
        return back()->with('success', 'Product has been deleted successfully.');
    }

    function uploadToImgBB($imagePath) 
    {
        $apiKey = "fc1d3c23237171d88a5838891eb8be03";
        $url = 'https://api.imgbb.com/1/upload';
        $client = new \GuzzleHttp\Client();
    
        $response = $client->post($url, [
            'multipart' => [
                [
                    'name' => 'key',
                    'contents' => $apiKey,
                ],
                [
                    'name' => 'image',
                    'contents' => fopen($imagePath, 'r'),
                ],
            ],
        ]);
        return json_decode($response->getBody()->getContents(), true);
    }
}
