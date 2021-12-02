<?php

namespace App\Http\Controllers;

use App\Models\SubscribeProfile;
use App\Models\User;
use Illuminate\Http\Request;

class ProfileController extends Controller
{
    public function index($id){
        $user = User::find($id);
        return view('profile',$user);
    }

    public function publicProfile($id){
        $user = User::find($id)->toArray();
        //echo '<pre>'; print_r($user); exit;
        $data = ['user'=>$user];

        return view('public_profile',$data);
    }

    public function profileSubscribe(Request $request){
        $userExists = User::find($request->user_id)->toArray();
        
        $action = 'Unsubscribe';
        
        if(!empty($userExists)){
            $getSubscribtion = SubscribeProfile::where(['subscribe_from'=>auth()->id(),'subscribe_to'=>$request->user_id])->first();            
            if(empty($getSubscribtion)){
                $action = 'subscribe';
                $addSubscription = ['subscribe_from'=>auth()->id(),'subscribe_to'=>$request->user_id];
                SubscribeProfile::create($addSubscription);
            }else{
                SubscribeProfile::where(['subscribe_from'=>auth()->id(),'subscribe_to'=>$request->user_id])->delete();
                
            }
        }else{
            $userExists = 'User Not available in this plateform';
        }
        $data = ['action' => $action, 'status' => true, 'userExists'=>$userExists];
        return response()->json($data);
    }
}
