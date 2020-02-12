<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\User;
use Illuminate\Support\Facades\Hash;

 use App\VerifyUser;
 use App\Mail\VerifyMail;
 use Illuminate\Support\Facades\Mail;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    // public function index()
    // {
    //     //
    // }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */

     public function __construct()
    {
        $this->middleware(['auth', 'admin','2fa']);
    }



    public function add()
    {

        
        return view("auth.user.add");
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required','min:8', 'string', 'confirmed'],
         
        ]);


 

        $user = new User;
        $user->name = request('name');
        $user->password = Hash::make($request['password']);
        $user->roles = "users";
        $user->email = request('email');
        $user->age = request('age');
        $user->sex =  request('sex');
        $user->biography =   request('biography');
        $user->currentRole =   request('currentRole');
        $user->facebook =   request('facebook');
        $user->instagram =   request('instagram');
        $user->linkedin =   request('linkedin');
        $user->college =   request('college');
        $user->phone =   request('phone');
   
        $user->save();




        $fourdigitrandom = rand(1000,9999);

        $verifyUser = VerifyUser::create([
            'user_id' => $user->id,
            'token' => sha1(time()),
            'code' => $fourdigitrandom,
        ]);

        Mail::to($user->email)->send(new VerifyMail($user, $request['password'], $fourdigitrandom ));

     $status = "User added successfully";
        return redirect('/home')->with('status', $status);


    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    // public function show($id)
    // {
    //     //
    // }

    // /**
    //  * Show the form for editing the specified resource.
    //  *
    //  * @param  int  $id
    //  * @return \Illuminate\Http\Response
    //  */



    public function edit($id)
    {


        $user = User::find($id);

        return view('auth.user.edit', compact('user'));

        
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update($id, Request $request)
    {

        $validatedData = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string',  'email', 'max:255'],
            'password' => ['confirmed'],
         
        ]);


        $user = User::find($id);
        $check = User::where('email', '=', request('email'))->first();
     

     
        if ($check != null) {
            if($user->email == request('email')){
                $user->email = request('email');
            }else{
                return back()->with('error', 'Email already exists');
            }
            
        } 

        
        if(request('password'))
        {
            $user->password = Hash::make($request['password']);
        }

        $user->name = request('name');
 
        $user->roles = "users";

        $user->age = request('age');
        $user->sex =  request('sex');
        $user->biography =   request('biography');
        $user->currentRole =   request('currentRole');
        $user->facebook =   request('facebook');
        $user->instagram =   request('instagram');
        $user->linkedin =   request('linkedin');
        $user->college =   request('college');
        $user->phone =   request('phone');

        $user->update();


        $status = "User updated successfully";
        return redirect('/home')->with('status', $status);



    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {   
        
        
        $user = User::find($request->document_id);
        $user->delete();


        return redirect('/home');
        
    }
}
