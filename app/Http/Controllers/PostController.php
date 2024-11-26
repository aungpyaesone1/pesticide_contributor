<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;
use DB;
use Illuminate\Support\Facades\Auth;

class PostController extends Controller
{
    public function view() {
        return view('post.post');
    }

    public function createPost(Request $request) {

        

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
        Post::where("id", $request->postId)->first()->update(array('title'=>$request->title,'description'=>$request->description, 'image'=>$imageUrl));
        return redirect('/admin/post')->with('success','Post has been created successfully.');
    }

    public function deletePost(Request $request) {
        DB::table('posts')->where('id', '=', $request->id)->delete();
        return back()->with('success', 'Post has been deleted successfully.');
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
