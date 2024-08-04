<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;
use Illuminate\Support\Facades\Auth;

class PostController extends Controller
{
    public function view() {
        return view('post.post');
    }

    public function createPost(Request $request) {
        if (!Auth::check()) {
            return redirect("login")->withSuccess('You are not allowed to access');
        }
        $request->validate([
            'title' => 'required',
            'description' => 'required'
        ]);

        $imagePath = $request->file('image')->getRealPath();
        $result = $this->uploadToImgBB($imagePath);

        // Handle the response as needed
        $imageUrl = $result['data']['url'];
        
        $post = Post::create([
            'title' => $request->title,
            'description' => $request->description,
            'image' => $imageUrl,
            'status' => 1
        ]);
        return redirect('/admin/post')->with('success','Post has been created successfully.');
    }

    public function updatePost(Request $request) {
        $imagePath = $request->file('image')->getRealPath();
        $result = $this->uploadToImgBB($imagePath);

        // Handle the response as needed
        $imageUrl = $result['data']['url'];
        Post::where("id", $request->id)->first()->update(array('title'=>$request->name,'description'=>$request->description, 'image'=>$imageUrl));
        return redirect('/admin/post')->with('success','Post has been created successfully.');
    }

    public function deleteProduct() {
        return redirect()->route('/product')->with('success','Product has been deleted successfully.');
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