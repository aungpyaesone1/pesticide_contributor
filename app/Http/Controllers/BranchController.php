<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Stock;
use Illuminate\Support\Facades\Auth;
use Hash;
use Session;
use DB;

class BranchController extends Controller
{
    public function view() {
        return view('branch.branch');
    }

    public function createForm() {
        return view('create_branch');
    }

    public function createBranch(Request $request) {
        //dd($request);
        if (!Auth::check()) {
            return redirect("login")->withSuccess('You are not allowed to access');
        }
        $request->validate([
            'username' => 'required',
            'password' => 'required',
            'phone' => 'required',
            'address' => 'required',
        ]);

        $user = User::select('username')->where('phone', $request->phone)->first();
        
        if($user != null) {
            return back()->withErrors([
                'error' => 'Phone number already exist.',
            ]);
        }
        $imagePath = $request->file('image')->getRealPath();
        $result = $this->uploadToImgBB($imagePath);

        // Handle the response as needed
        $imageUrl = $result['data']['url'];
        
        $user = User::create([
            'username' => $request->username,
            'password' => Hash::make($request->password),
            'phone' => $request->phone,
            'address' => $request->address,
            'latitude' => $request->latitude,
            'longitude' => $request->longitude,
            'city_id' => $request->cityId,
            'township_id' => $request->townshipId,
            'email' => $request->email,
            'image' => $imageUrl,
            'role_id' => 2,
            'status' => 1
        ]);
        $stock = Stock::create([
            'branch_id' => $user->id,
            'product_id' => 1,
            'stock_level' => 50,
            'request_count' => 0
        ]);
        //dd($user);
        return redirect('/admin/branch')->with('success','Branch has been created successfully.');
    }

    public function updateForm() {
        return view('update_branch');
    }

    public function updateBranch(Request $request) {
        $user = User::select('username')->whereNot('id', $request->id)->where('phone', $request->phone)->first();
        
        if($user != null) {
            return back()->withErrors([
                'error' => 'Phone number already exist.',
            ]);
        }
        
        $imagePath = $request->file('image')->getRealPath();
        $result = $this->uploadToImgBB($imagePath);

        // Handle the response as needed
        $imageUrl = $result['data']['url'];
        User::where("id", $request->id)->first()->update(array('username'=>$request->username,'email'=>$request->email, 'password'=>Hash::make($request->password), 'phone'=>$request->phone, 'latitude'=>$request->latitude, 'longitude'=>$request->longitude, 'address'=>$request->address, 'image'=>$imageUrl, 'city_id'=>$request->cityId, 'township_id'=>$request->townshipId));
        return redirect('/admin/branch')->with('success','Branch has been updated successfully.');
    }

    public function deleteBranch(Request $request) {
        DB::table('users')->where('id', '=', $request->id)->delete();
        return back()->with('success', 'Branch has been deleted successfully.');
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
