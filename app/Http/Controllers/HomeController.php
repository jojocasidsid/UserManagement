<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\User;
use Auth;
use App\Rules\MatchOldPassword;
use Illuminate\Support\Facades\Hash;



class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware(['auth', '2fa']);
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {

        if(Auth::user()->roles != 'administrator' ){
             $users= User::where('roles', 'users')->where('id', '!=' ,Auth::user()->id)->latest()->paginate(10);
        }
        else{
        $users= User::where('id', '!=' ,Auth::user()->id)->latest()->paginate(9);
        }


        return view('home', compact('users'));
    }

    public function view($id){
        $account = User::find($id);

        if($account->roles != 'users' && Auth::user()->roles != 'administrator' ){
            return back();
        }

        
        if(Auth::user()->roles != 'administrator' ){
             $users= User::where('roles', 'users')->where('id', '!=' ,Auth::user()->id)->latest()->paginate(10);
        }
        else{
        $users= User::where('id', '!=' ,Auth::user()->id)->latest()->paginate(9);
        }

      


        return view('auth.profile', compact('users','account'));

    }

    public function settings(){

        $users= User::where('id', Auth::user()->id)->first();
        return view('auth.settings', compact('users'));
    }


    public function updatePassSettings(Request $request){

        $request->validate([
            'current_password' => ['required', new MatchOldPassword],
            'new_password' => ['required'],
            'new_confirm_password' => ['same:new_password'],
        ]);

       
 
        User::find(auth()->user()->id)->update(['password'=> Hash::make($request->new_password)]);


        return redirect('/Settings')->with('success', 'Password successfully changed!');
    }



    
    public function updateEmail(Request $request){
        $validatedData = $request->validate([
         
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],

        ]);

        User::find(auth()->user()->id)->update(['email'=> $request->email]);

        return redirect('/Settings')->with('success', 'Email successfully changed!');
    }


    public function settingsAPI(){

        return view('auth.settingsAPI');

    }




    public function changepass(){

        return view('auth.passwords.changePassword');

    }


    
    public function updatePass(){
        request()->validate([
            'current_password' => ['required', new MatchOldPassword],
            'new_password' => ['required'],
            'new_confirm_password' => ['same:new_password'],
        ]);

       
        
        User::find(auth()->user()->id)->update([
            'password'=> Hash::make( request()->new_password),
            'change_pass'=> false,
            ]);

    return redirect('\home');

}







    
public function editProfile(){

        request()->validate([
            'name' => ['required', 'string', 'max:255'],
            'picture' => 'max:3024',
            'cover' => 'max:3024'
        ]);

       
      
        if($file = request()->file('picture')){
        $picture =   $file->storeAs('public/images/'.Auth::user()->id , "picture.jpg");

        $picture = '/images/'.Auth::user()->id."/picture.jpg";
        }else{
            $picture = auth()->user()->picture;
        }


              
        if($file = request()->file('cover')){
        $cover =   $file->storeAs('public/images/'.Auth::user()->id , "cover.jpg");

        $cover = '/images/'.Auth::user()->id."/cover.jpg";
        }else{
            $cover = auth()->user()->cover;
        }


        User::find(auth()->user()->id)->update([
            'name'=> request('name'),
            'cover'=>   $cover,
            'picture'=>  $picture ,
            'sex'=> request('sex'),
            'age'=> request('age'),
            'biography'=> request('biography'),
            'currentRole'=> request('currentRole'),
            'facebook'=> request('facebook'),
            'instagram'=> request('instagram'),
            'linkedin'=> request('linkedin'),
            'college'=> request('college'),
            'phone'=> request('phone'),
            ]);

    return redirect('\home');
}


}
