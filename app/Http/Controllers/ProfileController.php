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

    public function myProfile(){
        $user = User::find(auth()->id())->toArray();
        $data = ['user'=>$user];
        return view('myprofile',$data);
    }

    public function updateProfile(Request $request){
        $user = User::find(auth()->id())->toArray();

        $this->validate($request,[
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255'],
        ]);
        
        $profile_photo = $user['profile_photo'];
        $cover_photo = $user['cover_photo'];
        
        if($request->file()) {
            
            $destinationPath = public_path('/img/users');
            if($request->file('profile_photo')){
                $profile_photo = time().'_'.$request->file('profile_photo')->getClientOriginalName();
                $request->file('profile_photo')->move($destinationPath, $profile_photo);
            }

            if($request->file('cover_photo')){
                $cover_photo = time().'_'.$request->file('cover_photo')->getClientOriginalName();           
                $request->file('cover_photo')->move($destinationPath, $cover_photo); 
            }                     
            
        }
        $user = User::findOrNew(auth()->id());
        $newData = [
            'name' => $request->name,
            'email' => $request->email,
            'profile_photo' => $profile_photo,
            'cover_photo' => $cover_photo
        ];
        $user->fill($newData);
        $user->save();

        return redirect()->route('myprofile')
                ->withSuccess(__('Profile updated successfully.'));
    }
}
